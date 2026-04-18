<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <form action="<?= base_url('pengaturan/setup',true) ?>" method="POST" enctype="multipart/form-data" id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="tab-content">
                    <div class="card mb-5 mb-xl-8">
                        <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column align-items-start">
                                <!--begin::Title-->
                                <h1 class="d-flex text-dark fw-bold m-0 fs-3">Pengaturan Logo</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">Pengaturan</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-gray-600">Logo & Icon</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <div class="row d-flex mt-5">
                                <div class="col-md-6 d-flex justify-content-center align-items-center flex-column">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?= image_check('default.jpg','default') ?>)">
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-250px h-250px" style="background-image: url(<?= image_check($result->icon,'setting') ?>);"></div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Change Icon">
                                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="icon" accept=".png, .ico" />
                                            <input type="hidden" name="nama_icon" value="<?= $result->icon; ?>" />
                                            <input type="hidden" name="icon_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Cancel Icon">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Remove Icon">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    <h5 class="mt-5 required">Icon Website</h5>
                                </div>
                                <div class="col-md-6 d-flex justify-content-center align-items-center flex-column">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline mb-5 pb-5" data-kt-image-input="true" style="background-image: url(<?= image_check('default.jpg','default') ?>)">
                                        <!--begin::Image preview wrapper-->
                                        <div class="image-input-wrapper w-400px h-200px" style="background-image: url(<?= image_check($result->logo,'setting') ?>)"></div>
                                        <!--end::Image preview wrapper-->

                                        <!--begin::Edit button-->
                                        <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Change Logo">
                                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                            <!--begin::Inputs-->
                                            <input type="file" name="logo" accept=".png, .ico" />
                                            <input type="hidden" name="nama_logo" value="<?= $result->logo; ?>" />
                                            <input type="hidden" name="logo_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit button-->

                                        <!--begin::Cancel button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Cancel Logo">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Cancel button-->

                                        <!--begin::Remove button-->
                                        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Remove Logo">
                                            <i class="ki-outline ki-cross fs-3"></i>
                                        </span>
                                        <!--end::Remove button-->
                                    </div>
                                    <!--end::Image input-->
                                    <h5 class="mt-5 pt-2 required">Logo Website</h5>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </form>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
