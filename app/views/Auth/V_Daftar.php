
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-top: 120px; padding-bottom: 60px;">
  <div class="row justify-content-center w-100">
    <div class="col-lg-6 col-md-8 col-sm-10">
      <div class="auth-card p-4 p-md-5">

        <div class="text-center mb-4">
          <h4 class="text-white mb-1">Buat Akun Baru</h4>
          <p class="text-muted">Daftarkan diri Anda sekarang</p>
        </div>

        <form id="form_daftar" method="POST" action="<?= base_url('auth/register', true) ?>">

          <div class="mb-3" id="req_daftar_nama">
            <label class="required form-label text-white">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control form-control-inputan"
              placeholder="Masukkan nama lengkap" autocomplete="off">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3" id="req_daftar_email">
                <label class="required form-label text-white">Alamat Email</label>
                <input type="email" name="email" class="form-control form-control-inputan"
                  placeholder="Masukkan alamat email" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3" id="req_daftar_notelp">
                <label class="required form-label text-white">Nomor Handphone</label>
                <div class="input-group flex-nowrap">
                  <span class="input-group-text no-telp pe-2">+62</span>
                  <input type="text" name="notelp" class="form-control form-control-inputan"
                    placeholder="Nomor handphone" autocomplete="off">
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-3" id="req_daftar_password">
                <label class="required form-label text-white">Kata Sandi</label>
                <input type="password" name="password" class="form-control form-control-inputan"
                  placeholder="Masukkan kata sandi" autocomplete="off">
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3" id="req_daftar_konfirmasi">
                <label class="required form-label text-white">Konfirmasi Kata Sandi</label>
                <input type="password" name="konfirmasi" class="form-control form-control-inputan"
                  placeholder="Konfirmasi kata sandi" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="d-grid mb-3 mt-2">
            <button type="button" id="button_daftar" onclick="submit_form(this,'#form_daftar',1)" class="main-button w-100 text-center">
              <span class="indicator-label">Daftar Sekarang</span>
            </button>
          </div>

        </form>

        <p class="text-center text-white mt-3 mb-0">
          Sudah punya akun?
          <a href="<?= base_url('login', true) ?>" style="color: #e75e8d;">Login sekarang</a>
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
  .no-telp {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.2);
    color: #fff;
  }
</style>
