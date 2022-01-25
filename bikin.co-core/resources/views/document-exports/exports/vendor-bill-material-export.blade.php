@extends('document-exports.layouts.main-export')

@section('document.content')
    <div class="main-page no-padding" page-title="preambule">
        <div class="page-header" style="padding: 10mm 10mm 0;">
            <ul class="page-list">
                <li class="list-grid-4">
                    <div class="document-label" style="padding: 3mm 4mm 3mm 4mm;">
                        <span>Bill Material</span><br>
                    </div>
                </li>
                <li class="list-grid-4">
                    <div class="document-info small-padding-left">
                        <h4>No. Order:</h4>
                        <p>BP-{{ $orders[0]->id }}</p>
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
                    <div>
                        <h4>{{ $products[0]->name }}</h4>
                        <p>{{ $categories[0]->name }} - {{ $subcategories[0]->name }}</p>
                    </div>
                    <br>
                    <br>
                    <table class="page-table table-default">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Material</th>
                            <th>Tipe</th>
                            <th>Warna</th>
                            <th>Supplier</th>
                            <th>Qty</th>
                            <th>Kebutuhan</th>
                            <th>Total Kebutuhan</th>
                            <th>Sample</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$materials->isEmpty())
                            @foreach($materials as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $material_item[$key][0]->name }}</td>
                                    <td>{{ $material_data[$key][0]->name }}</td>
                                    <td>{{ !empty($material_color[$key][0]->name) ? $material_color[$key][0]->name : '-' }}</td>
                                    <td>{{ $suppliers[$key][0]->company_name }}</td>
                                {{-- <td>{{ ($material_spec[$key]->qty * $item->qty) }}</td> --}} <!-- Gunakan ini jika tag dibawah tidak digunakan -->
                                    <td>{{ ($item->qty) }}</td>
                                    <td>{{ $material_spec[$key]->qty }} {{ $material_size[$key][0]->name }}</td>
                                    <td>{{ ($item->qty * $material_spec[$key]->qty) }} {{ $material_size[$key][0]->name }}</td>
                                    <td>
                                        <div style="width: 3cm;height: 2cm;border: 1px solid;"></div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
