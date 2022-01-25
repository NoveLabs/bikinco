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
                        <span>3 dari 5</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sc-page-content">
            <div class="uk-flex-center uk-grid-small" data-uk-grid>
                <div class="uk-width-4-5@l">
                    <div class="uk-flex uk-flex-middle uk-margin-bottom md-bg-blue-grey-600 sc-round sc-padding sc-padding-medium-ends">
                        <span data-uk-icon="icon: cart; ratio: 1.5" class="uk-margin-right md-color-white"></span>
                        <h4 class="md-color-white uk-margin-remove">Material & Aksesori Order (3/5)</h4>
                    </div>
                    <div class="uk-fieldset uk-fieldset-alt md-bg-white">
                        <div class="uk-card-body">
                            <form action="" method="" id="step-3-form">
                                <ul class="uk-accordion-outline" data-uk-accordion="multiple: true">
                                    <li class="uk-open">
                                        <h3 class="uk-accordion-title">Order 1 - Kaos V-Neck</h3>
                                        <div class="uk-accordion-content">
                                            <h5 style="margin-bottom: 0px;">Kebutuhan Material & Spesifikasi</h5>
                                            <small>Tidak dikenakan charge (Fix Cost pada harga produk)</small>
                                            <br><br>
                                            <div class="md-bg-grey-100 sc-padding">
                                                <div class="uk-overflow-auto">
                                                    <table class="uk-table uk-table-small uk-table-middle uk-table-divider uk-margin-remove"
                                                           id="sc-js-dynamic-fields-education">
                                                        <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="uk-text-nowrap">Material<sup>*</sup></th>
                                                            <th class="uk-text-nowrap">Klasifikasi<sup>*</sup></th>
                                                            <th class="uk-text-nowrap">Model<sup>*</sup></th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                    <div id="">
                                                        @foreach ($material_item['material_stocks'] as $key => $item)
                                                            <div class="uk-card-body">
                                                                <div class="uk-grid" data-uk-grid="">
                                                                    <div class="uk-width-1-3">
                                                                        <input class="uk-input" disabled
                                                                               value="{{ $material_item['suppliers'][$key][0]->pic_name }} - {{ $material_item['materials'][$key][0]->name }}"
                                                                               type="text" data-sc-input>
                                                                    </div>
                                                                    <div class="uk-width-1-3">
                                                                        <input class="uk-input" disabled
                                                                               value="{{ $material_item['material_item'][$key][0]->name }}"
                                                                               type="text" data-sc-input="outline">
                                                                    </div>
                                                                    <div class="uk-width-1-3">
                                                                        <div class="uk-form-controls">
                                                                            <select name="data_color_item[]"
                                                                                    data-sc-select2='{"placeholder": "Pilih Warna..."}'
                                                                                    class="uk-select data_access_chooser">
                                                                                <option value="0">Pilih Warna</option>
                                                                                @foreach($spec_color_items[$key] as $key => $item)
                                                                                    <option
                                                                                        value="{{ $item[0]->id }}">{{ $item[0]->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                            {{--                                            <hr>--}}
                                            @if(!empty($accessories_data))
                                                <h5 style="margin-bottom: 0px;">Kebutuhan Aksesori</h5>
                                                <small>Dikenakan charge (Biaya tambahan pada setiap unit produk)</small>
                                                <br><br>
                                                <div class="md-bg-grey-100 sc-padding">
                                                    <div class="uk-overflow-auto">
                                                        <div class="md-bg-grey-100 sc-padding"
                                                             id="sc-js-dynamic-fields-empl-history">
                                                            <div data-sc-dynamic-fields="emplHistoryTemplate"></div>
                                                            <script id="emplHistoryTemplate"
                                                                    type="text/x-handlebars-template">
                                                                <hr class="uk-margin-medium">
                                                                <div class="uk-grid-match sc-form-section" data-uk-grid>
                                                                    <div class="uk-width-expand@m">
                                                                        <div class="uk-child-width-1-2@s" data-uk-grid>
                                                                            <div>
                                                                                <label class="uk-form-label"
                                                                                       for="f-aksesori-">Pilih
                                                                                    Aksesori<sup>*</sup></label>
                                                                                <div class="uk-form-controls">
                                                                                    <select name="data_access_chooser[]"
                                                                                            onchange="updateDefault(this.value);"
                                                                                            data-sc-select2='{"placeholder": "Pilih aksesori..."}'
                                                                                            class="uk-select data_access_chooser">
                                                                                        <option value="">Pilih
                                                                                            aksesori...
                                                                                        </option>
                                                                                        @foreach($accessories_data as $item)
                                                                                            <option
                                                                                                value="{{ $item->id }}">{{ $item->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <label class="uk-form-label"
                                                                                       for="f-aksesori-title-">Jenis
                                                                                    Aksesori <sup>*</sup></label>
                                                                                <div class="uk-form-controls">
                                                                                    <select name="data_access_type[]"
                                                                                            onchange="getDefaultPrice(this.value);"
                                                                                            data-sc-select2='{"placeholder": "Pilih jenis..."}'
                                                                                            class="uk-select data_access_type">
                                                                                        <option value="">Pilih jenis...
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <label class="uk-form-label"
                                                                                       for="f-aksesori-title-">Catatan
                                                                                    aksesori</label>
                                                                                <div class="uk-form-controls">
                                                                                <textarea name="data_access_notes[]"
                                                                                          cols="10" rows="3"
                                                                                          class="uk-textarea"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div style="padding-top: 50px;">
                                                                                <label class="uk-form-label"
                                                                                       for="additional-price-">Informasi
                                                                                    Tambahan Harga :</label>
                                                                                <span
                                                                                    class="uk-badge data-price-target">Rp. 2.000</span>
                                                                                <small>/unit</small>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div
                                                                        class="uk-width-auto@m uk-flex-middle uk-text-center">
                                                                        <a href="#"
                                                                           class="sc-js-section-clone sc-color-primary"><i
                                                                                class="mdi mdi-plus-box-outline sc-icon-24 sc-js-el-hide"
                                                                                onclick="duplicateElements();"></i><i
                                                                                class="mdi mdi-minus-box-outline sc-icon-24 sc-js-el-show"></i></a>
                                                                    </div>
                                                                </div>
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
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
        let sub_acc_counter = 0;

        function updateDefault(id) {
            let acc_type = $('.data_access_type');

            let ajax = {
                type: "GET",
                url: 'source/data/product-spec-items/' + id,
                success: function (response) {
                    $(acc_type[sub_acc_counter]).empty();
                    $(acc_type[sub_acc_counter]).append("<option value=''>Pilih Salah Satu</option>");

                    for (let i in response.data.product_spec_item) {
                        if (response.data.product_spec_item.hasOwnProperty(i)) {
                            $(acc_type[sub_acc_counter]).append("<option value='" + response.data.product_spec_item[i].id + "'>" + response.data.product_spec_item[i].name + "</option>");
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            };

            performAjax(ajax);
        }

        function duplicatedUpdate(state, id) {
            let acc_type = $('.data_access_type');

            let ajax = {
                type: "GET",
                url: 'source/data/product-spec-items/' + id,
                success: function (response) {
                    $(acc_type[state]).empty();
                    $(acc_type[state]).append("<option value=''>Pilih Salah Satu</option>");

                    for (let i in response.data.product_spec_item) {
                        if (response.data.product_spec_item.hasOwnProperty(i)) {
                            $(acc_type[state]).append("<option value='" + response.data.product_spec_item[i].id + "'>" + response.data.product_spec_item[i].name + "</option>");
                        }
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            };

            performAjax(ajax);
        }

        function getDefaultPrice(id) {
            let price_target = $('.data-price-target');
            let ajax = {
                type: 'GET',
                url: 'source/data/product-spec-price/' + id,
                success: function (response) {
                    $(price_target[sub_acc_counter]).html(response.data.spec_price[0].price);
                },
                error: function (response) {
                    console.log(response);
                }
            }
            performAjax(ajax);
        }

        function getDuplicatedPrice(index, id) {
            let price_target = $('.data-price-target');
            let ajax = {
                type: 'GET',
                url: 'source/data/product-spec-price/' + id,
                success: function (response) {
                    $(price_target[index]).html(response.data.spec_price[0].price);
                },
                error: function (response) {
                    console.log(response);
                }
            };
            performAjax(ajax);
        }

        function duplicateElements() {
            $('.data_access_chooser').each(function (index) {
                $(this).attr('onchange', "duplicatedUpdate('" + index + "', this.value)");
            });

            $('.data_access_type').each(function (index) {
                $(this).attr('onchange', "getDuplicatedPrice('" + index + "', this.value)");
            });

            sub_acc_counter++;
        }

        $('#step-3-form').submit(function (evt) {
            evt.preventDefault();
            let washing_state = $('.data_has_washing').is(':checked') === true ? '1' : '0';
            let session = "{{ $sessions }}";

            let formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('data_has_washing', washing_state);
            formData.append('session', session);

            let ajax = {
                type: 'POST',
                url: "{{ route('foc.save.3') }}",
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
