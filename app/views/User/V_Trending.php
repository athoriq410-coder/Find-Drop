<div class="container" style="padding-top: 30px;">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">

        <div class="d-flex align-items-center mb-4">
          <h4 class="text-white mb-0">🔥 Airdrop Trending</h4>
          <span class="ms-3 text-muted" style="font-size:13px;">Berdasarkan aktivitas favorit & komentar pengguna</span>
        </div>

        <?php if(empty($trending)) : ?>
          <div class="text-center text-white py-5">
            <div style="font-size: 60px;">🔥</div>
            <h5 class="mt-3">Belum ada data trending</h5>
            <p class="text-muted">Jadilah yang pertama memfavoritkan airdrop!</p>
          </div>
        <?php else : ?>
          <div class="row">
            <?php $rank = 1; foreach($trending as $row) : ?>
            <div class="col-lg-4 col-sm-6 mb-4">
              <a href="<?= base_url('user/detail/'.$row->id_produk, true) ?>">
                <div class="item" style="position: relative;">

                  <div style="position:absolute; top:10px; left:10px; background:<?= $rank == 1 ? '#FFD700' : ($rank == 2 ? '#C0C0C0' : ($rank == 3 ? '#CD7F32' : '#e75e8d')) ?>; color:<?= $rank <= 3 ? '#000' : '#fff' ?>; border-radius:50%; width:28px; height:28px; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:12px; z-index:10;">
                    <?= $rank ?>
                  </div>

                  <div class="d-flex mb-2 align-items-center">
                     <div class="img-circle" style="background-image:url('<?= $row->foto ?>');background-size:cover;background-position:center;"></div>
                     <div class="ms-3 flex-grow-1">
                       <div class="acp-name"><?= $row->nama ?></div>
                      </div>
                     <?php if($row->verify == 'Y') : ?>
                     <span class="acp-badge verified">✓ Verified</span>
                     <?php else : ?>
                    <span class="acp-badge unverified">Unverified</span>
                    <?php endif; ?>
                  </div>

                  <div class="mb-2"><?= short_text(strip_tags($row->deskripsi), 60) ?></div>

                  <div class="d-flex justify-content-between mt-2" style="border-top:1px solid rgba(255,255,255,0.1); padding-top:8px;">
                    <span style="color:#e75e8d; font-size:12px;">❤️ <?= $row->total_favorit ?> Favorit</span>
                    <span style="color:#aaa; font-size:12px;">💬 <?= $row->total_komentar ?> Komentar</span>
                    <span style="color:#FFD700; font-size:12px;">⭐ Skor: <?= $row->skor_trending ?></span>
                  </div>

                </div>
              </a>
            </div>
            <?php $rank++; endforeach; ?>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>