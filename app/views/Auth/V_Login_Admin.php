<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Login Admin | <?= ucfirst(WEB_NAME) ?></title>
   <link rel="shortcut icon" href="<?= base_url('data/setting/6690067678f02-1720714870.png', true) ?>">
   <link href="<?= assets_url('user/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="<?= assets_url('admin/') ?>css/login-admin.css">
</head>
<body>

   <div class="login-wrapper">
      <div class="login-box">

         <div class="login-logo">MY AIRDROP</div>
         <h5 class="login-title">Admin Panel</h5>
         <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="req_login_email" placeholder="admin@email.com">
         </div>

         <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" id="req_login_password" placeholder="••••••••">
         </div>

         <button class="btn-login" onclick="doLoginAdmin()">Masuk sebagai Admin</button>

         <a href="<?= base_url('home', true) ?>" class="back-link">← Kembali ke halaman utama</a>

      </div>
   </div>

   <!-- Scripts -->
   <script src="<?= assets_url('user/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= assets_url('public/') ?>js/alert/sweetalert2.js"></script>
<script src="<?= assets_url('public/') ?>js/alert/scriptalert.js"></script>
<script src="<?= assets_url('public/') ?>js/function.js"></script>
<script>
   var BASE_URL = '<?= base_url('', true) ?>';
   var LOGIN_ADMIN_URL = '<?= base_url('auth/login_admin', true) ?>';
</script>
<script src="<?= assets_url('admin/') ?>js/login-admin.js"></script>
</html>