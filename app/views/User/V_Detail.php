<style>
  /* ===== DETAIL PAGE CUSTOM STYLES ===== */

  /* Hero section: foto + info airdrop */
  .detail-hero {
    display: flex;
    gap: 30px;
    align-items: flex-start;
    margin-bottom: 30px;
  }

  .detail-hero-img {
    width: 260px;
    min-width: 260px;
    height: 260px;
    object-fit: cover;
    border-radius: 18px;
    border: 2px solid #ffffff20;
  }

  .detail-hero-info {
    flex: 1;
  }

  .detail-hero-info h4 {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 12px;
  }

  /* Link buttons (Website & Youtube) */
  .detail-links {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
  }

  .detail-link-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 1px solid #ec6090;
    color: #ec6090;
    background: transparent;
  }

  .detail-link-btn:hover {
    background: #ec6090;
    color: #fff;
    text-decoration: none;
  }

  .detail-link-btn.yt {
    border-color: #ff0000;
    color: #ff0000;
  }

  .detail-link-btn.yt:hover {
    background: #ff0000;
    color: #fff;
  }

  /* Deskripsi */
  .detail-desc {
    font-size: 14px;
    color: #ccc;
    line-height: 1.8;
  }

  /* Divider */
  .detail-divider {
    border: none;
    border-top: 1px solid #ffffff15;
    margin: 25px 0;
  }

  /* Tutorial / Steps */
  .detail-steps-title {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .detail-steps-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #ffffff20;
  }

  .detail-steps-list {
    list-style: none;
    padding: 0;
    margin: 0;
    counter-reset: step-counter;
  }

  .detail-steps-list li {
    counter-increment: step-counter;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    margin-bottom: 12px;
    background: #27292a;
    border-radius: 12px;
    border-left: 3px solid #ec6090;
    font-size: 14px;
    color: #ccc;
    line-height: 1.7;
  }

  .detail-steps-list li::before {
    content: counter(step-counter);
    min-width: 30px;
    height: 30px;
    background: #ec6090;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
    flex-shrink: 0;
    margin-top: 2px;
  }

  /* Jika tutorial dari CKEditor menghasilkan <ol> atau <ul> biasa */
  .tutorial-content ol,
  .tutorial-content ul {
    padding: 0;
    margin: 0;
    list-style: none;
    counter-reset: step-counter;
  }

  .tutorial-content ol li,
  .tutorial-content ul li {
    counter-increment: step-counter;
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    margin-bottom: 12px;
    background: #27292a;
    border-radius: 12px;
    border-left: 3px solid #ec6090;
    font-size: 14px;
    color: #ccc;
    line-height: 1.7;
  }

  .tutorial-content ol li::before,
  .tutorial-content ul li::before {
    content: counter(step-counter);
    min-width: 30px;
    height: 30px;
    background: #ec6090;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 13px;
    flex-shrink: 0;
    margin-top: 2px;
  }

  .tutorial-content p {
    padding: 15px;
    margin-bottom: 12px;
    background: #27292a;
    border-radius: 12px;
    border-left: 3px solid #ec6090;
    font-size: 14px;
    color: #ccc;
    line-height: 1.7;
  }

  /* Komentar */
  .komentar-header {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .komentar-header::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #ffffff20;
  }

  .komentar-item {
    padding: 15px;
    background: #27292a;
    border-radius: 12px;
    margin-bottom: 15px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .detail-hero {
      flex-direction: column;
    }
    .detail-hero-img {
      width: 100%;
      min-width: unset;
      height: 220px;
    }
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="page-content">
        <!-- ***** Details Start ***** -->
        <div class="game-details">
          <div class="row">
            <div class="col-lg-12">

              <!-- CARD UTAMA: Foto + Info + Deskripsi -->
              <div class="content">

                <!-- Hero: Foto & Info Airdrop -->
                <div class="detail-hero">
                  <img src="<?= image_check($result->foto,'produk'); ?>" class="detail-hero-img" alt="<?= $result->nama ?>">
                  <div class="detail-hero-info">
                    <h4><?= $result->nama ?? '' ?></h4>

                    <!-- Link Website & Youtube -->
                    <?php if($result->link_website || $result->link_youtube) : ?>
                    <div class="detail-links">
                      <?php if($result->link_website) : ?>
                      <a href="<?= $result->link_website; ?>" target="_blank" class="detail-link-btn">
                        <i class="bi bi-globe2"></i> Website Resmi
                      </a>
                      <?php endif; ?>
                      <?php if($result->link_youtube) : ?>
                      <a href="<?= $result->link_youtube; ?>" target="_blank" class="detail-link-btn yt">
                        <i class="bi bi-youtube"></i> Youtube
                      </a>
                      <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Deskripsi singkat (teks dari CKEditor) -->
                    <div class="detail-desc">
                      <?= $result->deskripsi; ?>
                    </div>
                  </div>
                </div>

                <hr class="detail-divider">

                <!-- Tutorial / Steps -->
                <div class="detail-steps-title">
                  <i class="bi bi-list-ol"></i> Panduan Mengikuti Airdrop
                </div>
                <div class="tutorial-content">
                  <?= $result->tutorial; ?>
                </div>

                <hr class="detail-divider">

                <!-- Tombol Tambah/Hapus Favorit -->
                <?php if(session(WEB_NAME.'_id_user')) : ?>
                <div class="col-lg-12 mt-3">
                  <?php if($fav == false) : ?>
                  <div class="main-border-button">
                    <a href="<?= base_url('user/add_fav/'.$result->id_produk,true) ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan memasukan <?= $result->nama ?> ke favorit?')">
                      <i class="bi bi-bookmark-plus me-2"></i>Tambahkan ke My Airdrops
                    </a>
                  </div>
                  <?php else : ?>
                  <div class="main-border-button">
                    <a href="<?= base_url('user/remove_fav/'.$result->id_produk,true) ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan menghapus <?= $result->nama ?> dari favorit?')">
                      <i class="bi bi-bookmark-dash me-2"></i>Hapus dari My Airdrops
                    </a>
                  </div>
                  <?php endif; ?>
                </div>
                <?php endif; ?>

              </div>
              <!-- /CARD UTAMA -->

              <!-- CARD KOMENTAR -->
              <?php if(session(WEB_NAME.'_id_user')) : ?>
              <div class="content mt-3" id="base_table">
                <div class="container" id="reload_table">

                  <div class="komentar-header">
                    <i class="bi bi-chat-dots"></i> Komentar
                  </div>

                  <div class="row">
                    <form id="form_komentar" action="<?= base_url('user/add_komentar', true); ?>" method="POST">
                      <div class="col-md-12 mt-2">
                        <div class="d-flex flex-start w-100">
                          <input type="hidden" name="id_produk" value="<?= $result->id_produk; ?>">
                          <div class="img-circle me-3" style="background-image: url('<?= image_check(session(WEB_NAME.'_foto'),'member','user'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; flex-shrink:0;"></div>
                          <div class="form-outline w-100" id="req_komentar">
                            <textarea class="form-control form-control-inputan" rows="4" name="komentar" placeholder="Tulis komentar anda..."></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 text-end mb-4">
                        <button type="button" id="btn_add_komentar" onclick="submit_form(this,'#form_komentar',1)" class="main-button mt-3">
                          <i class="bi bi-send me-1"></i> Posting
                        </button>
                      </div>
                    </form>

                    <?php if($komentar) : ?>
                      <?php foreach($komentar AS $row) : ?>
                      <div class="col-md-12">
                        <div class="komentar-item">
                          <div class="d-flex align-items-center mb-2">
                            <div class="img-circle" style="background-image: url('<?= image_check($row->foto,'member','user') ?>'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            <h6 class="ms-3 mb-0"><?= $row->user ?></h6>
                          </div>
                          <p class="mb-0" style="color:#ccc; font-size:14px;"><?= $row->komentar; ?></p>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  </div>
                </div>
              </div>
              <?php endif; ?>
              <!-- /CARD KOMENTAR -->

            </div>
          </div>
        </div>
        <!-- ***** Details End ***** -->
      </div>
    </div>
  </div>
</div>