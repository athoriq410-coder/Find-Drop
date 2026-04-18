
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 120px; padding-bottom: 60px;">
  <div class="row justify-content-center w-100">
    <div class="col-lg-5 col-md-7 col-sm-10">
      <div class="auth-card p-4 p-md-5">

        <div class="text-center mb-4">
          <h4 class="text-white mb-1">Selamat Datang Kembali</h4>
          <p class="text-muted">Masuk ke akun Anda</p>
        </div>

        <form id="form_login" method="POST" action="<?= base_url('auth/login', true) ?>">
          <div class="mb-3" id="req_login_email">
            <label for="email" class="required form-label text-white">Alamat Email</label>
            <input type="email" id="email" name="email" class="form-control form-control-inputan"
              placeholder="Masukkan alamat email" autocomplete="off">
          </div>

          <div class="mb-4" id="req_login_password">
            <label for="password" class="required form-label text-white">Kata Sandi</label>
            <input type="password" id="password" name="password" class="form-control form-control-inputan"
              placeholder="Masukkan kata sandi" autocomplete="off">
          </div>

          <div class="d-grid mb-3">
            <button type="button" id="button_login" onclick="submit_form(this,'#form_login',1)" class="main-button w-100 text-center">
              <span class="indicator-label">Masuk</span>
            </button>
          </div>
        </form>

        <p class="text-center text-white mt-3 mb-0">
          Belum punya akun?
          <a href="<?= base_url('daftar', true) ?>" style="color: #e75e8d;">Daftar sekarang</a>
        </p>

      </div>
    </div>
  </div>
</div>

<style>
  .auth-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    backdrop-filter: blur(10px);
  }
  .auth-card .main-button {
    display: block;
    width: 100%;
    text-align: center;
    padding: 12px;
    border: none;
    cursor: pointer;
  }
</style>
