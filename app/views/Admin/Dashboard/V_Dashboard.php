<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<!--begin::Content wrapper-->
	<div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
			<!--begin::Toolbar container-->
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
				<!--begin::Toolbar wrapper-->
				<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
					<!--begin::Page title-->
					<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
						<!--begin::Title-->
						<h1
							class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
							Dashboard</h1>
						<!--end::Title-->
						<!--begin::Breadcrumb-->
						<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
							<!--begin::Item-->
							<li class="breadcrumb-item text-muted">
								<a href="<?= base_url('dashboard') ?>"
									class="text-muted text-hover-primary">Dashboard</a>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="breadcrumb-item">
								<span class="bullet bg-gray-400 w-5px h-2px"></span>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="breadcrumb-item text-muted">Statistik</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="breadcrumb-item">
								<span class="bullet bg-gray-400 w-5px h-2px"></span>
							</li>
							<!--end::Item-->
							<!--begin::Item-->
							<li class="breadcrumb-item text-muted">Widgets</li>
							<!--end::Item-->
						</ul>
						<!--end::Breadcrumb-->
					</div>
					<!--end::Page title-->
				</div>
				<!--end::Toolbar wrapper-->
			</div>
			<!--end::Toolbar container-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-fluid">
				
				<div class="row gy-5 g-xl-8">
					<!--begin::Col-->
					<div class="col-xxl-4">
						<!--begin::Mixed Widget 12-->
						<div class="card card-xl-stretch mb-xl-8">
							<!--begin::Header-->
							<div class="card-header border-0 bg-primary py-5">
								<h3 class="card-title fw-bold text-white">Grafik Pendaftaran</h3>
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body p-0">
								<!--begin::Chart-->
								<div class="mixed-widget-12-chart card-rounded-bottom bg-primary" data-kt-color="primary" style="height: 250px"></div>
								<!--end::Chart-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::Mixed Widget 12-->
					</div>
					<!--end::Col-->
				</div>
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Content wrapper-->
</div>
<!--end:::Main-->
