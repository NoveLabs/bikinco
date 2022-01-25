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
                        <span>Form Input Order 1 dari 5</span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="sc-page-content">
            <div class="uk-flex-center uk-grid-small" data-uk-grid>
                <div class="uk-width-4-5@l">
                    <div class="uk-flex uk-flex-middle uk-margin-bottom md-bg-blue-grey-600 sc-round sc-padding sc-padding-medium-ends">
                        <span data-uk-icon="icon: cart; ratio: 1.5" class="uk-margin-right md-color-white"></span>
                        <h4 class="md-color-white uk-margin-remove">Pilih Pelanggan & Produk (1/5).</h4>
                    </div>
                    <form action="" method="" id="step-1-foc-form">
                        <fieldset class="uk-fieldset uk-fieldset-alt md-bg-white">
                            <input type="hidden" name="session" value="{{ $sessions }}">
                            <legend class="uk-legend">Pilih Pelanggan</legend>
                            <div class="uk-child-width-1-1@m" data-uk-grid>
                                <div>
                                    <label class="uk-form-label" for="f-address-city">Pilih
                                        Pelanggan.<sup>*</sup></label>
                                    <select name="customer_id" onchange="loadCustomerInfo({data: this.value});"
                                            id="f-address-city"
                                            data-sc-select2='{"placeholder": "Masukkan nama atau ID Pelanggan..."}'
                                            class="uk-select">
                                        <option value="0">Pilih pelanggan...</option>
                                        @foreach($customers as $item)
                                            <option value="{{ $item->id }}">{{$customer_prefix.$item->id}}
                                                - {{ $item->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="data-disabled-box" style="display: none">
                                <div class="uk-child-width-1-2@m" data-uk-grid>
                                    <div>
                                        <label class="uk-form-label" for="f-f-name">Nama Lengkap</label>
                                        <input class="uk-input data-disabled-fullname" id="f-f-name" type="text"
                                               value="Rizki Kartika" disabled data-sc-input>
                                    </div>
                                    <div>
                                        <label class="uk-form-label" for="f-l-name">Klaster</label>
                                        <input class="uk-input data-disabled-cluster" id="f-l-name" type="text"
                                               value="PNS" disabled data-sc-input>
                                    </div>
                                </div>
                                <div class="uk-child-width-1-2@m" data-uk-grid>
                                    <div>
                                        <label class="uk-form-label" for="f-address-billing">Provinsi</label>
                                        <input class="uk-input data-disabled-province" id="f-address-billing"
                                               type="text" value="D. I .Yogyakarta" disabled data-sc-input>
                                    </div>
                                    <div>
                                        <label class="uk-form-label" for="f-address-postal">Kabupaten/Kota`</label>
                                        <input class="uk-input data-disabled-distict" id="f-address-postal" type="text"
                                               value="Kulon Progo" disabled data-sc-input>
                                    </div>
                                </div>
                                <div class="uk-child-width-1-2@m" data-uk-grid>
                                    <div>
                                        <label class="uk-form-label" for="f-company">Instansi</label>
                                        <input class="uk-input data-disabled-company-name" id="f-company" type="text"
                                               value="Pemprov Kota Yogyakarta" disabled data-sc-input>
                                    </div>
                                    <div>
                                        <label class="uk-form-label" for="f-company-id">Repeat Order?</label>
                                        <input class="uk-input data-disabled-latest-order" id="f-company-id" type="text"
                                               value="Ya" disabled data-sc-input>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="uk-fieldset uk-fieldset-alt md-bg-white">
                            <legend class="uk-legend">Pilih Produk</legend>
                            <div class="uk-child-width-1-2@m" data-uk-grid>
                                <div>
                                    <label class="uk-form-label" for="choose-category-a">Pilih
                                        Kategori<sup>*</sup></label>
                                    <select name="category_id" id="choose-category-a"
                                            onchange="loadSubcategory({source: this.value});"
                                            class="data-select-category"
                                            data-sc-select2='{"placeholder": "Masukkan nama atau ID Pelanggan..."}'
                                            class="uk-select">
                                        <option value="0">Pilih kategori...</option>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="uk-form-label" for="choose-subcategory">Pilih Subkategori<sup>*</sup></label>
                                    <select name="subcategory_id" id="choose-subcategory"
                                            class="data-select-subcategory"
                                            onchange="loadProducts({source: this.value});"
                                            data-sc-select2='{"placeholder": "Pilih Subkategori..."}' class="uk-select">
                                        <option value="">Pilih Subkategori...</option>

                                    </select>
                                </div>
                            </div>
                            <div class="uk-child-width-1-1@m" data-uk-grid>
                                <div>
                                    <label class="uk-form-label" for="choose-category">Pilih Produk<sup>*</sup></label>
                                    <select name="product_id" id="choose-category" class="uk-select data-select-product"
                                            onchange="loadSizeChart({source: this.value});"
                                            data-sc-select2='{"placeholder": "Pilih produk..."}'>
                                        <option value="">Pilih produk...</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="uk-fieldset uk-fieldset-alt md-bg-white order-counter-fieldset"
                                  style="display: none;">
                            <legend class="uk-legend">Informasi Jumlah Order</legend>
                            <div class="md-bg-grey-100 sc-padding">
                                <div class="uk-overflow-auto">
                                    <table class="uk-table uk-table-small uk-table-middle uk-table-divider uk-margin-remove"
                                           id="sc-js-dynamic-fields-education">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th class="uk-text-nowrap">Ukuran<sup>*</sup></th>
                                            <th class="uk-text-nowrap">Jenis<sup>*</sup></th>
                                            <th class="uk-text-nowrap">Jumlah<sup>*</sup></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody data-sc-dynamic-fields="sizeChartFormSet"></tbody>
                                    </table>
                                    <script type="text/x-handlebars-template" id="sizeChartFormSet">
                                        <tr class="sc-form-section">
                                            <td class="sc-js-edu-counter">1</td>
                                            <td class="uk-width-1-3">
                                                <select class="uk-select data-select-product-sizes" data-select-set=""
                                                        name="size_id[]"
                                                        data-sc-select2='{"placeholder": "Pilih ukuran..."}'>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="uk-select data-select-product-type"
                                                        name="size_type_id[]"
                                                        data-sc-select2='{"placeholder": "Pilih tipe produk..."}'>
                                                    <option value="0">Pilih jenis produk...</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="uk-input uk-form-small" name="qty[]"/>
                                            </td>
                                            <td class="uk-table-middle uk-text-center">
                                                <a href="#" class="sc-js-section-clone sc-color-primary"><i
                                                            class="mdi mdi-plus sc-icon-24 sc-js-el-hide"
                                                            onclick="duplicateSizeChartData();"></i><i
                                                            class="mdi mdi-minus sc-icon-24 sc-js-el-show"></i></a>
                                            </td>
                                        </tr>
                                    </script>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="uk-fieldset uk-fieldset-alt md-bg-white">
                            <legend class="uk-legend">Pilih Prioritas</legend>
                            <div class="uk-overflow-auto">
                                <table class="uk-table uk-table-striped uk-table-small uk-table-middle">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="uk-text-center uk-text-nowrap uk-table-shrink uk-table-middle">
                                            Normal
                                        </th>
                                        <th class="uk-text-center uk-text-nowrap uk-table-shrink uk-table-middle">
                                            Prioritas
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="uk-text-nowrap">Pilih prioritas order</td>
                                        <td class="uk-text-center"><input type="radio" value="0" id="f-eval-table-0-1"
                                                                          checked name="data_order_priority"
                                                                          data-sc-icheck></td>
                                        <td class="uk-text-center"><input type="radio" value="1" id="f-eval-table-0-2"
                                                                          name="data_order_priority" data-sc-icheck>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>

                        <div class="uk-margin-large-top">
                            <div class="sc-fab-page-wrapper" style="z-index: 1200;">
                                <button type="submit" class="sc-fab sc-fab-large md-bg-light-blue-700 sc-fab-dark">
                                    <i class="mdi mdi-arrow-right"></i>
                                </button>
                            </div>
                            <a href="{{ route('foc.form.flush') }}">
                                <button type="button"
                                        class="sc-button sc-button-default sc-button-large sc-button-flat">
                                    Batal
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let tableRowCounter = 0;

        function loadCustomerInfo(data) {
            let disabledBox = $('.data-disabled-box');
            let disabledFullName = $('.data-disabled-fullname');
            let disabledCluster = $('.data-disabled-cluster');
            let disabledProvince = $('.data-disabled-province');
            let disabledDistrict = $('.data-disabled-distict');
            let disabledCompanyName = $('.data-disabled-company-name');
            let disabledLatestOrder = $('.data-disabled-latest-order');

            // Hide Wrapper Box
            disabledBox.css('display', 'none');

            let ajax = {
                url: 'source/data/customer/' + data.data,
                success: function (response) {
                    console.log(response);
                    let customer = response.data.customers[0];
                    let cluster = response.data.cluster[0];
                    let cities = response.data.cities[0];
                    let location = response.data.province[0];

                    disabledFullName.val(customer.fullname);
                    disabledCluster.val(cluster.name);
                    disabledProvince.val(location.name);
                    disabledDistrict.val(cities.name);
                    disabledCompanyName.val(customer.company_name);

                    if (customer.latest_ordering === 0) {
                        disabledLatestOrder.val('Tidak');
                    } else {
                        disabledLatestOrder.val('Ya');
                    }

                    disabledBox.css('display', 'block');

                },
                error: function (response) {
                    console.log('Error');
                }
            };

            return performAjax(ajax);
        }

        function loadSubcategory(data) {
            let subCategoryContainer = $('.data-select-subcategory');

            if (data.source === '0') {
                subCategoryContainer.empty();
                // subCategoryContainer.append("");
                // subCategoryContainer.append("<option selected value='0'>Silakan Pilih Kategori</option>");

            } else {
                // Empty Content
                subCategoryContainer.empty();

                let ajax = {
                    url: 'source/data/subcategory/' + data.source,
                    success: function (response) {
                        subCategoryContainer.append("<option value='0'>Pilih Subkategori</option>");
                        console.log(response.data.subcategory);
                        for (let i in response.data.subcategory) {
                            if (response.data.subcategory.hasOwnProperty(i)) {
                                let selectContent = "<option value='" + response.data.subcategory[i].id + "'>" + response.data.subcategory[i].name + "</option>";
                                subCategoryContainer.append(selectContent);
                            }
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                };

                return performAjax(ajax);
            }
        }

        function loadProducts(data) {
            let subCategoryContainer = $('.data-select-product');

            if (data.source === '0') {
                subCategoryContainer.empty();

            } else {
                // Empty Content
                subCategoryContainer.empty();

                let ajax = {
                    url: 'source/data/product/' + data.source,
                    success: function (response) {
                        subCategoryContainer.append("<option value='0'>Pilih Produk</option>");
                        for (let i in response.data.product) {
                            if (response.data.product.hasOwnProperty(i)) {
                                let selectContent = "<option value='" + response.data.product[i].id + "'>" + response.data.product[i].name + "</option>";
                                subCategoryContainer.append(selectContent);
                            }
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                };

                return performAjax(ajax);
            }
        }

        function loadSizeChart(data) {
            let category = $('.data-select-category');
            let subCategoryContainer = $('.data-select-product-sizes');
            let productContainer = $('.data-select-product-type');

            if (data.source === '0') {
                subCategoryContainer.empty();
                productContainer.empty();
                $(subCategoryContainer[0]).attr('data-size-source', data.source);
                $('.order-counter-fieldset').css('display', 'none');

            } else {
                // Empty Content
                subCategoryContainer.empty();
                $(subCategoryContainer[0]).attr('data-size-source', data.source);
                $('.order-counter-fieldset').css('display', 'block');

                let ajax = {
                    url: 'source/data/size/' + $(category).val(),
                    success: function (response) {
                        subCategoryContainer.append("<option value='0'>Pilih Ukuran Produk</option>");
                        for (let i in response.data.size) {
                            if (response.data.size.hasOwnProperty(i)) {
                                let selectContent = "<option value='" + response.data.size[i].id + "'>" + response.data.size[i].name + "</option>";
                                subCategoryContainer.append(selectContent);
                            }
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                };

                loadProductType(data);
                return performAjax(ajax);
            }
        }

        function loadProductType(data) {
            let category = $('.data-select-category');
            let subCategoryContainer = $('.data-select-product-type');

            if (data.source === '0') {
                subCategoryContainer.empty();
                $(subCategoryContainer[0]).attr('data-product-type-source', data.source);

            } else {
                // Empty Content
                subCategoryContainer.empty();
                $(subCategoryContainer[0]).attr('data-product-type-source', data.source);

                let ajax = {
                    url: 'source/data/size-type/' + $(category).val(),
                    success: function (response) {
                        subCategoryContainer.empty();
                        subCategoryContainer.append("<option value='0'>Pilih Tipe Product</option>");
                        for (let i in response.data.size_type) {
                            if (response.data.size_type.hasOwnProperty(i)) {
                                let selectContent = "<option value='" + response.data.size_type[i].id + "'>" + response.data.size_type[i].name + "</option>";
                                subCategoryContainer.append(selectContent);
                            }
                        }

                    },
                    error: function (response) {
                        console.log(response);
                    }
                };

                return performAjax(ajax);
            }
        }

        function duplicateSizeChartData() {
            tableRowCounter++;
            updateSelectContent(tableRowCounter);
            // console.log(tableRowCounter);
        }

        function updateSelectContent(iteration) {
            let elem = $('.data-select-product-sizes');
            let productTypeElem = $('.data-select-product-type');
            let dataSizechart = $(elem[0]).attr('data-size-source');
            let category = $('.data-select-category');
            let productType = $(productTypeElem[0]).attr('data-product-type-source');

            let ajaxSizechart = {
                url: 'source/data/size/' + $(category).val(),
                success: function (response) {
                    console.log(iteration);

                    $('.data-select-product-sizes').each(function (index, value) {
                        // console.log('Object '+index+' : '+value);
                        let itr = 0;

                        if (index === 0) return;
                        if (index === itr) return;


                        $(this).append("<option value='0'>Pilih Ukuran Produk</option>");

                        for (let i in response.data.size) {
                            if (response.data.size.hasOwnProperty(i)) {

                                let selectContent = "<option value='" + response.data.size[i].id + "'>" + response.data.size[i].name + "</option>";
                                $(this).append(selectContent);
                            }
                        }

                        itr++;
                    });


                },
                error: function (response) {
                    console.log(response);
                }
            };


            let ajaxProductType = {
                url: 'source/data/size-type/' + $(category).val(),
                success: function (response) {
                    console.log(iteration);

                    $('.data-select-product-type').each(function (index, value) {
                        let itr = 0;

                        if (index === 0) return;
                        if (index === itr) return;


                        $(this).append("<option value='0'>Pilih Jenis Produk</option>");

                        for (let i in response.data.size_type) {
                            if (response.data.size_type.hasOwnProperty(i)) {
                                let selectContent = "<option value='" + response.data.size_type[i].id + "'>" + response.data.size_type[i].name + "</option>";
                                $(this).append(selectContent);
                            }
                        }

                        itr++;
                    });


                },
                error: function (response) {
                    console.log(response);
                }
            };
            performAjax(ajaxSizechart);
            performAjax(ajaxProductType);

        }

        $('#step-1-foc-form').submit(function (evt) {
            evt.preventDefault();

            let formData = new FormData(this);
            formData.append('_token', "{{ csrf_token() }}");

            let ajax = {
                type: 'POST',
                url: "{{ route('foc.save.1') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === true && response.code === 200) {
                        return location.reload();
                    }
                    // console.log(response);
                },
                error: function (response) {
                    console.log(response);
                }
            };

            performAjax(ajax);

        });


        // Global Function
        function performAjax(reference) {
            return $.ajax(reference);
        }


    </script>
@endpush
