<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Stylesheet Page -->
    {{--    <link rel="stylesheet" href="{{ asset('print_exports/css/bootstrap_3.4.1/css/bootstrap.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('print_exports/css/bootstrap_3.4.1/css/bootstrap-theme.min.css') }}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('print_exports/css/page.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('print_exports/css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('print_exports/css/lineicons/font-css/LineIcons.css') }}">
    <style>
        * {
            margin: auto;
            padding: auto;
            box-sizing: border-box;
            font-family: "Gilroy";
        }

        body {
            background-color: #f5f5f5;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-justify {
            text-align: justify;
        }

        .text-default {
            margin: 4mm 0;
            line-height: 1.5;
            font-size: 13pt;
        }

        .text-indent {
            text-indent: 5mm;
        }

        .text-bold {
            font-weight: 600;
        }

        .underlined {
            text-decoration: underline;
        }

        .no-margin {
            margin: 0 !important;
        }

        .no-margin-top {
            margin-top: 0 !important;
        }

        .no-margin-bottom {
            margin-bottom: 0 !important;
        }

        .no-margin-left {
            margin-left: 0 !important;
        }

        .no-margin-right {
            margin-right: 0 !important;
        }

        .small-padding-left {
            padding-left: 3mm;
        }

        .small-padding-right {
            padding-right: 3mm;
        }

        .small-padding-top {
            padding-top: 3mm;
        }

        .small-padding-bottom {
            padding-bottom: 3mm;
        }

        .small-margin-top {
            margin-top: 3mm !important;
        }

        .small-margin-bottom {
            margin-bottom: 3mm !important;
        }

        .small-margin-left {
            margin-left: 3mm !important;
        }

        .small-margin-right {
            margin-right: 3mm !important;
        }

        .default-margin {
            margin: 5mm;
        }

        .default-margin-top {
            margin-top: 5mm;
        }

        .default-margin-bottom {
            margin-bottom: 3mm;
        }

        .default-margin-left {
            margin-left: 5mm;
        }

        .default-margin-right {
            margin-right: 5mm;
        }

        .main-page-landscape {
            margin: auto;
            background: #fff;
            width: 297mm;
            padding: 5mm 10mm;
            page-break-after: always;
            height: 210mm;
            margin-bottom: 5mm;
        }

        .main-page-landscape .page-body {
            height: calc(100% - 30%);
        }

        .main-page {
            margin: auto;
            background: #fff;
            width: 210mm;
            padding: 5mm 10mm;
            page-break-after: always;
            height: 297mm;
            margin-bottom: 5mm;
        }

        .page-header {
            margin-bottom: 5mm;
        }

        .page-body {
            height: calc(100% - 22%);
        }

        .page-footer {
            position: inherit;
            margin: 0;
            /*bottom: 0;*/
            /*width: 100%;*/
        }

        .footer-content {
            padding: .5mm 2mm;
        }

        .page-list {
            margin-top: 0;
            padding: 1mm;
        }

        .page-list-default {
            padding-left: 0;
        }

        .page-list li {
            list-style: none;
            display: inline-block;
            margin-right: -5px;
            vertical-align: top;
        }

        .page-container {
            padding: 5mm;
        }

        .signature-content {
            margin-bottom: 20mm !important;
        }

        .page-table {
            margin: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 5mm;
        }

        .table-default {
            border-collapse: collapse;
        }

        .table-bordered {
            border-collapse: collapse;
            border: 1px solid;
        }

        .table-default tr, .table-bordered tr {
        }

        .table-default tbody tr:nth-child(even) {
            background: #f5f5f5;
        }

        .table-default th, .table-bordered th {
            padding: 3mm;
            border-bottom: 1px solid #424242;
        }

        .table-default td, .table-bordered td {
            padding: 3mm;
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid;
        }

        .middle-content {
            vertical-align: middle !important;
        }

        .list-grid-1 {
            width: 8.33%;
        }

        .list-grid-2 {
            width: 16.67%;
        }

        .list-grid-3 {
            width: 25%;
        }

        .list-grid-4 {
            width: 33.33%;
        }

        .list-grid-5 {
            width: 41.67%;
        }

        .list-grid-6 {
            width: 50%;
        }

        .list-grid-7 {
            width: 58.33%;
        }

        .list-grid-8 {
            width: 66.67%;
        }

        .list-grid-9 {
            width: 75%;
        }

        .list-grid-10 {
            width: 83.33%
        }

        .list-grid-11 {
            width: 91.67%
        }

        .list-grid-12 {
            width: 100%
        }

        .document-label {
            position: relative;
            top: 0;
            left: -7mm;
            padding: 3mm 35mm 3mm 4mm;
            background: #02b3a1;
            color: #fff;
            font-size: 13pt;
            text-transform: uppercase;
            font-weight: 600;
        }

        .document-info {
            margin-bottom: 2.5mm;
        }

        .document-info:last-child {
            margin-bottom: 0;
        }

        .header-image {
            max-width: 3cm;
        }

        .page-info-banner {
            padding: 5mm 10mm;
            background: #424242;
            color: #fff;
        }

        .address-sender-section {
        }

        .address-sender-section::before {
            content: "Dari :"
        }

        .address-recipient-section::before {
            content: "Ditagihkan Ke :"
        }

        .address-title {
            margin-top: 3mm;
            margin-bottom: 3mm;
            font-weight: 600;
        }

        .address-content {
        }

        .icon-separator {
            font-size: 10mm;
        }

        .line-separator {
            margin: 2mm 0;
            border-color: #ffffff;
        }

        .page-card {
            width: 80mm;
        }

        .default-grey {
            background: #d5d5d5;
        }

        .official-background {
            background: #02b3a1;
            color: #fff;
        }

        .official-color {
            color: #02b3a1;
        }

        .card-body {
            padding: 3mm;
        }

        .card-footer {
            padding: 3mm;
        }

        .item-list-card {
            padding: 2mm 4mm;
            background: rgba(111, 181, 174, 0.12);
            border-left: 1.5mm solid #02b3a1;
            border-radius: 1mm;
        }

        .summary-item {
            background: #02b3a1 !important;
            color: #fff !important;
            border: none !important;
        }

        .summary-sub-item {
            background: #dedede !important;
            color: #383838 !important;
            border: none !important;
        }

        .label {
            padding: 1.5mm;
            font-size: 8pt;
            border-radius: 1mm;
            font-weight: 600;
            text-transform: uppercase;
        }

        .default-label {
            background: #00acc1;
            color: #fff;
        }

        .table-image {
            width: 75%;
        }


        .no-padding {
            padding: 0 !important;
        }

        .default-padding {
            padding: 5mm;
        }

        .table-image-fit {
            width: 80%;
        }

        .has-paid {
        }

        .has-paid img {
        }

        .fill-content {
            padding: 5mm;
            border-bottom: 1px solid;
        }
    </style>
    <title>Document</title>
    @yield('inline_style')
</head>
<body>
@yield('document.content')
</body>
</html>
