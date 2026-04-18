<div class="container">
<div class="row">
    <div class="col-lg-12">
    <div class="page-content">

        <!-- ***** Banner Start ***** -->
        <div class="row">
        <div class="col-lg-12">
            <div class="main-profile ">
            <div class="row header-text">
                <div class="col-lg-4">
                <img src="<?= image_check($result->foto,'member','user'); ?>" alt="" style="border-radius: 23px;">
                </div>
                <div class="col-lg-8 align-self-center">
                <ul>
                    <li class="d-flex justify-content-start align-items-start flex-column">Nama Lengkap <br><span><?= $result->nama;?></span></li>
                    <li class="d-flex justify-content-start align-items-start flex-column">Email <span><?= $result->email;?></span></li>
                    <li class="d-flex justify-content-start align-items-start flex-column">Nomor <span><?= phone_format('0'.$result->notelp);?></span></li>
                    <li>
                        <div class="main-border-button">
                    <a data-bs-toggle="modal" href="#EditProfilModal" role="button" class="btn">Edit Profil</a>
                    </div>
                    </li>
                </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="clips">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="heading-section">
                        <h4>My Airdrops</h4>
                        </div>
                    </div>
                    <?php if($airdrop) : ?>
                        <?php foreach($airdrop AS $row) : ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="item">
                            <div class="thumb">
                                <div class="img-thumb" style="background-image: url('<?= image_check($row->foto,'produk'); ?>'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            </div>
                            <div class="down-content d-flex justify-content-between align-items-between mt-4 mb-3">
                                <div class="d-flex align-items-start flex-column">
                                <h4><?= $row->nama; ?></h4>
                                </div>
                                <?php if($row->verify == 'Y') : ?>
                                <div class="badge-terbaru">
                                <h6 class="mt-0">Verified</h6>
                                </div>
                                <?php endif;?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span><?= short_text($row->deskripsi,80); ?></span>
                                <a href="<?= base_url('user/remove_fav/'.$row->id_produk, true) ?>" 
                                   onclick="return confirm('Hapus airdrop ini dari favorit?')"
                                   title="Hapus dari favorit"
                                   style="color:#e75e8d;font-size:20px;margin-left:10px;flex-shrink:0;">
                                   &times;
                                </a>
                            </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-lg-12 text-center" style="color:rgba(255,255,255,0.5);padding:30px 0;">
                            Belum ada airdrop yang disimpan.
                        </div>
                    <?php endif;?>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <!-- ***** Banner End ***** -->
    </div>
    </div>
</div>
</div>

 <!-- Modal Edit Profil -->
  <div class="modal fade" id="EditProfilModal" tabindex="-1" aria-labelledby="EditProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header border-0 m-2">
          <p class="modal-title text-white fs-5" id="EditProfilModalLabel">Edit Profil Find Drops</p>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="form_ubah_profil" action="<?= base_url('user/ubah_profil', true) ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body" style="max-height:70vh;overflow-y:auto;">

          <!-- Foto Profil -->
          <div class="mb-3 px-3 d-flex flex-column align-items-center">
            <label class="form-label text-white">Foto Profil</label>
            <img id="preview_foto" src="<?= image_check($result->foto,'member','user') ?>" alt="Foto Profil" style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:10px;">
            <input type="file" name="foto" class="form-control form-control-inputan" accept=".png,.jpg,.jpeg" onchange="previewFoto(this)">
            <input type="hidden" name="nama_foto" value="<?= $result->foto ?>">
          </div>

          <div class="mb-3 px-3" id="req_profil_nama">
            <label class="form-label text-white">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control form-control-inputan" placeholder="Masukkan nama lengkap" value="<?= $result->nama ?>">
          </div>
          <div class="mb-3 px-3" id="req_profil_email">
            <label class="form-label text-white">Alamat Email</label>
            <input type="email" name="email" class="form-control form-control-inputan" placeholder="Masukkan alamat email" value="<?= $result->email ?>">
          </div>
          <div class="mb-3 px-3">
            <label class="form-label text-white">Nomor Telepon</label>
            <input type="text" name="notelp" class="form-control form-control-inputan" placeholder="Masukkan nomor telepon" value="<?= '0'.$result->notelp ?>">
          </div>
          <hr style="border-color:rgba(255,255,255,0.2)">
          <p class="text-white px-3" style="font-size:12px;opacity:0.7">Isi bagian berikut hanya jika ingin mengubah kata sandi</p>
          <div class="mb-3 px-3">
            <label class="form-label text-white">Kata Sandi Lama</label>
            <input type="password" name="password" class="form-control form-control-inputan" placeholder="Masukkan kata sandi lama">
          </div>
          <div class="mb-3 px-3">
            <label class="form-label text-white">Kata Sandi Baru</label>
            <input type="password" name="newpassword" class="form-control form-control-inputan" placeholder="Masukkan kata sandi baru">
          </div>
          <div class="mb-3 px-3">
            <label class="form-label text-white">Konfirmasi Kata Sandi</label>
            <input type="password" name="repassword" class="form-control form-control-inputan" placeholder="Konfirmasi kata sandi baru">
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center align-items-center border-0">
         <div class="main-button">
          <button type="button" onclick="submitProfil()" class="mb-3 btn" style="background:none; border:none; padding:0; color: #FF007F;">Simpan</button>
         </div>
        </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

<script>
function previewFoto(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview_foto').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

function submitProfil() {
  var form = document.getElementById('form_ubah_profil');
  var formData = new FormData(form);
  var btn = event.target;
  btn.disabled = true;
  btn.innerText = 'Menyimpan...';

  fetch(form.action, {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    btn.disabled = false;
    btn.innerText = 'Simpan';
    if (data.status === true) {
      alert(data.alert.message);
      window.location.reload();
    } else {
      alert(data.alert.message ?? 'Terjadi kesalahan, coba lagi.');
    }
  })
  .catch(() => {
    btn.disabled = false;
    btn.innerText = 'Simpan';
    alert('Gagal menghubungi server.');
  });
}
</script>