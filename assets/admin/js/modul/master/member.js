var image = document.getElementById('display_foto');
$(function () {

    $('.hps_foto').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_foto]').val("");
    });

});
function ubah_data(element, id) {
    var foto = $(element).data('image');
    var form = document.getElementById('form_member');
    $('#title_modal').text('Ubah Data Member');
    form.setAttribute('action', BASE_URL + 'master/ubah_member');
    $.ajax({
        url: BASE_URL + 'pengaturan/get_single/user',
        method: form.method,
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            image.style.backgroundImage = "url('" + foto + "')";
            $('input[name="id_user"]').val(data.id_user);
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
    var form = document.getElementById('form_member');
    form.setAttribute('action', BASE_URL + 'master/tambah_member');
    $('#title_modal').text('Tambah Datas Member');
    image.style.backgroundImage = "url('" + user_base_foto + "')";
    $('#form_member input').val('');
    $('#form_member textarea').val('');
    $('#form_member select').val('');
    $('#form_member select').trigger('change');
}
