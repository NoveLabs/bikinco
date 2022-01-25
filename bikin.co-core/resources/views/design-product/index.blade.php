@extends('layouts.app')

@section('content')
    <div id="sc-page-wrapper">
        <div id="sc-page-content">
            <div class="uk-child-width-1-4@xl uk-child-width-1-2@s" data-uk-grid>
                <div>
                    <div class="uk-card">
                        <a href="product-design-spk-product.html"
                            class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">SPK of Product</h3>
                                <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen Data SPK Produk
                                </p>
                            </div>
                            <div
                                class="md-bg-indigo-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                                <i class="mdi mdi-webpack md-color-white"></i>
                            </div>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="uk-card">
                        <a href="product-design-spk-design.html"
                            class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
                            <div class="uk-flex-1">
                                <h3 class="uk-card-title">SPK of Design</h3>
                                <p class="sc-color-secondary uk-margin-remove uk-text-medium">Manajemen Data SPK Desain
                                </p>
                            </div>
                            <div
                                class="md-bg-cyan-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
                                <i class="mdi mdi-brush md-color-white"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    
	@push('scripts')
        <script>
            $(document).ready(function () {
                $('#pd').addClass("sc-page-active");
            });
        </script>
    @endpush
