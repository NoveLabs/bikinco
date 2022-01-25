<?php
namespace App\Http\Helpers;

use App\Exceptions\DataEmptyException;


class UploadFile
{
     /**
     * [upload description]
     * @param  [type] $file     [description]
     * @param  string $awsStore [description]
     * @param  [type] $arrType  [description]
     * @return [type]           [description]
     */
    public function upload( $file, $awsStore = 'awsfolderuser', $arrType = NULL)
    {

        if( empty($arrType))
        {
            $arrType = [
                [
                    'width' => 1024,
                    'prefix' => 'xl_'
                ],
                [
                    'width' => 720,
                    'prefix' => 'lg_'
                ],
                [
                    'width' => 480,
                    'prefix' => 'md_'
                ],
                [
                    'width' => 240,
                    'prefix' => 'sm_'
                ],
                [
                    'width' => 100,
                    'prefix' => 'xs_'
                ],
            ];
        }

        if( empty($file) )
        {
            throw new DataEmptyException('File does not exist');
        }

        if( empty($file['file']) )
        {
            throw new DataEmptyException('File does not exist');
        }

        if(!is_array($file['file']))
        {
            $file = [
                'file' => [
                    $file['file']
                ]
            ];
        }
        $data = array();
        foreach ($file['file'] as $key => $fileValue)
        {
            if(!empty($fileValue))
            {
                $destinationPath = storage_path('app/tmp/uploads/');

                #auto create jika tidak ada directorynya
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = uniqid().'.'.$fileValue->getClientOriginalExtension();

                $sizes = $arrType;

                $width = 0; $height = 0;
                foreach($sizes as $size)
                {
                    if( empty($size['width']) && empty($size['height']) )
                    {
                        \Image::make($fileValue->getRealPath())->save($destinationPath.$size['prefix'].$filename);
                    }
                    else
                    {
                        \Image::make($fileValue->getRealPath())->resize(
                            !empty($size['width']) ? $size['width'] : NULL,
                            !empty($size['height']) ? $size['height'] : NULL,
                            function ($constraint) {
                                $constraint->aspectRatio();
                            }
                        )->save($destinationPath.$size['prefix'].$filename);
                    }

                    \Storage::disk('s3')
                        ->put(
                            \Config::get('sitesetting.'.$awsStore).'/'.$size['prefix'].$filename,
                            file_get_contents($destinationPath.$size['prefix'].$filename),
                            [
                                'visibility' => 'public',
                                'CacheControl' => 'max-age=31536000',
                            ]
                        );

                    if ($width == 0)
                    {
                        list($width, $height) = getimagesize($destinationPath.$size['prefix'].$filename);
                    }

                    \File::delete($destinationPath.$size['prefix'].$filename);
                }

                $data[$key]['file_name'] = $filename;
                if( in_array('md',$arrType))
                {
                    $data[$key]['photo_md'] = config('sitesetting')['productpath'].'md_'.$filename;
                }
                $data[$key]['width'] = $width;
                $data[$key]['height'] = $height;

            }
        }

        return $data;

    }


    /**
     * [upload description]
     * @param  [type] $file     [description]
     * @param  string $awsStore [description]
     * @param  [type] $arrType  [description]
     * @return [type]           [description]
     */
    public function uploadOneFile( $file, $awsStore = '', $arrType = NULL)
    {

        if( empty($arrType))
        {
            $arrType = [
                [
                    'width' => 1024,
                    'prefix' => 'xl_'
                ],
                [
                    'width' => 720,
                    'prefix' => 'lg_'
                ],
                [
                    'width' => 480,
                    'prefix' => 'md_'
                ],
                [
                    'width' => 240,
                    'prefix' => 'sm_'
                ],
                [
                    'width' => 100,
                    'prefix' => 'xs_'
                ],
            ];
        }

        if( empty($file) )
        {
            $data['file_name'] = null;
            $data['width'] = 0;
            $data['height'] = 0;
            return $data;
        }

        $destinationPath = storage_path('app/tmp/uploads/');

        #auto create jika tidak ada directorynya
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $filename = uniqid().'.'.$file->getClientOriginalExtension();

        $sizes = $arrType;

        $width = 0; $height = 0;

        $data = array();

        foreach($sizes as $size)
        {
            if( empty($size['width']) && empty($size['height']) )
            {
                \Image::make($file->getRealPath())->save($destinationPath.$size['prefix'].$filename);
            }
            else
            {
                \Image::make($file->getRealPath())->resize(
                    !empty($size['width']) ? $size['width'] : NULL,
                    !empty($size['height']) ? $size['height'] : NULL,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                )->save($destinationPath.$size['prefix'].$filename);
            }

            \Storage::disk('s3')
                ->put(
                    \Config::get('sitesetting.'.$awsStore).'/'.$size['prefix'].$filename,
                    file_get_contents($destinationPath.$size['prefix'].$filename),
                    [
                        'visibility' => 'public',
                        'CacheControl' => 'max-age=31536000',
                    ]
                );

            if ($width == 0)
            {
                list($width, $height) = getimagesize($destinationPath.$size['prefix'].$filename);
            }

            \File::delete($destinationPath.$size['prefix'].$filename);
        }

        $data['file_name'] = $filename;
        if( in_array('md',$arrType))
        {
            $data['photo_md'] = config('sitesetting')['productpath'].'md_'.$filename;
        }
        $data['width'] = $width;
        $data['height'] = $height;

        return $data;

    }

    /**
     * [upload description]
     * @param  [type] $file     [description]
     * @param  string $awsStore [description]
     * @param  [type] $arrType  [description]
     * @return [type]           [description]
     */
    public function uploadFileWithoutImage( $file, $awsStore = 'awsfolderuser')
    {


        $destinationPath = storage_path('app/tmp/uploads/');

        #auto create jika tidak ada directorynya
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        $filename = uniqid().'.'.$file->extension();


        $result = \Storage::disk('s3')

                ->put(
                    \Config::get('sitesetting.'.$awsStore).'/'.$filename,
                    $file,
                    [
                        'visibility' => 'public',
                        'CacheControl' => 'max-age=31536000',
                    ]
                );

        $data['file_name'] = $filename;
        $data['file'] = $file;
        $data['path_link'] = $result;
        return $data;
    }

}
