<div class="container" style="padding-top: 30px;">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <div class="d-flex align-items-center mb-4">
          <h4 class="text-white mb-0">🔍 Hasil Pencarian</h4>
          <?php if($q) : ?>
          <span class="ms-3 text-muted" style="font-size:13px;">
            Menampilkan hasil untuk: <strong style="color:#e75e8d;">"<?= htmlspecialchars($q) ?>"</strong>
          </span>
          <?php endif; ?>
        </div>

        <?php if(!$q) : ?>
          <div class="text-center text-white py-5">
            <div style="font-size: 60px;">🔍</div>
            <h5 class="mt-3">Masukkan kata kunci pencarian</h5>
            <p class="text-muted">Ketik nama airdrop yang ingin kamu cari di kotak pencarian.</p>
          </div>

        <?php elseif(empty($result)) : ?>
          <div class="text-center text-white py-5">
            <div style="font-size: 60px;">😕</div>
            <h5 class="mt-3">Airdrop tidak ditemukan</h5>
            <p class="text-muted">Tidak ada hasil untuk "<strong><?= htmlspecialchars($q) ?></strong>". Coba kata kunci lain.</p>
            <a href="<?= base_url('home', true) ?>" class="btn btn-outline-light mt-2">Kembali ke Dashboard</a>
          </div>

        <?php else : ?>
          <p class="text-muted mb-3" style="font-size:13px;"><?= count($result) ?> airdrop ditemukan</p>
          <div class="row">
            <?php foreach($result as $row) : ?>
            <div class="col-lg-4 col-sm-6 mb-4">
              <a href="<?= base_url('user/detail/'.$row->id_produk, true) ?>">
                <div class="item">

                  <div class="d-flex justify-content-end">
                    <?php if($row->verify == 'Y') : ?>
                    <div class="badge-terbaru"><h6 class="mt-0">Verified</h6></div>
                    <?php else : ?>
                    <div class="badge-verified"><h6 class="mt-0" style="color:#ec6090;">Unverified</h6></div>
                    <?php endif; ?>
                  </div>

                  <div class="d-flex mb-2 align-items-center">
                    <div class="img-circle" style="background-image:url('<?= image_check($row->foto,'produk') ?>');background-size:cover;background-position:center;"></div>
                    <h4 class="mt-1 ms-3"><?= $row->nama ?>
                    </h4>
                  </div>

                  <div class="mb-2"><?= short_text(strip_tags($row->deskripsi), 80) ?></div>

                </div>
              </a>
            </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>