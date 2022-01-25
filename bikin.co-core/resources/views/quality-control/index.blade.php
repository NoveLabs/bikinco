@extends('layouts.app')

@section('content')
	<div id="sc-page-wrapper">
		<div id="sc-page-content">
			<div class="uk-child-width-1-4@xl uk-child-width-1-2@s" data-uk-grid>
				<div>
					<div class="uk-card">
						<a href="quality-control-validasi-sample-artwork.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Validasi Sample Artwork</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Validasi Sample Artwork
								</p>
							</div>
							<div
								class="md-bg-amber-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-grid md-color-white"></i>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-validasi-material.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Validasi Material</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Validasi Material</p>
							</div>
							<div
								class="md-bg-green-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-email-outline md-color-white"></i>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-notifikasi.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Notifikasi</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Notifikasi</p>
							</div>
							<div
								class="md-bg-red-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-bug md-color-white"></i>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-validasi-finishing.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Validasi Finishing</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Validasi Finishing</p>
							</div>
							<div
								class="md-bg-deep-purple-600 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-message-outline md-color-white"></i>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-cek-fisik.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Cek Fisik</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Cek Fisik</p>
							</div>
							<div
								class="md-bg-indigo-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-beats md-color-white"></i>
								<span
									class="uk-badge md-bg-red-600 uk-position-absolute uk-position-top-right uk-margin-small-top uk-margin-small-right">24</span>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-cetak-data-pengiriman.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Cetak Data Pengirirman dan Form Kepuasan</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Cetak Data Pengirirman dan Form Kepuasan</p>
							</div>
							<div
								class="md-bg-cyan-900 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-bomb md-color-white"></i>
							</div>
						</a>
					</div>
				</div>
				<div>
					<div class="uk-card">
						<a href="quality-control-halaman-komplain.html"
							class="uk-card-body sc-padding sc-padding-medium-ends uk-flex uk-flex-middle">
							<div class="uk-flex-1">
								<h3 class="uk-card-title">Halaman Komplain</h3>
								<p class="sc-color-secondary uk-margin-remove uk-text-medium">Halaman Komplain
								</p>
							</div>
							<div
								class="md-bg-indigo-200 uk-flex uk-flex-middle sc-padding-medium sc-padding-small-ends sc-round">
								<i class="mdi mdi-buddhism md-color-white"></i>
								<span
									class="uk-badge md-bg-red-600 uk-position-absolute uk-position-top-right uk-margin-small-top uk-margin-small-right">24</span>
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
		$('#qc').addClass("sc-page-active");
	});
</script>
@endpush