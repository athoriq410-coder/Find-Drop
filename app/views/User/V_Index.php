<div class="container">
    <div class="row">
      <div class="col-lg-12">
         <div class="page-content">

               <!-- ***** Banner Start ***** -->
               <div class="main-banner" style="background-image: url('<?= base_url('../assets/user/images/banner-bg.jpg'); ?>')">
                  <div class="row">
                  <div class="col-lg-7">
                     <div class="header-text">
                        <h6>Selamat Datang di Airdrops Web</h6>
                        <h4><em>Temukan</em> Airdrops pilihan anda</h4>
                        <div class="main-button">
                           <a href="#daftar-airdrop" class="text-center">Cari Sekarang</a>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
               <!-- ***** Banner End ***** -->

               <!-- ***** Trending Start ***** -->
<?php if(!empty($top_trending)) : ?>
<div class="most-popular mt-4 mb-2">
   <div class="row">
      <div class="col-lg-12">
         <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="text-white mb-0">🔥 Trending Sekarang</h5>
            <a href="<?= base_url('trending', true) ?>" style="color:#e75e8d; font-size:13px;">Lihat Semua →</a>
         </div>
         <div class="row">
            <?php $rank = 1; foreach($top_trending as $row) : ?>
            <div class="col-lg-4 col-sm-6 mb-3">
               <a href="<?= base_url('user/detail/'.$row->id_produk, true) ?>">
                  <div class="item" style="position:relative;">
                     <div style="position:absolute; top:10px; left:10px; background:<?= $rank == 1 ? '#FFD700' : ($rank == 2 ? '#C0C0C0' : '#CD7F32') ?>; color:#000; border-radius:50%; width:26px; height:26px; display:flex; align-items:center; justify-content:center; font-weight:bold; font-size:12px; z-index:10;">
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
                     <div class="mb-2" style="color: rgba(255,255,255,0.33); font-size:11.5px;"><?= short_text(strip_tags($row->deskripsi), 50) ?></div>
                     <div class="d-flex justify-content-between mt-2" style="border-top:1px solid rgba(255,255,255,0.1); padding-top:8px;">
                        <span style="color:#e75e8d; font-size:11px;">❤️ <?= $row->total_favorit ?> Favorit</span>
                        <span style="color:#aaa; font-size:11px;">💬 <?= $row->total_komentar ?> Komentar</span>
                     </div>
                  </div>
               </a>
            </div>
            <?php $rank++; endforeach; ?>
         </div>
      </div>
   </div>
</div>
<?php endif; ?>
<!-- ***** Trending End ***** -->

<!-- ***** Most Popular Start ***** -->
<div class="most-popular" id="daftar-airdrop">
   <div class="row">
      <div class="col-lg-12">

         <?php if($kategori) : ?>
         <div class="airdrop-grid-wrapper">
            <?php foreach($kategori AS $row) : ?>

            <div class="airdrop-col">
               <!-- Section Header -->
              <div class="airdrop-col-header">
                <span class="airdrop-col-title"><?= htmlspecialchars($row->nama) ?></span>
               <div class="d-flex align-items-center gap-2">
               <?php if(isset($result[$row->id_kategori])) : ?>
               <span class="airdrop-col-count"><?= count($result[$row->id_kategori]) ?> Airdrop</span>
               <?php endif; ?>
            </div>
         </div>

              <!-- Cards -->
               <div class="airdrop-col-scroll-wrap">
               <div class="airdrop-col-scroll" onscroll="updateScrollBtns(this)">
                  <?php if(isset($result[$row->id_kategori])) : ?>
                     <?php foreach($result[$row->id_kategori] AS $key) : ?>

                     <a href="<?= base_url('user/detail/'.$key['id_produk'],true); ?>" class="airdrop-card-link">
                        <div class="airdrop-card-new">
                           <!-- Top row: image + info + badge -->
                           <div class="acp-top">
                              <div class="acp-img" style="background-image: url('<?= $key['foto'] ?>');"></div>
                              <div class="acp-meta">
                                 <div class="acp-name"><?= htmlspecialchars($key['nama']) ?></div>
                              </div>
                              <?php if($key['verify'] == 'Y') : ?>
                              <span class="acp-badge verified">✓ Verified</span>
                              <?php else : ?>
                              <span class="acp-badge unverified">Unverified</span>
                              <?php endif; ?>
                           </div>
                           <!-- Description -->
                           <p class="acp-desc"><?= htmlspecialchars(short_text(strip_tags($key['deskripsi']), 60)) ?></p>
                        </div>
                     </a>

                     <?php endforeach; ?>
                  <?php else : ?>
                     <div class="airdrop-empty">Belum ada airdrop</div>
                  <?php endif; ?>
              </div>
               </div><!-- end scroll-wrap -->
            </div>

            <?php endforeach; ?>
         </div>
         <?php endif; ?>

      </div>
   </div>
</div>
<!-- ***** Most Popular End ***** -->

               <!-- ***** Gaming Library Start ***** -->
               <div class="gaming-library d-none">
                  <div class="col-lg-12">
                  <div class="heading-section">
                     <h4><em>Your Gaming</em> Library</h4>
                  </div>
                  <div class="item">
                     <ul>
                        <li><img src="<?= assets_url('user/') ?>images/game-01.jpg" alt="" class="templatemo-item"></li>
                        <li><h4>Dota 2</h4><span>Sandbox</span></li>
                        <li><h4>Date Added</h4><span>24/08/2036</span></li>
                        <li><h4>Hours Played</h4><span>634 H 22 Mins</span></li>
                        <li><h4>Currently</h4><span>Downloaded</span></li>
                        <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                     </ul>
                  </div>
                  <div class="item">
                     <ul>
                        <li><img src="<?= assets_url('user/') ?>images/game-02.jpg" alt="" class="templatemo-item"></li>
                        <li><h4>Fortnite</h4><span>Sandbox</span></li>
                        <li><h4>Date Added</h4><span>22/06/2036</span></li>
                        <li><h4>Hours Played</h4><span>740 H 52 Mins</span></li>
                        <li><h4>Currently</h4><span>Downloaded</span></li>
                        <li><div class="main-border-button"><a href="#">Donwload</a></div></li>
                     </ul>
                  </div>
                  <div class="item last-item">
                     <ul>
                        <li><img src="<?= assets_url('user/') ?>images/game-03.jpg" alt="" class="templatemo-item"></li>
                        <li><h4>CS-GO</h4><span>Sandbox</span></li>
                        <li><h4>Date Added</h4><span>21/04/2036</span></li>
                        <li><h4>Hours Played</h4><span>892 H 14 Mins</span></li>
                        <li><h4>Currently</h4><span>Downloaded</span></li>
                        <li><div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div></li>
                     </ul>
                  </div>
                  </div>
                  <div class="col-lg-12">
                  <div class="main-button">
                     <a href="profile.html">View Your Library</a>
                  </div>
                  </div>
               </div>
               <!-- ***** Gaming Library End ***** -->
         </div>
      </div>
    </div>
  </div>


  <script>
function scrollAirdropCol(btn, direction) {
   var col = btn.closest('.airdrop-col');
   var scrollEl = col.querySelector('.airdrop-col-scroll');
   if (!scrollEl) return;
   scrollEl.scrollBy({ top: direction * 160, behavior: 'smooth' });
}

function updateScrollBtns(scrollEl) {
   var col     = scrollEl.closest('.airdrop-col');
   var wrap    = scrollEl.closest('.airdrop-col-scroll-wrap');
   var upBtn   = col ? col.querySelector('.scroll-up-btn')   : null;
   var downBtn = col ? col.querySelector('.scroll-down-btn') : null;

   var atTop    = scrollEl.scrollTop <= 2;
   var atBottom = scrollEl.scrollTop + scrollEl.clientHeight >= scrollEl.scrollHeight - 2;

   if (upBtn)   upBtn.classList.toggle('disabled', atTop);
   if (downBtn) downBtn.classList.toggle('disabled', atBottom);

   if (wrap) {
      wrap.classList.toggle('has-scroll-top',   !atTop);
      wrap.classList.toggle('no-scroll-bottom',  atBottom);
   }
}

document.addEventListener('DOMContentLoaded', function() {
   document.querySelectorAll('.airdrop-col-scroll').forEach(function(el) {
      updateScrollBtns(el);
   });
});
</script>