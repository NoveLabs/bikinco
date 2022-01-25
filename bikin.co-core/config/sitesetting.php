<?php

return array(

    //path
    'categorypath' => env('AWS_BUCKET_URL', '').'/bikin/category/',
    'categoryiconpath' => env('AWS_BUCKET_URL', '').'/bikin/category/icon/',
    'blogpath' => env('AWS_BUCKET_URL', '').'/bikin/blog/',
    'bannerpath' => env('AWS_BUCKET_URL', '').'/bikin/banner/',
    'companypath' => env('AWS_BUCKET_URL', '').'/bikin/company/',
    'promopath' =>env('AWS_BUCKET_URL', '').'/bikin/promo/',
 	'orderpaymentpath' => env('AWS_BUCKET_URL', '').'/bikin/order-payment/',
 	'orderpelunasanpath' => env('AWS_BUCKET_URL', '').'/bikin/order-pelunasan/',
 	'artworkpath' => env('AWS_BUCKET_URL', '').'/bikin/artwork/',
 	'zipartworkpath' => env('AWS_BUCKET_URL', '').'/',
 	'designpath' => env('AWS_BUCKET_URL', '').'/bikin/design/',
 	'orderitemsteppath' => env('AWS_BUCKET_URL', '').'/bikin/order-item-step/',
 	'orderitemfinishpath' => env('AWS_BUCKET_URL', '').'/bikin/order-item-finished/',
 	'vendordppath' => env('AWS_BUCKET_URL', '').'/bikin/vendor-dp/',
 	'vendorpelunasanpath' => env('AWS_BUCKET_URL', '').'/bikin/vendor-pelunasan/',
 	'subcategoriespath' => env('AWS_BUCKET_URL', '').'/bikin/sub-categories/',
 	'productpath' => env('AWS_BUCKET_URL', '').'/bikin/product/',
 	'modelpath' => env('AWS_BUCKET_URL', '').'/bikin/model/',
 	'pengaturansizepackpath' => env('AWS_BUCKET_URL', '').'/bikin/pengaturan-sizepack/',

    //folder aws
	'noavatarfile' => 'no_avatar.png',
    'awsfoldercategory' => '/bikin/category',
    'awsfoldercategoryicon' => '/bikin/category/icon',
    'awsfolderbanner' => '/bikin/banner',
    'awsfolderblog' => '/bikin/blog',
    'awsfoldercompany' => '/bikin/company',
    'awsfolderpromo' => '/bikin/promo',
    'awsfolderorderpayment' => '/bikin/order-payment',
    'awsfolderorderpelunasan' => '/bikin/order-pelunasan',
    'awsfolderartwork' => '/bikin/artwork',
    'awsfolderdesign' => '/bikin/design',
    'awsfolderorderitemstep' => '/bikin/order-item-step',
    'awsfolderorderitemfinish' => '/bikin/order-item-finished',
    'awsfoldervendordp' => '/bikin/vendor-dp',
    'awsfoldervendorpelunasan' => '/bikin/vendor-pelunasan',
    'awsfoldersubcategories' => '/bikin/sub-categories',
    'awsfolderproduct' => '/bikin/product',
    'awsfoldermodel' => '/bikin/model',
    'awsfolderpengaturansizepack' => 'bikin/pengaturan-sizepack',

	'lock'	=>	[],

);
