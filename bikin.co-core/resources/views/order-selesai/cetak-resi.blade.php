<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Stylesheet Page -->
    <link rel="stylesheet" href="{{ asset('assets/css/css/stylesheet.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/css/page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/css/lineicons/font-css/LineIcons.css') }}">
    <title>Quotation Design Document</title>
</head>
<body>
    <!-- Main Page -->
    <div class="main_page">
        <page size="A5" orientation="landscape">
            <!-- Page Header -->
            <div class="page-head">
                <div class="page-grid">
                    <div class="grid-1 no-margin">
                        <div class="page-label"><span>Shipment</span></div>
                    </div>
                    <div class="grid-7">
                        <div class="page-header">
                            <div class="company-logo">
                                <img src="{{ asset('samples/img/logo/company_logo.png') }}" alt="Bikinco Company Logo">
                            </div>
                        </div>
                        <div class="page-document-num">
                            <div class="flex-grid">
                                <div class="f-grid-1">
                                    <div class="page-description no-margin-top">
                                        <div class="jb-heading">Shipment Receipt</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-document-info no-margin">
                            <div class="flex-grid">
                                <div class="f-grid-2">
                                    <div class="page-description">
                                        <p>ASX Cargo</p>
                                        <span>Yogyakarta - Cargo</span>
                                    </div>
                                </div>
                                <div class="f-grid-2">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Body -->
            <div class="page-body">
                <!-- Customer information -->
                <div class="information-sheet">
                    <p>Detail Pengiriman</p>
                    <div class="information-box">
                        <div class="flex-grid">
                            <div class="f-grid-2">
                                <div class="info-content-box">
                                    <p>Nomor Resi</p>
                                    <span>{{ $data->orderShipments[0]->no_resi }}</span>
                                </div>
                            </div>
                            <div class="f-grid-2">
                                <div class="info-content-box">
                                    <p>Layanan</p>
                                    <span>{{ $data->orderShipments[0]->expedition_name }}</span>
                                </div>
                            </div>
                            <div class="f-grid-2">
                                <div class="info-content-box">
                                    <p>Referensi</p>
                                    <div class="receipt-detail">
                                        <p>Bikin.co</p>
                                        <span>Grha Environesia, Jl. Jati Mataram No.284B, RT.019/RW.042, Karangjati, Sinduadi, Kec. Mlati, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55284</span>
                                    </div>
                                </div>
                            </div>
                            <div class="f-grid-2">
                                <div class="info-content-box">
                                    <p>Penerima</p>
                                    <div class="receipt-detail">
                                        <p>{{ $data->customer->fullname }}</p>
                                        <span>{{ $data->customer->address }}</span><br>
                                        <span>Phone : {{ $data->customer->mobile_phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </page>
    </div>
</body>
</html>