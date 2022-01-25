<?php

//save log user
function saveActivityUser($request, $agent, $description)
{
    $data = [
        'user_id'     => Auth::user()->id,
        'description' => $description,
        'ip'          => $request->ip(),
        'platform'    => $agent->platform(),
        'browser'     => $agent->browser(),
    ];

    \App\Http\Models\Userlog::create($data);

}

function saveActivityVendor($request, $agent, $description)
{
	$data = [
		'user_id' => Auth::guard('vendor')->user()->id,
		'description' => $description,
        'ip'          => $request->ip(),
        'platform'    => $agent->platform(),
        'browser'     => $agent->browser(),
	];
}

function formatRupiah ($angka) {
    $hasil = 'Rp ' . number_format($angka, 2, ",", ".");
    return $hasil;
}


function queryFormatPhotoWithAlias($column, $type = 'avatarpath', $arr_type = ['md'=>'photo_md','xs'=>'photo_xs'])
{
    $real_path = '';

    $i = 0;
    $jumlahdata = count($arr_type);
    foreach ($arr_type as $arr_type_key => $arr_type_value) {
        $i++;
        $space = '';
        if(!empty($arr_type_key))
        {
            $space = '_';
        }

        if(!empty($arr_type_value))
        {
            $arr_type_value = ' as '.$arr_type_value;
        }

        $real_path .= 'REPLACE(REPLACE(IFNULL(concat("'.config('sitesetting')[$type].$arr_type_key.$space.'",'.$column.'), "'.url('/img').'/no_avatar.png"), CHAR(13), ""), CHAR(10), "")'.$arr_type_value;

        if($jumlahdata!=$i)
        {
            $real_path .= ',';
        }
    }

    return \DB::raw($real_path);
}

/**
 * [queryFormatDate description]
 * @param  [type] $column   [description]
 * @param  [type] $asColumn [description]
 * @param  string $format   [description]
 * @return [type]           [description]
 */
function queryFormatDate($column, $asColumn = null, $format = '"%d %b %Y"')
{
    if( empty($asColumn) ) {
        return \DB::raw('DATE_FORMAT('.$column.', '.$format.')');
    }
    return \DB::raw('DATE_FORMAT('.$column.', '.$format.') as '.$asColumn);
}

/**
 * [queryFormatTime description]
 * @param  [type] $column   [description]
 * @param  [type] $asColumn [description]
 * @param  string $format   [description]
 * @return [type]           [description]
 */
function queryFormatTime($column, $asColumn = null, $format = '"%H:%i"')
{
    if( empty($asColumn) ) {
        return \DB::raw('DATE_FORMAT('.$column.', '.$format.')');
    }
    return \DB::raw('DATE_FORMAT('.$column.', '.$format.') as '.$asColumn);
}


/**
 * [formatMoney description]
 * @param  [type] $key [description]
 * @return [type]      [description]
 */
function queryFormatMoney($column, $asColumn = null, $currency_id = 'empty', $dec_digit = '2', $dec_point = '","', $thousands_sep = '"."', $default_value = 0)
{

    $space = " ";
    if($currency_id=="empty")
    {
        $space = "";
        $currency_id = "''";
    }

    if(empty($asColumn))
            return \DB::raw(' IFNULL(concat('.$currency_id.',"'.$space.'",REPLACE(REPLACE(REPLACE(CAST(FORMAT('.$column.', '.$dec_digit.') AS CHAR), ".", "@"), '.$dec_point.', '.$thousands_sep.'), "@", '.$dec_point.')),'.$default_value.') ');
        else
            return \DB::raw(' IFNULL(concat('.$currency_id.',"'.$space.'",REPLACE(REPLACE(REPLACE(CAST(FORMAT('.$column.', '.$dec_digit.') AS CHAR), ".", "@"), '.$dec_point.', '.$thousands_sep.'), "@", '.$dec_point.')),'.$default_value.') as '.$asColumn.' ');
}


function valueFormatMoney($value, $currency_id = null, $dec_digit = '2', $dec_point = ',', $thousands_sep = '.', $default_value = 0)
{
    $space = " ";
    if(empty($currency_id))
    {
        $space = null;
        $currency_id = null;
    }

    return ''.$currency_id.$space.number_format($value, $dec_digit, $dec_point, $thousands_sep).'';
}
