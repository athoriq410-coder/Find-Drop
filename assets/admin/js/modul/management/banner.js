var image = document.getElementById('display_gambar');
$(function () {

    $('.hps_gambar').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});


function edit_banner(element, id) {
    
    var gambar = $(element).data('image');
    var form = document.getElementById('form_banner');
    $('#title_modal').text('Ubah Data Banner');
    form.setAttribute('action', BASE_URL + 'management_function/ubah_banner');
    $.ajax({
        url: BASE_URL + 'management/get_single_banner',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            image.style.backgroundImage = "url('" + gambar + "')";
            var reason = '';
            if (data.banner.block_reason) {
                reason = '</br>Alasan : ' + data.banner.block_reason;
            }
            if (data.banner.status == 'N') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    banner telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_banner"]').val(data.banner.id_banner);
            $('input[name="title"]').val(data.banner.title);
            $('input[name="nama_gambar"]').val(data.banner.gambar);
            $('textarea[name="deskripsi"]').val(data.banner.deskripsi);
        }
    })
}

function tambah_banner() {
    var form = document.getElementById('form_banner');
    form.setAttribute('action', BASE_URL + 'management_function/tambah_banner');
    $('#title_modal').text('Tambah Banner');
    $('#form_banner input').val('');
    $('#form_banner select').val('');
    $('#form_banner select').trigger('change');
    image.style.backgroundImage = "url('" + image_default + "')";
}
