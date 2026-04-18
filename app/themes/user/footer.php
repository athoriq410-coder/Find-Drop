<footer style="background: #1a1a2e; margin-top: 60px;">
    <div class="container">
      <div class="row" style="padding: 40px 0 32px;">

        <!-- Kolom 1 - Tentang -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div style="font-size: 22px; font-weight: 600; color: #e75e8d; margin-bottom: 12px;">MY AIRDROP</div>
          <p style="font-size: 13px; color: #aaa; line-height: 1.7; margin-bottom: 20px;">
            Platform terpercaya untuk menemukan dan mengikuti airdrop cryptocurrency terbaru. Dapatkan informasi airdrop verified secara gratis.
          </p>
          <div style="display: flex; gap: 10px;">
            <a href="https://x.com/LRage46" target="_blank" style="width:34px; height:34px; border-radius:50%; background:rgba(231,94,141,0.15); border:1px solid rgba(231,94,141,0.3); display:flex; align-items:center; justify-content:center; color:#e75e8d; font-size:13px; font-weight:500; text-decoration:none;">X</a>
            <a href="#" style="width:34px; height:34px; border-radius:50%; background:rgba(231,94,141,0.15); border:1px solid rgba(231,94,141,0.3); display:flex; align-items:center; justify-content:center; color:#e75e8d; font-size:11px; font-weight:500; text-decoration:none;">TG</a>
            <a href="#" style="width:34px; height:34px; border-radius:50%; background:rgba(231,94,141,0.15); border:1px solid rgba(231,94,141,0.3); display:flex; align-items:center; justify-content:center; color:#e75e8d; font-size:11px; font-weight:500; text-decoration:none;">DC</a>
          </div>
        </div>

        <!-- Kolom 2 - Navigasi -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div style="font-size:14px; font-weight:500; color:#fff; margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid rgba(231,94,141,0.3);">Navigasi</div>
          <div style="display:flex; flex-direction:column; gap:10px;">
            <a href="<?= base_url('home',true) ?>" style="font-size:13px; color:#aaa; text-decoration:none;">Dashboard</a>
            <a href="<?= base_url('trending',true) ?>" style="font-size:13px; color:#aaa; text-decoration:none;">Trending</a>
            <a href="<?= base_url('about',true) ?>" style="font-size:13px; color:#aaa; text-decoration:none;">Tentang Kami</a>
            <a href="<?= base_url('login',true) ?>" style="font-size:13px; color:#aaa; text-decoration:none;">Login</a>
            <a href="<?= base_url('daftar',true) ?>" style="font-size:13px; color:#aaa; text-decoration:none;">Daftar</a>
          </div>
        </div>

        <!-- Kolom 3 - Informasi -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div style="font-size:14px; font-weight:500; color:#fff; margin-bottom:16px; padding-bottom:8px; border-bottom:1px solid rgba(231,94,141,0.3);">Informasi</div>
          <div style="display:flex; flex-direction:column; gap:10px;">
            <a href="#" style="font-size:13px; color:#aaa; text-decoration:none;">Kebijakan Privasi</a>
            <a href="#" style="font-size:13px; color:#aaa; text-decoration:none;">Syarat & Ketentuan</a>
            <a href="#" style="font-size:13px; color:#aaa; text-decoration:none;">Kontak Kami</a>
          </div>
        </div>

      </div>
    </div>

    <!-- Disclaimer & Copyright -->
   <div style="background:rgba(231,94,141,0.08); border-top:1px solid rgba(231,94,141,0.2); padding:8px 0;">
     <div class="container">
      <p style="font-size:10px; color:#555; margin:0; line-height:1.5;">
       Informasi yang disajikan di website ini hanya untuk tujuan edukasi dan bukan merupakan saran investasi. Selalu lakukan riset mandiri sebelum berpartisipasi dalam airdrop apapun.
      &nbsp;|&nbsp; Copyright &copy; 2024 MY Airdrop. All rights reserved.
      </p>
    </div>
  </div>

  </footer>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script>
    
    var BASE_URL = '<?= base_url('',true); ?>';
    var css_btn_confirm = 'main-button';
    var css_btn_cancel = 'main-border-button';
    var base_foto = '<?= image_check('notfound.jpg','default') ?>';
    var user_base_foto = '<?= image_check('user.jpg','default') ?>';
     addEventListener('keypress', function(e) {
        if (e.keyCode === 13 || e.which === 13) {
            e.preventDefault();
            return false;
        }
    });
</script>
  <script src="<?= assets_url('user/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= assets_url('user/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="<?= assets_url('user/') ?>js/isotope.min.js"></script>
  <script src="<?= assets_url('user/') ?>js/owl-carousel.js"></script>
  <script src="<?= assets_url('user/') ?>js/tabs.js"></script>
  <script src="<?= assets_url('user/') ?>js/popup.js"></script>
  <script src="<?= assets_url('user/') ?>js/custom.js"></script>
  <script src="<?= assets_url('public/') ?>js/alert/sweetalert2.js"></script>
  <script src="<?= assets_url('public/') ?>js/alert/scriptalert.js"></script>
  <script src="<?= assets_url('public/') ?>js/function.js"></script>


  </body>

</html>
