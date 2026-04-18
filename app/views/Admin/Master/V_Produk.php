<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Master Produk</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Produk</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Body-->
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="d-flex align-items-center position-relative me-3 search_mekanik w-300px">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" name="search" value="<?= $search; ?>" class="form-control form-control-solid w-250px ps-13" aria-label="Cari produk" aria-describedby="button-cari-produk" placeholder="Cari produk" autocomplete="off">
                            <button type="button" onclick="search(false)" class="btn btn-primary d-none" type="button" id="button-cari-produk">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-none justify-content-end" id="sistem_drag">
                                <button type="button" id="btn_hapus" onclick="submit_form(this,'#reload_table',0,'/deleted/produk/<?= base64url_encode('master/produk') ?>',true,true)" data-message="Apakah anda yakin akan menghapus data member? data yang di hapus tidak akan bisa di kembalikan" class="btn btn-sm btn-light-danger me-3">Hapus</button>
                            </div>
                            <div class="d-flex justify-content-end" id="sistem_filter">

                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-light me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Penyaringan
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px filter_mekanik" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Pilihan Penyaringan</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Kategori</label>
                                            <select name="id_kategori" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih kategori">
                                                <option value="all">Semua</option>
                                                <?php foreach($kategori AS $row) : ?>
                                                <option value="<?= $row->id_kategori;?>" <?= (isset($_GET['id_kategori']) && $_GET['id_kategori'] == $row->id_kategori) ? 'selected' : ''; ?>><?= ucfirst($row->nama) ?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Status</label>
                                            <select name="status" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih opsi status">
                                                <option value="all">Semua</option>
                                                <option value="Y" <?php if (isset($_GET['status']) && $_GET['status'] == 'Y') {
                                                                        echo 'selected';
                                                                    } ?>>Aktif</option>
                                                <option value="N" <?php if (isset($_GET['status']) && $_GET['status'] == 'N') {
                                                                        echo 'selected';
                                                                    } ?>>Tidak Aktif</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" onclick="filter(['id_kategori','status'],false)" class="btn btn-primary fw-semibold px-6">Terapkan</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->

                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Add produk-->
                             <button type="button" class="btn btn-sm btn-light" onclick="tambah_data()" data-bs-toggle="modal" data-bs-target="#kt_modal_produk">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Produk</button>
                            <!--end::Add produk-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('pengaturan/drag',true) ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input cursor-pointer" type="checkbox" onchange="checked_action(this)" <?php if (!$result) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } ?>>
                                            </div>
                                        </th>
                                        <th class="min-w-300px">Produk</th>
                                        <th class="min-w-250px">Deskripsi</th>
                                        <th class="min-w-100px text-center">Status</th>
                                        <th class="min-w-150px text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>

                                    <?php if ($result) : ?>
                                        <?php foreach ($result as $row) : ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input widget-9-check cursor-pointer child_checkbox" name="id_batch[]" onchange="child_checked()" type="checkbox" value="<?= $row->id_produk ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-100px me-5">
                                                            <img src="<?= image_check($row->foto, 'produk') ?>" alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a class="text-dark fw-bold text-hover-primary fs-6"><?= $row->nama;?></a>
                                                            <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row->kategori ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $row->deskripsi; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <div class="form-check form-switch">
                                                            <input onchange="switching(this,event,<?= $row->id_produk ?>)" data-url="<?= base_url('pengaturan/switch/produk',true) ?>" class="form-check-input cursor-pointer focus-info" type="checkbox" role="switch" id="switch-<?= $row->id_produk ?>" <?= ($row->status == 'Y') ? 'checked': ''; ?>>
                                                        </div>
                                                    </div>
                                                    
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        
                                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-info btn-sm me-1" title="Ubah data produk" onclick="ubah_data(this,<?= $row->id_produk ?>)" data-image="<?= image_check($row->foto,'produk','produk'); ?>" title="Ubah data produk" data-bs-toggle="modal" data-bs-target="#kt_modal_produk">
                                                            <i class="ki-outline ki-pencil fs-2"></i>
                                                        </button>
                                                        <button type="button" onclick="hapus_data(event,<?= $row->id_produk; ?>,'master/hapus_produk','<b><?= $row->nama; ?></b>')" title="Hapus data produk" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <i class="ki-outline ki-trash fs-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5">
                                                <center>Data produk tidak ditemukan</center>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                             <?= pagination(base_url('master/produk',true),$jumlah,$limit,$offset); ?>
                        </form>
                        <!--end::Table container-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<!-- Modal Tambah produk -->
<div class="modal fade" id="kt_modal_produk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_produk" class="form" action="<?= base_url('master/tambah_produk',true) ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_produk_header" data-kt-scroll-wrappers="#kt_modal_produk_scroll" data-kt-scroll-offset="180px">
                        
                        <div id="lead"></div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 d-flex justify-content-center align-items-center flex-column">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5 required">Foto Produk</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= image_check('notfound.jpg','default') ?>')">
                                <!--begin::Image preview wrapper-->
                                <div id="display_foto" class="image-input-wrapper w-150px h-150px" style="background-image: url('<?= image_check('notfound.jpg','default') ?>')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Foto">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Foto">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_foto" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Foto">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Tipe: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Produk</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama produk" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="nama_foto">
                        <input type="hidden" name="id_produk">

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_id_kategori">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                            <!--end::Label-->
                            <div>
                                <select name="id_kategori" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih kategori produk">
                                    <option value=""></option>
                                    <?php foreach($kategori AS $row) : ?>
                                    <option value="<?= $row->id_kategori;?>"><?= ucfirst($row->nama) ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_verify">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Verifikasi</label>
                            <!--end::Label-->
                            <div>
                                <select name="verify" class="form-select form-select-solid cekcek" data-control="select2" data-placeholder="Pilih kategori produk">
                                    <option value="Y">Terverifikasi</option>
                                    <option value="N">Tidak Terverifikasi</option>
                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_deskripsi">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan deskripsi"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_tutorial">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Tutorial</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="tutorial" id="tutorial" cols="30" rows="10" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan tutorial"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_link_website">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Link Website</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="link_website" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="https://contoh.com" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_link_youtube">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Link Youtube</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="link_youtube" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="https://youtube.com/watch?v=..." />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" data-editor="deskripsi,tutorial" id="submit_produk" onclick="submit_form(this,'#form_produk',1)" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>