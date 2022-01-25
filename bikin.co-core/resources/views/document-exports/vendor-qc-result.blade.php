@extends('document-exports.layouts.main')

@section('document.content')
    <div class="main-page no-padding" page-title="preambule">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>Hasil QC</span><br>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-1234</p>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info text-right">
                        <img class="header-image"
                             src="{{ asset('print_exports/samples/img/logo/company_logo.png') }}"
                             alt="Bikin.co Company Logo">
                    </div>
                </li>
            </ul>
        </div>
        <div class="page-body">
            <div class="bill-material-content">
                <div class="page-container">
                    <table class="page-table table-default">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th class="text-left">Proses</th>
                            <th>Sudah Dilakukan</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">QC Jahitan</span><br>
                                    <span>Pengecekan kerapihan dan kesesuaian jahitan.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">Trimming</span><br>
                                    <span>Pebersihan sisa benang.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">Zero Defect</span><br>
                                    <span>Pemeriksaan keseluruhan, apakah ada cacat produk.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">Ironing</span><br>
                                    <span>Setrika Pakaian.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">Folding &amp; Packing</span><br>
                                    <span>Melipat dan pengemasan pakaian.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td class="text-left">
                                <div>
                                    <span class="text-bold">Size Sorting</span><br>
                                    <span>Pemeriksaan Kesesuaian Ukuran dan Quantity.</span>
                                </div>
                            </td>
                            <td>
                                <div style="width: 5mm;height: 5mm;border: 1px solid;"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="page-footer" style="padding: 0mm 10mm 5mm 10mm;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="address-container">
                        <address class="address-title official-color no-margin-top">PT.Bikin Indonesia Berdaya
                        </address>
                        <address class="address-content">
                            3rd Floor, Grha Environesia Jalan Jati Mataram 248 B,
                            Sleman, D.I. Yogyakarta, 55582, Indonesia
                        </address>
                    </div>
                </li>
                <li class="list-grid-4 small-padding-left">
                    <ul class="page-list">
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-phone"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>+62 274 88 0603 (Ext.4)</span><br>
                                        <span>+62 852 8888 6020</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-envelope"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>info@bikin.co</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="list-grid-12">
                            <ul class="page-list">
                                <li class="list-grid-1 official-color"><span class="lni lni-world"></span></li>
                                <li class="list-grid-11">
                                    <div class="footer-content">
                                        <span>www.bikin.co</span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="list-grid-4"></li>
            </ul>
        </div>
    </div>
@endsection
