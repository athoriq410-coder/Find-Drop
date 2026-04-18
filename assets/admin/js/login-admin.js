function doLoginAdmin() {
   var email    = $('#req_login_email').val();
   var password = $('#req_login_password').val();

   if (!email || !password) {
      alert('Email dan password tidak boleh kosong!');
      return;
   }

   $.ajax({
      url: LOGIN_ADMIN_URL,
      type: 'POST',
      data: { email: email, password: password },
      success: function(res) {
         var result = typeof res === 'string' ? JSON.parse(res) : res;
         if (result.status == 200) {
            alert(result.alert.message);
            window.location.href = result.redirect;
         } else {
            alert(result.alert.message || 'Login gagal!');
         }
      },
      error: function() {
         alert('Terjadi kesalahan, silahkan coba lagi.');
      }
   });
}

$(document).ready(function() {
   $(document).on('keypress', function(e) {
      if (e.which === 13) {
         doLoginAdmin();
      }
   });
});