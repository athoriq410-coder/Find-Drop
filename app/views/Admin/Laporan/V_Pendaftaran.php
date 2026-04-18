<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-xxl" id="kt_content_container">
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xl-12" id="base_table">
                <!--begin::Table-->
                <form class="card mb-5 mb-xl-8" id="reload_table">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Laporan Pendaftaran</span>
                            <span class="text-muted mt-1 fw-semibold fs-7"><?= $jumlah; ?> Member</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-25px">No</th>
                                        <th class="min-w-100px">Tanggal Bergabung</th>
                                        <th class="min-w-100px">Member</th>
                                        <th class="min-w-100px">Kontak</th>
                                        <th class="min-w-100px">Status Pendaftar</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = ($offset + 1); foreach($result AS $row) : $num = $no++; ?>
                                        <tr>
                                            <td class="text-muted"><?= $num.'.';?></td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= date('d-m-Y',strtotime($row['create_date'])); ?></a></td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= $row['nama']; ?></a></td>
                                            <td>
                                                <?php if ($row['email'] || $row['notelp']) : ?>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <?php if ($row['email']) : ?>

                                                            <span class="text-dark fw-bold text-hover-info d-block fs-6"><i class="fa-solid fa-envelope" style="margin-right : 10px;"></i><?= $row['email']; ?> </span>
                                                        <?php endif; ?>
                                                        <?php if ($row['notelp']) : ?>

                                                            <span class="text-dark fw-bold text-hover-info d-block fs-6"><i class="fa-solid fa-phone" style="margin-right : 10px;"></i><?= '+62 ',$row['notelp']; ?> </span>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php else : ?>
                                                    <span class="text-dark fw-bold text-hover-info d-block fs-6"> - </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($row['create_by'] != '') : ?>
                                                    <span class="badge badge-info">Di Daftarkan oleh <?= $row['pembuat']; ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-primary">Pendaftar Mandiri</span>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5"><center>Tidak ada data member tersedia</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                    <div class="card-footer">
                        <?= pagination(base_url('laporan/pendaftaran',true),$jumlah,$limit,$offset); ?>
                    </div>
                </form>
                <!--end::Table-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->