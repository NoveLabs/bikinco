@extends('layouts.app')

@section('content')
    <div id="sc-page-wrapper">
        <div id="sc-page-top-bar" class="sc-top-bar">
            <div class="sc-top-bar-content uk-flex uk-flex-middle uk-width-1-1">
                <ul class="uk-breadcrumb uk-margin-remove uk-flex uk-flex-middle">
                    <li>
                        <a href="so-beranda.html">
                            <i class="mdi mdi-home"></i>
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-waiting-customer.html">
                            Order Produk
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create.html">
                            Form Input Order 1 dari 5
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create-2.html">
                            2 dari 5
                        </a>
                    </li>
                    <li>
                        <a href="so-product-order-create-3.html">
                            3 dari 5
                        </a>
                    </li>
                    <li>
                        <span>4 dari 5</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sc-page-content">
            <div class="uk-flex-center uk-grid-small" data-uk-grid>
                <div class="uk-width-4-5@l">
                    <div class="uk-flex uk-flex-middle uk-margin-bottom md-bg-blue-grey-600 sc-round sc-padding sc-padding-medium-ends">
                        <span data-uk-icon="icon: cart; ratio: 1.5" class="uk-margin-right md-color-white"></span>
                        <h4 class="md-color-white uk-margin-remove">Form Tambahan Biaya & Metode Bayar (4/5)</h4>
                    </div>
                    <div class="uk-fieldset uk-fieldset-alt md-bg-white">
                        <div class="uk-card-body">
                            <form action="" method="" id="form-step-4">
                                <div class="uk-accordion-content">
                                    <h5>Tambahan Biaya</h5>
                                    <div class="md-bg-grey-100 sc-padding">
                                        <div class="uk-overflow-auto">
                                            <table class="uk-table uk-table-small uk-table-middle uk-table-divider uk-margin-remove"
                                                   id="sc-js-dynamic-fields-education">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="uk-text-nowrap">Item</th>
                                                    <th class="uk-text-nowrap">Harga</th>
                                                    <th class="uk-text-nowrap">Jumlah</th>
                                                    <th class="uk-text-nowrap">Total</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody data-sc-dynamic-fields="educationTemplate"></tbody>
                                            </table>
                                            <script id="educationTemplate" type="text/x-handlebars-template">
                                                <tr class="sc-form-section">
                                                    <td class="sc-js-edu-counter">1</td>
                                                    <td class="uk-width-1-3">
                                                        <input type="text"
                                                               class="uk-input uk-form-small data_price_title"
                                                               name="data_price_title[]"/>
                                                    <td>
                                                        <input class="uk-input uk-form-small data_price_amount"
                                                               data-sc-input="outline"
                                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''"
                                                               oninput="calculatePrice('default');"
                                                               name="data_price_amount[]"/>
                                                    </td>
                                                    <td>
                                                        <input class="uk-input uk-form-small data_price_qty"
                                                               oninput="calculatePrice('default');"
                                                               data-sc-input="outline"
                                                               data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''"
                                                               name="data_price_qty[]"/>
                                                    </td>
                                                    <td>
                                                        <input type="text"
                                                               class="uk-input uk-form-small data_price_total" value="0"
                                                               disabled readonly name="data_price_total[]"/>
                                                    </td>
                                                    <td class="uk-table-middle uk-text-center">
                                                        <a href="#" class="sc-js-section-clone sc-color-primary"><i
                                                                    class="mdi mdi-plus sc-icon-24 sc-js-el-hide"
                                                                    onclick="duplicateElements();"></i><i
                                                                    class="mdi mdi-minus sc-icon-24 sc-js-el-show"
                                                                    onclick="updateTotalPrice();"></i></a>
                                                    </td>
                                                </tr>
                                            </script>
                                            <div>
                                                <p class="data_subtotal_target"
                                                   style="text-align: right; margin-right: 50px;">Total Tambahan Biaya
                                                    Rp. 0</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Metode Bayar</h5>
                                    <div class="uk-grid-small" data-uk-grid>
                                        <div class="uk-width-1-3@s uk-width-1-4@m">
                                            <ul class="uk-list uk-list-condensed">
                                                <li>
                                                    <input type="radio" id="none" name="f-payment" value="0"
                                                           data-sc-icheck data-payment-info="more-info-paypal" checked>
                                                    <label>Pembayaran Penuh</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="f-pay-moneybookers" name="f-payment"
                                                           value="1" data-sc-icheck
                                                           data-payment-info="more-info-skrill">
                                                    <label for="f-pay-moneybookers">Down Payment (DP)</label>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="uk-width-2-3@s uk-width-3-4@m more-info-section">
                                            <div style="display: none" id="more-info-skrill">
                                                <label class="uk-form-label" for="f-pay-skrill-name">Masukkan nilai down
                                                    payment...</label>
                                                <input class="uk-input data-price-style" id="f-pay-skrill-name"
                                                       data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'prefix': '', 'placeholder': ''"
                                                       data-sc-input="outline" name="data_payment_amount">
                                                <hr>
                                                <div>
                                                    <input type="radio" id="none" name="f-payment-type" value="0"
                                                           checked data-sc-icheck data-payment-info="more-info-paypal">
                                                    <label style="margin-right: 30px;">Rupiah (Rp.)</label>

                                                    <input type="radio" id="none" name="f-payment-type" value="1"
                                                           data-sc-icheck data-payment-info="more-info-paypal">
                                                    <label>Prosen (%)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="uk-margin-top">
                                    <a href="{{ route('foc.form.flush') }}"
                                       class="sc-button sc-button-primary sc-button-large">Kembali
                                    </a>
                                </div>
                                <div class="sc-fab-page-wrapper">
                                    <button type="submit" class="sc-fab sc-fab-large md-bg-light-blue-700 sc-fab-dark">
                                        <i class="mdi mdi-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let calc_itr = 0;


        function calculatePrice(type) {
            let data_price_amount = $('.data_price_amount'),
                data_price_qty = $('.data_price_qty'),
                data_price_total = $('.data_price_total');

            if (type === 'default') {
                $(data_price_total[calc_itr]).val($(data_price_amount[calc_itr]).val() * $(data_price_qty[calc_itr]).val());
                generateSubtotalPrice();
            }

            $(data_price_total[type]).val($(data_price_amount[type]).val() * $(data_price_qty[type]).val());
            generateSubtotalPrice();
        }

        function duplicateElements() {
            $('.data_price_amount').each(function (index) {
                $(this).attr('oninput', "calculatePrice(" + index + ")");
            });

            $('.data_price_qty').each(function (index) {
                $(this).attr('oninput', "calculatePrice(" + index + ")");
            });

            calc_itr++;
        }

        function generateSubtotalPrice() {
            let total_data = 0;
            let subtotal_price_target = $('.data_subtotal_target'),
                data_price_total = $('.data_price_total');

            $(data_price_total).each(function (index) {
                total_data += Number($(this).val());
            });

            $(subtotal_price_target).html("Total Tambahan Biaya  Rp. " + total_data.toLocaleString('id-ID'));


        }

        function updateTotalPrice() {
            let total_data = 0;
            let subtotal_price_target = $('.data_subtotal_target'),
                data_price_total = $('.data_price_total');

            $(data_price_total).each(function (index) {
                total_data += Number($(this).val());
            });

            $(subtotal_price_target).html("Total Tambahan Biaya  Rp. " + total_data.toLocaleString('id-ID'));
            calc_itr--;
        }

        $('#form-step-4').submit(function (evt) {
            evt.preventDefault();

            let formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('session', "{{ $sessions }}");

            let ajax = {
                type: 'POST',
                url: "{{ route('foc.save.4') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    location.reload();
                    // console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            };

            performAjax(ajax);
        });


        function performAjax(data) {
            return $.ajax(data);
        }

    </script>
@endpush
