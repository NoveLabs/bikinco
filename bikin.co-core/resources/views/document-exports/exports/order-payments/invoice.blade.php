<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Stylesheet Page -->
    <!-- <link rel="stylesheet" href="{{ asset('print_exports/css/stylesheet.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('print_exports/css/page.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('print_exports/css/lineicons/font-css/LineIcons.css') }}"> -->
    <style type="text/css">
    </style>
    <title>Invoice DP Product</title>
</head>
<body>
    <!-- Main Page -->
    <div class="main_page">
        <!-- 1. Preambule -->
        <page size="A4" orientation="invoice-potrait">
            <!-- Page Header -->
            <div class="page-head side-padding">
                    <div class="page-grid">
                        <div class="grid-1 no-margin">
                            <div class="page-label"><span>Invoice</span></div>
                        </div>
                        <div class="grid-7">
                            <div class="page-header">
                                <div class="company-logo">
                                    <img src="https://www.qries.com/images/banner_logo.png" alt="Bikinco Company Logo">
                                </div>
                            </div>
                            <div class="page-document-num">
                                <div class="flex-grid">
                                    <div class="f-grid-1">
                                        <div class="page-number">
                                            <p>Invoice No :</p>
                                            <span>{{ $data->id}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page-document-info no-margin">
                                <div class="flex-grid">
                                    <div class="f-grid-2">
                                        <div class="page-description">
                                            <p>Issued Date :</p>
                                            <span>{{ $data->order_date }}</span>
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
                <div class="invoice">
                    <!-- Invoice Info -->
                    <div class="invoice-information">
                        <div class="flex-grid">
                            <div class="f-grid-3">
                                <div class="invoice-recipient sender">
                                    <p>PT. Bikin Indonesia Berdaya</p>
                                    <span>3rd Floor, Grha Environesia Jalan Jati Mataram 248 B, Sleman, D.I. Yogyakarta, 55582, Indonesia</span>
                                </div>
                            </div>
                            <div class="f-grid-3 margin-auto text-center">
                                <div class="">
                                    <span class="arrow-icon lni lni-chevron-right"></span>
                                </div>
                            </div>
                            <div class="f-grid-3">
                                <div class="invoice-recipient recipient">
                                    <p>{{ $data->customer->fullname }}</p>
                                    <span>{{ $data->customer->address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-content side-padding">
                        <div class="main-table main-price">

                            <table border="0" class="table-content">
                                <tr class="table-header">
                                    <td>Kode</td>
                                    <td colspan="2" class="text-left">Item</td>
                                    <td>QTY</td>
                                    <td>Harga Unit</td>
                                    <td>Total Harga</td>
                                </tr>
                                <tr class="table-item">
                                    <td>{{ $data->id }}</td>
                                    <td colspan="2"><div class="product-name"><p>{{ $data->orderItems[0]->hasProduct->name }}</p><span>{{ $data->orderItems[0]->hasProduct->hasSubCategories->name }}</span></div></td>
                                    <td>{{ $data->total_item }} Pcs</td>
                                    <td>{{ $data->orderItems[0]->hasProduct->price }}</td>
                                    <td>{{ $hasil }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                    <div class="invoice-content">
                        <div class="flex-grid">
                            <div class="f-grid-2"></div>
                            <div class="f-grid-2" >
                                <div class="invoice-summary">
                                    <!-- Loop this -->
                                    <div class="invoice-price-descriptor text-center">
                                        <div class="page-grid">
                                            <div class="f-grid-2 margin-auto text-left">
                                                <p>Total Harga</p>
                                            </div>
                                            <div class="f-grid-5 margin-auto text-right">
                                                <p>Rp.</p>
                                            </div>
                                            <div class="f-grid-2 margin-auto text-right">
                                                <p>{{ $hasil }}</p>
                                            </div>
                                        </div>
                                    </div>
<!--                                     <div class="invoice-price-descriptor text-center">
                                        <div class="page-grid">
                                            <div class="f-grid-2 margin-auto text-left">
                                                <p>Deposit</p>
                                            </div>
                                            <div class="f-grid-5 margin-auto text-right">
                                                <p>Rp.</p>
                                            </div>
                                            <div class="f-grid-2 margin-auto text-right">
                                                <p>{{ $data->part_paid_amount }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-price-descriptor text-center">
                                        <div class="page-grid">
                                            <div class="f-grid-2 margin-auto text-left">
                                                <p>Discount</p>
                                            </div>
                                            <div class="f-grid-5 margin-auto text-right">
                                                <p>Rp.</p>
                                            </div>
                                            <div class="f-grid-2 margin-auto text-right">
                                                <p>{{ $data->total_price_rounding }}</p>
                                            </div>
                                        </div>
                                    </div> -->
                                    <hr>
                                    <div class="invoice-price-descriptor text-center">
                                        <div class="page-grid">
                                            <div class="f-grid-2 margin-auto text-left">
                                                <p>Sisa Pembayaran</p>
                                            </div>
                                            <div class="f-grid-5 margin-auto text-right">
                                                <p>Rp.</p>
                                            </div>
                                            <div class="f-grid-2 margin-auto text-right">
                                                <p>{{ $hasil }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Loop This -->
                                    <div class="invoice-price-summary">
                                        <div class="invoice-summary-descriptor text-center">
                                            <div class="page-grid">
                                                <div class="f-grid-2 margin-auto text-left">
                                                    <p>Uang muka 50%</p>
                                                </div>
                                                <div class="f-grid-5 margin-auto text-right">
                                                    <p>Rp.</p>
                                                </div>
                                                <div class="f-grid-2 margin-auto text-right">
                                                    <p>{{ $data->part_paid_amount }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-footer side-padding">
                <div class="page-grid">
                    <div class="grid-3">
                        <div class="company-footer">
                            <address class="company-name">PT. Bikin Indonesia Berdaya</address>
                            <address>3<sup>rd</sup> Floor, Grha Environesia</address>
                            <address>Jalan Jati Mataram 248B, Sleman</address>
                            <address>D.i. Yogyakarta</address>
                            <address>55582, Indonesia</address>
                        </div>
                    </div>
                    <div class="grid-5 no-margin">
                        <div class="flex-grid">
                            <div class="f-grid-2">
                                <div class="company-contact">
                                    <div class="company-list phone">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-phone"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>+62 274 88 0603 (Ext.4)</span><br>
                                                    <span>+62 852 8888 6020</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="company-list email">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-envelope"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>info@bikin.co</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-list website">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-world"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>www.bikin.co</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f-grid-2"></div>
                        </div>
                    </div>

                </div>
            </div>
        </page>
        <!-- How to Pay Document -->
        <page size="A4" orientation="invoice-potrait">
            <!-- Page Header -->
            <div class="page-head side-padding">
                <div class="page-grid">
                    <div class="grid-1 no-margin">
                        <div class="page-label"><span>Invoice</span></div>
                    </div>
                    <div class="grid-7">
                        <div class="page-header">
                            <div class="company-logo">
                            </div>
                        </div>
                        <div class="page-document-num">
                            <div class="flex-grid">
                                <div class="f-grid-1">
                                    <div class="page-number">
                                        <p>Invoice No :</p>
                                        <span>{{ $data->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-document-info no-margin">
                            <div class="flex-grid">
                                <div class="f-grid-2">
                                    <div class="page-description">
                                        <p>Issued Date :</p>
                                        <span>{{ $data->order_date }}</span>
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
            <div class="page-body side-padding">
                <!-- Customer information -->
                <div class="how-to-transfer ">
                    <div class="transfer-destination">
                        <p>Tujuan Transfer :</p>
                        <span>a/n PT.Bikin Indonesia Berdaya</span>
                    </div>
                    <div class="banks">
                        <div class="page-grid">
                            <div class="f-grid-3">
                                <div class="bank-list">
                                    <div class="bank-logo">
                                    </div>
                                    <div class="bank-name">
                                        <p>Mandiri</p>
                                        <span>13700 8888 0402</span>
                                    </div>
                                </div>
                            </div>
                            <div class="f-grid-3">
                                <div class="bank-list">
                                    <div class="bank-logo">
                                    </div>
                                    <div class="bank-name">
                                        <p>BRI</p>
                                        <span>1056 0100 031 5562</span>
                                    </div>
                                </div>
                            </div>
                            <div class="f-grid-3">
                                <div class="bank-list">
                                    <div class="bank-logo">
                                    </div>
                                    <div class="bank-name">
                                        <p>BCA</p>
                                        <span>8610 7777 33</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="how-to-transfer no-margin-top ">
                    <div class="transfer-destination">
                        <p>Konfirmasi Pembayaran :</p>
                        <span><a href="#">https://www.bikin.co/payment/confirmation?no={{ $data->id }}</a>
                            <br>
                        atau konfirmasi pembayaran anda melalui Customer Service Kami ( 0812 8888 6020 ).</span>
                    </div>
                    <div class="transfer-destination no-margin-bottom">
                        <p class="tc-title">Syarat & Ketentuan :</p>
                        <span class="tc-span">
                            1. Surat Perjanjian Kerja ( SPK ) dibuat setelah Pembayaran DP terverifikasi. <br>
                            2. Produksi dimulai setelah Surat Perjanjian Kerja ( SPK ) disetujui customer.
                        </span>
                    </div>
                </div>

            </div>

            <div class="page-footer side-padding">
                <div class="page-grid">
                    <div class="grid-3">
                        <div class="company-footer">
                            <address class="company-name">PT. Bikin Indonesia Berdaya</address>
                            <address>3<sup>rd</sup> Floor, Grha Environesia</address>
                            <address>Jalan Jati Mataram 248B, Sleman</address>
                            <address>D.i. Yogyakarta</address>
                            <address>55582, Indonesia</address>
                        </div>
                    </div>
                    <div class="grid-5 no-margin">
                        <div class="flex-grid">
                            <div class="f-grid-2">
                                <div class="company-contact">
                                    <div class="company-list phone">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-phone"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>+62 274 88 0603 (Ext.4)</span><br>
                                                    <span>+62 852 8888 6020</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-list email">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-envelope"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>info@bikin.co</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="company-list website">
                                        <div class="page-grid">
                                            <div class="f-grid-7 no-margin icon-color"><span class="lni lni-world"></span></div>
                                            <div class="f-grid-1">
                                                <div class="company-contact-item">
                                                    <span>www.bikin.co</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="f-grid-2"></div>
                        </div>
                    </div>

                </div>
            </div>
        </page>
    </div>
</body>
</html>