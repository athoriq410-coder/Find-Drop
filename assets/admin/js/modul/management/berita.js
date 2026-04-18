var image = document.getElementById('display_gambar');
$(function () {

    $('.hps_gambar').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});


function edit_berita(element, id) {
    
    var gambar = $(element).data('image');
    var form = document.getElementById('form_berita');
    $('#title_modal').text('Ubah Data Berita');
    form.setAttribute('action', BASE_URL + 'management_function/ubah_berita');
    $.ajax({
        url: BASE_URL + 'management/get_single_berita',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            image.style.backgroundImage = "url('" + gambar + "')";
            var reason = '';
            if (data.berita.block_reason) {
                reason = '</br>Alasan : ' + data.berita.block_reason;
            }
            if (data.berita.status == 'N') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    berita telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_berita"]').val(data.berita.id_berita);
            $('input[name="title"]').val(data.berita.title);
            $('input[name="nama_gambar"]').val(data.berita.gambar);
            $('textarea[name="deskripsi"]').val(data.berita.deskripsi);
        }
    })
}

function tambah_berita() {
    var form = document.getElementById('form_berita');
    form.setAttribute('action', BASE_URL + 'management_function/tambah_berita');
    $('#title_modal').text('Tambah Berita');
    $('#form_berita input').val('');
    $('#form_berita select').val('');
    $('#form_berita select').trigger('change');
    image.style.backgroundImage = "url('" + image_default + "')";
}
