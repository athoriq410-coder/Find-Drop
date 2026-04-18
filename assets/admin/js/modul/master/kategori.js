
function ubah_data(element, id) {
    var form = document.getElementById('form_kategori');
    $('#title_modal').text('Ubah Data Kategori');
    form.setAttribute('action', BASE_URL + 'master/ubah_kategori');
    $.ajax({
        url: BASE_URL + 'pengaturan/get_single/kategori',
        method: form.method,
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            $('input[name="id_kategori"]').val(data.id_kategori);
            $('input[name="nama"]').val(data.nama);
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_kategori');
    form.setAttribute('action', BASE_URL + 'master/tambah_kategori');
    $('#title_modal').text('Tambah Kategori');
    $('#form_kategori input').val('');
}