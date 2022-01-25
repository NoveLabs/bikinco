<?php
namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormValidation 
{
    public static function uniqueColumnValidation($table, Array $columns, $exceptId = 0)
    {
        //        dd($columns);
        if (!is_array($columns) or empty($columns) or empty($table)) 
            return [
                'status' => false,
                'data' => [],
                'message' => "unique column not defined."
            ];

        foreach ($columns as $item) {
            $check = DB::table($table);

            foreach ($item['condition'] as $cond) {
                if (is_null($cond['opr_func']) or is_null($cond['name']) or is_null($cond['opr']) or is_null($cond['value']))
                    continue;

                $check->{$cond['opr_func']}($cond['name'], $cond['opr'], $cond['value']);
            }

            $check->when(!empty($exceptId), function($sql) use ($exceptId) {
                    return $sql->where('id', '<>', $exceptId);
                })
                ->whereNull('deleted_at');

            if ($check->count() > 0) {
                return [
                    'status' => false,
                    'data' => [],
                    'message' => !empty($item['message']) ? $item['message'] : "Data sudah digunakan",
                ];
            }
    
        }

        return [
            'status' => true,
            'data' => [],
            'message' => '',
        ];
    }

    public static function uploadOne(Request $request, $inputName, $folder, $fileName = '')
    {
        if (is_null($inputName) or is_null($folder))
            return null;

        $file = '';
        if ($request->has($inputName)) {
            $image = $request->file($inputName);
            $name = date('YmdHis') . uniqid();

            if (!empty($fileName)) {
                $name = $fileName;
            }

            $name = str_replace(" ", "_", $name);            
            $filePath = $name. '.' . $image->getClientOriginalExtension();

            $image->move($folder, $filePath);

            $file = $folder . '/'. $filePath;
        }

        return $file;
    }
}