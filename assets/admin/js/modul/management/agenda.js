var image = document.getElementById('display_gambar');
$(function () {

    $('.hps_gambar').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_gambar]').val("");
    });

});


function edit_agenda(element, id) {
    
    var gambar = $(element).data('image');
    var form = document.getElementById('form_agenda');
    $('#title_modal').text('Ubah Data Agenda');
    form.setAttribute('action', BASE_URL + 'management_function/ubah_agenda');
    $.ajax({
        url: BASE_URL + 'management/get_single_agenda',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        beforeSend: function () {
            // console.log('loading...')
        },
        success: function (data) {
            image.style.backgroundImage = "url('" + gambar + "')";
            var reason = '';
            if (data.agenda.block_reason) {
                reason = '</br>Alasan : ' + data.agenda.block_reason;
            }
            if (data.agenda.status == 'N') {
                $('#lead').html('<div class="alert alert-danger d-flex justify-content-between" role="alert"><div class="col-6">\
                    agenda telah di block!'+ reason + '</div><div class="col-6 d-flex justify-content-end"><div class="form-check form-switch">\
                    <input class="form-check-input cursor-pointer" type="checkbox" role="switch" onchange ="switch_block(this,event,'+ id + ',true)" id="switch-on-' + id + '" checked ></div></div>\
                        </div>');
            } else {
                $('#lead').html('');
            }
            $('input[name="id_agenda"]').val(data.agenda.id_agenda);
            $('input[name="title"]').val(data.agenda.title);
            $('input[name="nama_gambar"]').val(data.agenda.gambar);
            $('textarea[name="deskripsi"]').val(data.agenda.deskripsi);
        }
    })
}

function tambah_agenda() {
    var form = document.getElementById('form_agenda');
    form.setAttribute('action', BASE_URL + 'management_function/tambah_agenda');
    $('#title_modal').text('Tambah Agenda');
    $('#form_agenda input').val('');
    $('#form_agenda select').val('');
    $('#form_agenda select').trigger('change');
    image.style.backgroundImage = "url('" + image_default + "')";
}
