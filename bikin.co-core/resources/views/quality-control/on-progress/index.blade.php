@extends('layouts.app')

@section('content')
    <!-- Main Content -->
    <div id="sc-page-wrapper">
        <div id="sc-page-content">
            <div class="uk-alert-icon" data-uk-alert>
                <a class="uk-alert-close" data-uk-close></a>
                <div class="uk-flex uk-flex-middle">
                    <i class="mdi mdi-bullhorn sc-icon-32 uk-margin-right"></i>
                    <div class="uk-alert-content">
                        <h5>Pada halaman ini terdapat data order dalam pengiriman</h5>
                        <p>Anda dapat memantau status order anda.</p>
                    </div>
                </div>
            </div>
            <div class="uk-grid" data-uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-card uk-margin">
                        <div class="uk-flex-middle sc-padding sc-padding-medium-ends uk-grid-small" data-uk-grid>
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">Daftar Order Dalam Pengiriman</h3>
                            </div>

                        </div>
                        <hr class="uk-margin-remove">
                        <div class="uk-card-body">
                            <table id="data-qc-shipment-progress-table" class="uk-table uk-table-striped dt-responsive">
                                <thead>
                                <tr>
                                    <th>Tindakan</th>
                                    <th>Order ID</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Prioritas</th>
                                    <th>Qty</th>
                                    <th>Tanggal Order</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL : Edit Detail -->
    <div id="shipment-detail-modal" data-uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" data-uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Detail Order</h2>
            </div>
            <div class="uk-modal-body">
                <span class="sc-list-secondary-text">Informasi Order</span>
                <hr class="uk-margin-medium uk-margin-top-mini">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="custom-detail-list-box">
                            <ul class="uk-list custom-inline-list">
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">No. Order</p>
                                        <span class="sc-list-secondary-text data_order_id">order_id</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Pelanggan</p>
                                        <span class="sc-list-secondary-text data_customer_name">customer_name</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Produk</p>
                                        <span class="sc-list-secondary-text data_product">product</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Qty</p>
                                        <span class="sc-list-secondary-text data_qty">qty</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Prioritas</p>
                                        <span class="sc-list-secondary-text data_priority">priority</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Tanggal Order</p>
                                        <span class="sc-list-secondary-text data_order_date">order_date</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <span class="sc-list-secondary-text">Informasi Pengiriman</span>
                <hr class="uk-margin-medium uk-margin-top-mini">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="custom-detail-list-box">
                            <ul class="uk-list custom-inline-list">
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Pilihan Pengiriman</p>
                                        <span class="sc-list-secondary-text data_expedition">expedition</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">No. Resi</p>
                                        <span class="sc-list-secondary-text data_receipt_no">receipt_no</span>
                                    </div>
                                </li>
                                <li class="sc-list-group">
                                    <div class="sc-list-body">
                                        <p class="uk-margin-remove sc-text-semibold">Total Berat</p>
                                        <span class="sc-list-secondary-text data_weight_total">weight_total</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <br>
                <span class="sc-list-secondary-text">Status Pengiriman</span>
                <hr class="uk-margin-medium uk-margin-top-mini">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="custom-detail-list-box">
                            <ul class="uk-list uk-list-divider uk-first-column">
                                <li class="sc-list-group">
                                    <div class="sc-list-addon"> Sabtu, 14 Mar 2021 12:45 <br><span class="uk-label uk-label-success track-modal">Paket Dikirim</span></div>
                                    <div class="sc-list-body">
                                        Paket Dikirim
                                        <small>Paket akan segera di pick-up oleh kurir</small>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-modal-footer">
                <div class="uk-grid" data-uk-grid>
                    <div class="uk-width-1-1@l uk-width-1-1@s">
                        <div class="uk-text-right">
                            <button class="sc-button sc-button-flat sc-button-flat-danger uk-modal-close" type="button">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/private/script.js') }}"></script>
    <script>
        let table = $('#data-qc-shipment-progress-table').DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            ajax: "{{ route('qc.shipment.on-progress') }}",
            columns: [
                {data: 'action', name: 'action', title: 'Tindakan', orderable: false, searchable: false},
                {data: 'order_id', name: 'order_id', title: 'Order ID'},
                {data: 'customers', name: 'customers', title: 'Pelanggan'},
                {data: 'product', name: 'product', title: 'Produk'},
                {data: 'priority', name: 'priority', title: 'Prioritas'},
                {data: 'quantity', name: 'quantity', title: 'Qty'},
                {data: 'order_date', name: 'order_date', title: 'Tanggal Order'},
            ],
        });

        // getOrderShipmentInfo
        function getOrderShipmentInfo(id)
        {
            // Declare Elements
            let elements = {
                order_id: $('.data_order_id'),
                customer: $('.data_customer_name'),
                product: $('.data_product'),
                priority: $('.data_priority'),
                quantity: $('.data_qty'),
                order_date: $('.data_order_date'),
                expedition: $('.data_expedition'),
                weight_total: $('.data_weight_total'),
                receipt: $('.data_receipt_no')
            };

            let ajax = {
                type: 'GET',
                url: "{{ url('/') }}/shipment/list/on-progress/" + id,
                success: function (response) {
                    // Declare Data
                    let orders = response.data.orders[0],
                        shipments = response.data.shipment[0],
                        product = response.data.product[0],
                        customer = response.data.customer[0];

                    // Write Data
                    $(elements.order_id).html(orders.id);
                    $(elements.customer).html(customer.fullname);
                    $(elements.product).html(product.name);
                    $(elements.priority).html(orders.is_priority === 0 ? "<span class='uk-label'>Tidak Prioritas</span>" : "<span class='uk-label uk-label-danger'>Prioritas</span>");
                    $(elements.quantity).html(orders.total_item + " Pcs");
                    $(elements.order_date).html(new Date(orders.order_date).toLocaleString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }));
                    $(elements.expedition).html(shipments.expedition_name);
                    $(elements.weight_total).html(shipments.weight + " Kg");
                    $(elements.receipt).html(shipments.no_resi);

                    return UIkit.modal($('#shipment-detail-modal')).show();
                },
                error: function(error) {
                    console.log(error);
                }
            };

            performAjax(ajax);
        }

        function performAjax(data)
        {
            return $.ajax(data);
        }


    </script>
@endpush


