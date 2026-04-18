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
                        <?php if(!in_array($_SESSION[WEB_NAME.'_id_role'],[1,3])) : ?>
                        <div class="d-flex justify-content-center align-items-center">
                            <a role="button" href="<?= base_url('dashboard',true) ?>" class="mx-2 btn btn-info">Kembali</a>
                        </div>
                        <?php endif;?>
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Laporan Peminjaman</span>
                            <span class="text-muted mt-1 fw-semibold fs-7"><?= $jumlah; ?> Member</span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th rowspan="2" class="w-25px text-center">No</th>
                                        <th rowspan="2" class="min-w-200px text-center">tanggal</th>
                                        <th rowspan="2" class="min-w-100px text-center">Kode</th>
                                        <th rowspan="2" class="min-w-200px text-center">Buku</th>
                                        <th rowspan="2" class="min-w-100px text-center">Peminjam</th>
                                        <th colspan="2" class="min-w-200px text-center">PIC</th>
                                        <th rowspan="2" class="min-w-100px text-center">Status</th>
                                    </tr>
                                    <tr class="fw-bold text-muted">
                                        <td class="min-w-100px text-center">Pinjam</td>
                                        <td class="min-w-100px text-center">Kembali</td>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = ($offset + 1); foreach($result AS $row) : $num = $no++; ?>
                                        <tr>
                                            <td class="text-muted"><?= $num.'.';?></td>
                                            <td>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-info d-block fs-6">Pinjam&nbsp;&nbsp;&nbsp; : <?= date('d M Y',strtotime($row['start_date'])); ?> </span>
                                                    <span class="text-dark fw-bold text-hover-info d-block fs-6">Kembali : <?= ($row['back_date']) ? date('d M Y',strtotime($row['back_date'])) : ' - '; ?> </span>
                                                    <span class="text-dark fw-bold text-hover-info d-block fs-6">Batas&nbsp;&nbsp;&nbsp;&nbsp; : <?= date('d M Y',strtotime($row['end_date'])); ?> </span>
                                                </div>
                                            </td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= '#'.$row['kode']; ?></a></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-5">
                                                        <img src="<?= image_check($row['sampul'],'buku'); ?>" alt="" width="30px" />
                                                    </div>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a href="#" class="text-dark fw-bold text-hover-info fs-6"><?= $row['judul']; ?></a>
                                                        <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row['author']; ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= $row['peminjam']; ?></a></td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= $row['pic_out']; ?></a></td>
                                            <td><a role="button" class="text-dark fw-bold text-hover-info fs-6"><?= $row['pic_in']; ?></a></td>

                                            <td>
                                                 <?php if(strtotime($row['back_date']) != NULL) : ?>
                                                    <?php if(strtotime($row['back_date']) > strtotime($row['end_date'])) : ?>
                                                        <span class="badge badge-danger">Terlambat</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-success">Tepat Waktu</span>
                                                    <?php endif;?>
                                                <?php else: ?>
                                                    <span class="badge badge-info">Dipinjam</span>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8"><center>Tidak ada data peminjaman</center></td>
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
                        <?= pagination(base_url('laporan/peminjaman',true),$jumlah,$limit,$offset); ?>
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