<!DOCTYPE html>
<html lang="id">

@foreach($dataOrder as $value)
<head>
    <title>Print Order ID{{ $value->id }}</title>
    @endforeach
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }

        @media print {
            body {
                padding-top: 0;
            }

            #action-area {
                display: none;
            }
        }

        @media screen and (min-width: 1025px) {
            .btn-download {
                display: none !important;
            }

            .btn-back {
                display: none !important;
            }
        }

        @media screen and (max-width: 1024px) {
            .content-area>div {
                width: auto !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 720px) {
            .content-area>div {
                width: auto !important;
            }
        }

        @media screen and (max-width: 420px) {
            .content-area>div {
                width: 790px !important;
            }
        }

        @media screen and (max-width: 430px) {
            .content-area {
                transform: scale(0.59) translate(-35%, -35%)
            }

            .content-area>div {
                width: 720px !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 380px) {
            .content-area {
                transform: scale(0.45) translate(-58%, -62%);
            }

            .content-area>div {
                width: 790px !important;
            }

            .btn-print {
                display: none !important;
            }
        }

        @media screen and (max-width: 320px) {
            .content-area>div {
                width: 700px !important;
            }
        }
    </style>
</head>

<body
    style="font-family: open sans, tahoma, sans-serif; margin: 0; -webkit-print-color-adjust: exact; padding-top: 60px;">
    
    <div id="action-area">
        <div id="navbar-wrapper"
            style="padding: 12px 16px;font-size: 0;line-height: 1.4; box-shadow: 0 -1px 7px 0 rgba(0, 0, 0, 0.15); position: fixed; top: 0; left: 0; width: 100%; background-color: #FFF; z-index: 100;">
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px;">
                <div class="btn-back" onclick="window.close();">
                    <img src="https://ecs7.tokopedia.net/img/back-invoice.png" width="20px" alt="Back"
                        style="display: inline-block; vertical-align: middle;" />
                    <span
                        style="display: inline-block; vertical-align: middle; margin-left: 16px; font-size: 16px; font-weight: bold; color: rgba(49, 53, 59, 0.96);">Invoice</span>
                </div>
            </div>
            <div style="width: 50%; display: inline-block; vertical-align: middle; font-size: 12px; text-align: right;">
                <a class="btn-download" href="javascript:window.print()"
                    style="display: inline-block; vertical-align: middle;">
                    <img src="https://ecs7.tokopedia.net/img/download-invoice.png" alt="Download" width="20px" ; />
                </a>
                <a class="btn-print" href="javascript:window.print()"
                    style="height: 100%; display: inline-block; vertical-align: middle;">
                    <button id="print-button"
                        style="border: none; height: 100%; cursor: pointer;padding: 8px 40px;border-color: #02B3A1;border-radius: 8px;background-color: #02B3A1;margin-left: 16px;color: #fff;font-size: 12px;line-height: 1.333;font-weight: 700;">Cetak</button>
                </a>
            </div>
        </div>
    </div>
    

    <div class="content-area">
        
        <div style="margin: auto; width: 790px;">
            <table width="100%" cellspacing="0" cellpadding="0" style="width: 100%; padding: 25px 32px;">
                <tr>
                    <td>
                        <!-- header -->
                        <table width="100%">
                            <tr>
                                <td style="text-align: center;">
                                    <img src="http://dev.backoffice.bikin.co/img/logo_alt@2x.png" width="246"
                                        alt="Tokopedia" style="margin-top: -23px;">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                

                <!-- ringkasan belanja -->
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0"
                                style="padding-bottom: 20px; padding-top: 20px; border-bottom: thin dashed #cccccc; border-top: thin dashed #cccccc;">
                                @for($i=0; $i < $countOrder ; $i++)
                                <tr>
                                    <td style="width: 57%; vertical-align: top;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            
                                            <tr>
                                                <td colspan="2" style="font-size: 14px;">
                                                    <span style="font-weight: 600">Order ID</span> : <span
                                                        style="color: #42b549; font-weight: 600;">{{ $dataOrder[$i]->id }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="font-size: 12px; padding: 8px 0;">
                                                    Diorder pada:
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td
                                                    style="font-size: 12px; font-weight: 600; padding-bottom: 6px; width: 80px;">
                                                    Tanggal</td>
                                                <td style="font-size: 12px; padding-bottom: 6px;">
                                                   {{ $dataOrder[$i]->tgl_order }}</td>
                                            </tr>
                                            
                                            
                                            
                                            
                                        </table>
                                    </td>
                                    <td style="width: 43%; vertical-align: top; padding-left: 30px;">
                                        <table width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-weight: 600; font-size: 14px;padding-bottom: 8px;">
                                                    Informasi Order:</td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; padding-bottom: 20px;">
                                                    <span
                                                        style="margin-bottom: 3px; font-weight: 600; display: block;">{{$dataOrder[$i]->fullname}}</span>
                                                    <div>
                                                        Produk : Kaos O-Neck <br>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                @endfor
                            </table>
                        <table width="100%" cellspacing="0" cellpadding="0"
                            style="border: thin solid #979797; border-bottom: none; border-radius: 4px; color: #343030; margin-top: 20px;">
                            <tr style="background-color: rgba(242, 242, 242, 0.74)">
                                <td style="font-weight: 600; font-size: 16px; padding: 10px;">Data Desain / Mockup
                                    (2 Item)</td>
                            </tr>

                            <tr>
                                <td>
                                    <table width="100%" style="font-size: 12px; padding: 10px 10px 0;">
                                        <tr>
                                            <td style="font-weight: 600;">Judul Item</td>
                                            <td style="font-weight: 600;padding-left: 30px;">Gambar</td>
                                        </tr>
                                        @for($i=0; $i < $countDesign; $i++)
                                        <tr>
                                            <td>Desain {{ $dataDesign[$i]->title }}</td>
                                            <td><img style="max-width: 600px; padding-left: 30px;" src="{{ asset($dataDesign[$i]->preview_image_design) }}" alt=""></td>
                                        </tr>
                                        @endfor
                                    </table>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table width="100%"
                                        style="border: thin solid #979797; border-left: none; border-right: none; border-radius: 4px; font-size: 14px;">
                                        
                                    </table>
                                </td>
                            </tr>

                            


                        </table>
                    </td>
                </tr>

                <!-- total pembayaran -->
                <tr>
                    <td>
                        <table width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width: 50%;"></td>
                                <td style="width: 50%;">
                                    <table width="100%"
                                        style="width: 430px; margin-top: 15px; padding: 15px; border-radius: 4px; background-color: rgba(242, 242, 242, 0.74); border: thin solid rgba(0, 0, 0, 0.54); font-size: 16px; font-weight: bold; color: #42b549">
                                        <tr>
                                            <td>Total Desain</td>
                                            
                                            <td style="text-align: right;"> {{ $countDesign }} Desain / Mockup</td>
                                            
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <!-- separator -->
            <div style="margin: 30px 0;">
                <div style="border-bottom: thin dashed #474747; margin-bottom: 10px;"></div>
                <div style="border-bottom: thin dashed #474747"></div>
            </div>
        </div>
        

        
            <div style="background: url(https://ecs7.tokopedia.net/img/invoice/paid-stamp.png) center no-repeat; background-size: contain; margin: auto; width: 790px;">
                
                <table width="100%" cellspacing="0" cellpadding="0"
                    style="width: 100%; padding: 25px 32px; color: #343030;">
                    <tr>
                        <td>
                            
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0"
                                style="border: thin dashed rgba(0, 0, 0, 0.34); border-radius: 4px; color: #343030; margin-top: 20px;">
                                <tr
                                    style="background-color: rgba(242, 242, 242, 0.74); font-size: 14px; font-weight: 600;">
                                    <td style="padding: 10px 15px;">Posisi</td>
                                    <td style="padding: 10px 15px; text-align: center;">Ukuran</td>
                                    <td style="padding: 10px 15px; text-align: center;">Material</td>
                                    <td style="padding: 10px 15px; text-align: center;">Printing</td>
                                    <td style="padding: 10px 15px; text-align: center; white-space: nowrap;">Jumlah Warna</td>
                                    <td style="padding: 10px 15px; text-align: right;">Preview</td>
                                </tr>

                                
                            @for ($i = 0; $i < $countArtwork ; $i++)
                                <tr style="font-size: 14px;">
                                    <td style="padding: 15px; font-weight: 600; word-break: break-word;">
                                       {{ $dataArtwork[$i]->artwork_position }}
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center;">
                                        {{ $dataArtwork[$i]->size }}
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center; white-space: nowrap;">
                                        {{ $dataArtwork[$i]->name_material}}
                                    </td>
                                    <td valign="top" style="padding: 15px; text-align: center; white-space: nowrap;">
                                        {{ $dataArtwork[$i]->name_printing }}
                                    </td>
                                    <td valign="top" style="padding: 15px; white-space: nowrap; text-align: center;">
                                       {{ $dataArtwork[$i]->color_qty_artwork }}
                                    </td>
                                    <td>
                                        <img style="max-width: 170px;" src="{{ asset($dataArtwork[$i]->preview_image_artwork) }}" alt="">
                                    </td>
                                </tr>
                    @endfor
                                


                                <tr>
                                    <td colspan="6" style="padding: 0 15px;">
                                        <div style="border-bottom: thin solid #e0e0e0"></div>
                                    </td>
                                </tr>


                            </table>
                        </td>
                    </tr>
                    
            
                    
                </table>
            </div>
            </td>
            </tr>
            </table>
        </div>
    </div>

<noscript><img src="https://www.tokopedia.com/akam/11/pixel_56f562b7?a=dD03ZWMxNGI3ZTVjMGZmMTEyZjMzM2E4NjlmNzc4ZjNmMTk2ZjFiOTAxJmpzPW9mZg==" style="visibility: hidden; position: absolute; left: -999px; top: -999px;" /></noscript><script type="text/javascript" >var _cf = _cf || [];  _cf.push(['_setFsp', true]);  _cf.push(['_setBm', true]);  _cf.push(['_setAu', '/webcontent/fafaae57ui184f3d4d3c539177c047']); </script><script type="text/javascript"  src="/webcontent/fafaae57ui184f3d4d3c539177c047"></script></body>

<script src="https://cdn.tokopedia.net/built/d1dd3126ee9ae2b8381ed123ca34b2a2.js" type="text/javascript"></script>
<script src="https://cdn.tokopedia.net/built/6b42e5043225d4bd57fb1d885f07b835.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function (event) {

        var qrcode = new QRCode("invoice_qr", {
            text: "",
            width: 200,
            height: 200,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        $('#invoice_qr').on('contextmenu', 'img', function (e) {
            return false;
        });
    });
</script>

</html>