var mydeskripsi;
var mytutorial;
    
ClassicEditor.create( document.querySelector( '#deskripsi' ), {
    toolbar: {
        items: ["heading", "|", "bold", "italic", "link", "bulletedList", "numberedList", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed", "undo", "redo"]
    },
    table: {
        contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
    },
    language: "en",
    licenseKey: ''
    
    
} )

.then( editor => {
    //window.editor = editor;
    mydeskripsi = editor;
} )
.catch( error => {
    console.error( 'Oops, something went wrong!' );
    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
    console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
    console.error( error );
} );

ClassicEditor.create( document.querySelector( '#tutorial' ), {
    toolbar: {
        items: ["heading", "|", "bold", "italic", "link", "bulletedList", "numberedList", "|", "outdent", "indent", "|", "blockQuote", "insertTable", "mediaEmbed", "undo", "redo"]
    },
    table: {
        contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"]
    },
    language: "en",
    licenseKey: ''
    
    
} )

.then( editor => {
    //window.editor = editor;
    mytutorial = editor;
} )
.catch( error => {
    console.error( 'Oops, something went wrong!' );
    console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
    console.warn( 'Build id: vd7qnogyyu6n-nohdljl880ze' );
    console.error( error );
} );




var image = document.getElementById('display_foto');
$(function () {

    $('.hps_foto').on('click', function () {
        // console.log('hapus');
        $('input[name=nama_foto]').val("");
    });

});
function ubah_data(element, id) {
    mytutorial.setData('');
             mydeskripsi.setData('');
    var foto = $(element).data('image');
    var form = document.getElementById('form_produk');
    $('#title_modal').text('Ubah Data Produk');
    form.setAttribute('action', BASE_URL + 'master/ubah_produk');
    $.ajax({
        url: BASE_URL + 'pengaturan/get_single/produk',
        method: form.method,
        data: { id: id },
        dataType: 'json',
        success: function (data) {
            image.style.backgroundImage = "url('" + foto + "')";
            
            $('input[name="id_produk"]').val(data.id_produk);
            $('input[name="nama"]').val(data.nama);
            $('input[name="nama_foto"]').val(data.foto);

            $('select[name="id_kategori"]').val(data.id_kategori);
            $('select[name="id_kategori"]').trigger('change');

            $('select[name="verify"]').val(data.verify);
            $('select[name="verify"]').trigger('change');

            $('select[name="id_owner"]').val(data.id_owner);
            $('select[name="id_owner"]').trigger('change');

            if (data.deskripsi != '') {
                mydeskripsi.setData(data.deskripsi);
            }
            if (data.tutorial != '') {
                mytutorial.setData(data.tutorial);
            }
        }
    })
}

function tambah_data() {
    var form = document.getElementById('form_produk');
    form.setAttribute('action', BASE_URL + 'master/tambah_produk');
    $('#title_modal').text('Tambah produk');
    image.style.backgroundImage = "url('" + base_foto + "')";
    $('#form_produk input').val('');
    $('#form_produk textarea').val('');
    $('#form_produk select').val('');
    $('#form_produk select').trigger('change');
    mydeskripsi.setData('');
    mytutorial.setData('');
}
