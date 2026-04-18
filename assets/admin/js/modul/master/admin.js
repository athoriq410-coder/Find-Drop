var image = document.getElementById('display_foto');
$(function () {

    $('.hps_foto').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_foto]').val("");
    });

});
function ubah_data(element, id) {
    var foto = $(element).data('image');
    var form = document.getElementById('form_admin');
    $('#title_modal').text('Ubah Data Admin');
    form.setAttribute('action', BASE_URL + 'master/ubah_admin');
    $.ajax({
        url: BASE_URL + 'pengaturan/get_single/admin',
        method: form.method,
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            image.style.backgroundImage = "url('" + foto + "')";
            $('input[name="id_admin"]').val(data.id_admin);
            $('input[name="nama"]').val(data.nama);
            $('input[name="notelp"]').val(data.notelp);
            $('input[name="email"]').val(data.email);
            $('input[name="nama_foto"]').val(data.foto);
            $('textarea[name="alamat"]').val(data.alamat);

            $('select[name="role"]').val(data.role);
            $('select[name="role"]').trigger('change');
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_admin');
    form.setAttribute('action', BASE_URL + 'master/tambah_admin');
    $('#title_modal').text('Tambah Data Admin');
    image.style.backgroundImage = "url('" + user_base_foto + "')";
    $('#form_admin input').val('');
    $('#form_admin textarea').val('');
    $('#form_admin select').val('');
    $('#form_admin select').trigger('change');
}
