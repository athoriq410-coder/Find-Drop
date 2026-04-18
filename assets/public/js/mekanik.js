$(function () {
    if ($('.search_mekanik input[type="text"]')) {
        var i = document.querySelector('.search_mekanik i');
        var button = document.querySelector('.search_mekanik button');
        var input = document.querySelector('.search_mekanik input');
        $('.search_mekanik input[type="text"]').on('keydown', function () {
            var value = $(this).val();
            if (value != '') {
                i.classList.add('d-none');
                input.classList.remove('ps-13');
                button.classList.remove('d-none');
                $('.search_mekanik button').attr('disabled', false);
            } else {
                i.classList.remove('d-none');
                input.classList.add('ps-13');
                button.classList.add('d-none');
                $('.search_mekanik button').attr('disabled', true);
            }
        })
    }


     /* Tanpa Rupiah */
    
    

    


});
function matauang(element = null,rep = null)
    {
         var angka = $(element).val();
       
        var rupiah = format_uang(angka);
        
        
        $(element).val(rupiah);
        if (rep != null) {
            var asli = angka.replaceAll(".", "");
            $(rep).val(asli);
        }
    }

    function format_uang(angka)
    {
       
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

function func_search(element){
     var i = document.querySelector('.search_mekanik i');
        var button = document.querySelector('.search_mekanik button');
        var input = document.querySelector('.search_mekanik input');
            var value = $(element).val();
            if (value != '') {
                i.classList.add('d-none');
                input.classList.remove('ps-13');
                button.classList.remove('d-none');
                $('.search_mekanik button').attr('disabled', false);
            } else {
                i.classList.remove('d-none');
                input.classList.add('ps-13');
                button.classList.add('d-none');
                $('.search_mekanik button').attr('disabled', true);
            }
}
function checked_action(element, child = 'child_checkbox') {
    var drag = document.getElementById('sistem_drag');
    var filter = document.getElementById('sistem_filter');
    if ($(element).is(':checked')) {
        drag.classList.remove('d-none');
        filter.classList.add('d-none');
        $('.' + child).prop('checked', true);
    } else {
        drag.classList.add('d-none');
        filter.classList.remove('d-none');
        $('.' + child).prop('checked', false);
    }


}

function child_checked(main = '') {
    var drag = document.getElementById('sistem_drag');
    var filter = document.getElementById('sistem_filter');

    var total = $('.child_checkbox').length;
    var total_checked = $('input.child_checkbox:checked').length;
    if (main == '') {
         if (total_checked == total) {
            $('thead input[type=checkbox]').prop('checked', true);
        } else {
            $('thead input[type=checkbox]').prop('checked', false);
        }
    }else{
         if (total_checked == total) {
            $(main).prop('checked', true);
        } else {
            $(main).prop('checked', false);
        }
    }
   
    if ($(this).is(':checked')) {
        if (total_checked > 0) {
            drag.classList.remove('d-none');
            filter.classList.add('d-none');
        } else {
            drag.classList.add('d-none');
            filter.classList.remove('d-none');

        }

    } else {
        if (total_checked > 0) {
            drag.classList.remove('d-none');
            filter.classList.add('d-none');
        } else {
            drag.classList.add('d-none');
            filter.classList.remove('d-none');
        }
    }
}
function search(excel = true) {
    var src = $('.search_mekanik input[name=search]').val();
    src = src.split(" ");
    var value = '';
    var no = 0;
    src.forEach(val => {
        if (no++ > 0) {
            value += '--';
        }
        value += val
    });
    var get = url_get();
    if (excel == true) {
         var l = $('#cetak_excel').attr('href');
        const li = l.split("?");
        var link_cetak = li[0];
    }
   
    var params = '';
    if (get.length > 0) {
        if (get[0].split('=')[0] != 'search') {
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'search') {
                    if (i == 0) {
                        params += '?' + get[i];
                    } else {
                        params += '&' + get[i];
                    }
                }

            }
            params += '&search=' + value;
        } else {

            params += '?search=' + value;
            for (var i = 0; i < get.length; i++) {

                if (get[i].split('=')[0] != 'search') {

                    params += '&' + get[i];
                }
            }
        }
    } else {

        params = '?search=' + value;
    }

    var uri = BASE_URL + page + params;
    uri = encodeURI(uri);
    if (excel == true) {
         $('#cetak_excel').attr('href', link_cetak + params);
    }
   
    window.history.pushState('', '', uri);
    $('#base_table').load(uri + ' #reload_table');

}

function filter(name = [],excel = true,hid = true) {
    var get = url_get();
    if (excel == true) {
          var l = $('#cetak_excel').attr('href');
    const li = l.split("?");
    var link_cetak = li[0];
    }
  
    var params = '';
    if (name.length > 0) {

        if (get.length > 0) {
            params += '?';
            // fruits.includes("Mango");
            for (var i = 0; i < get.length; i++) {
                if (!name.includes(get[i].split('=')[0])) {
                    params += get[i] + '&';
                }
            }
            for (var i = 0; i < name.length; i++) {
                params += name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("") + '&';
            }
        } else {
            for (var i = 0; i < name.length; i++) {
                if (i == 0) {
                    params += '?' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("");
                } else {
                    params += '&' + name[i] + '=' + $('.filter_mekanik .filter-input[name=' + name[i] + ']').val().split(" ").join("");
                }

            }
        }
        var uri = BASE_URL + page + params;
        uri = encodeURI(uri);
        if (excel == true) {
             $('#cetak_excel').attr('href', link_cetak + params);
        }
       
        window.history.pushState('', '', uri);
        if (hid == true) {
            $('.filter_mekanik').hide();
        }
        
        $('#base_table').load(uri + ' #reload_table');
    }
}
function url_get() {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    var data = [];
    for (var i = 0; i < sURLVariables.length; i++) {
        if (sURLVariables[i] != '') {
            data[i] = sURLVariables[i]
        }

    }
    // console.log(data);
    return data;
}

function url_get_1() {
    var url = window.location.search.substring(1);
    var request = {};
    var arr = [];
    var pairs = url.substring(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < pairs.length; i++) {
      var pair = pairs[i].split('=');

      //check we have an array here - add array numeric indexes so the key elem[] is not identical.
      if(endsWith(decodeURIComponent(pair[0]), '[]') ) {
          var arrName = decodeURIComponent(pair[0]).substring(0, decodeURIComponent(pair[0]).length - 2);
          if(!(arrName in arr)) {
              arr.push(arrName);
              arr[arrName] = [];
          }

          arr[arrName].push(decodeURIComponent(pair[1]));
          request[arrName] = arr[arrName];
      } else {
        request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
      }
    }
    // console.log(request);
    return Object.keys(request);
}
function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function pagination(element, e) {
    var drag = document.getElementById('sistem_drag');
    var filter = document.getElementById('sistem_filter');
    var uri = window.location.search;
    e.preventDefault();
    var child = $(element).children("a");
    var href = child.attr("href");
    if (uri) {
        var url = href + uri;
    } else {
        var url = href;
    }
    // console.log(url);
    $('#base_table').load(url + ' #reload_table');
    window.history.pushState('', '', url);
    drag.classList.add('d-none');
    filter.classList.remove('d-none');
}



function page_to(element, page,active = '',url_ajax = '', base_screen = '#base_screen') {
    var menu = $(element).data('active');
    var title_page = $(element).data('title_page');
    var arr_page = page.split('/');
    var eja = '';
    var params = [];
    if (arr_page.length > 1) {
        var no = 0;
        for (let a = 0; a < arr_page.length; a++) {
            if (!isNaN(arr_page[a]) == false) {
                if (a == 0) {
                    eja += arr_page[a];
                }else{
                    eja += '_'+arr_page[a];
                } 
            }else{
                var num = no++;
                params[num] = arr_page[a];
            }
            
        }
    }else{
        eja += arr_page[0];
    }
    
    if (menu == true) {
        $('#parent_menu_footer .text-success').addClass('text-secondary-off');
        $('#parent_menu_footer .text-success').removeClass('text-success');
        if (active != '') {
            $(active+' .'+eja).addClass('text-success');
            $(active+' .'+eja).removeClass('text-secondary-off');
        }else{
            $(element+' .'+eja).addClass('text-success');
            $(element+' .'+eja).removeClass('text-secondary-off');
        }
    }
    
    
        
    $('.manipulate_page.showin').addClass('hidin');
    $('.manipulate_page.showin').removeClass('showin');

    if ($('.component.'+eja)) {
        $('.component.showin').addClass('hidin');
        $('.component.showin').removeClass('showin');

        $('.component.'+eja).removeClass('hidin');
        $('.component.'+eja).addClass('showin');
    }
    
    
    $('#'+eja).removeClass('hidin');
    $('#'+eja).addClass('showin');

    var jumlah_page = eja.split("_");
    var merge_title = '';
    if (jumlah_page.length > 1) {
        for (let i = 0; i < jumlah_page.length; i++) {
            if (!isNaN(jumlah_page[i]) == false) {
                merge_title += jumlah_page[i].charAt(0).toUpperCase() + jumlah_page[i].slice(1)+' ';
            }
        }
        merge_title = merge_title.trim();
    }else{
        merge_title = jumlah_page[0].charAt(0).toUpperCase() + jumlah_page[0].slice(1);
    }
    
    var url = BASE_URL + page;
    var prev = window.location.href
    var pg = '';
    prev = prev.split(domain);
    prev = prev[1].split('/')
    if (prev.length <= 3) {
        for (let p = 1; p < prev.length; p++) {
            if (p == 1) {
                pg += prev[p];
            }else{
                pg += '/'+prev[p];
            }
        }
        // console.log(pg);
        prev_page = pg;
    }else{
        prev_page = 'profil';
    }

    // console.log(prev_page);
   
    if (title_page == true) {
        $('#paging_title').text(merge_title);
    }

    if (url_ajax != '') {
        $.ajax({
            url: url_ajax,
            data : {ins : params},
            method: 'POST',
            cache: false,
            beforeSend: function() {
                $(base_screen).html('');
                KTApp.showPageLoading();
            },
            success: function (msg) {
                KTApp.hidePageLoading();
                $(base_screen).html(msg);
            }
        })
    }
    
    if (main_page.includes(page)) {
        $('#menu_back').removeClass('showin');
        $('#menu_back').addClass('hidin');
        
        $('#kt_app_footer').addClass('showin_float');
        $('#kt_app_footer').removeClass('hidin');
        $('#kt_app_footer_transaksi').removeClass('showin_float');
        $('#kt_app_footer_transaksi').addClass('hidin');  
        
    }else{
        $('#menu_back').addClass('showin');
        $('#menu_back').removeClass('hidin');
        
        if (eja != 'transaksi') {
            $('#kt_app_footer').removeClass('showin_float');
            $('#kt_app_footer').addClass('hidin');
            $('#kt_app_footer_transaksi').removeClass('showin_float');
            $('#kt_app_footer_transaksi').addClass('hidin');  
        }else{
            $('#kt_app_footer').addClass('hidin');
            $('#kt_app_footer').removeClass('showin_float');
            $('#kt_app_footer_transaksi').removeClass('hidin');
            $('#kt_app_footer_transaksi').addClass('showin_float');  
        }
       
    }
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    const title = web_title+' '+merge_title;
    document.title = title;
    window.history.pushState('', '', url);

}

function page_red_to(page,active = false,menu = false) {
    var title_page = false;
    var arr_page = page.split('/');
    var eja = '';
    var params = [];
    if (arr_page.length > 1) {
        var no = 0;
        for (let a = 0; a < arr_page.length; a++) {
            if (!isNaN(arr_page[a]) == false) {
                if (a == 0) {
                    eja += arr_page[a];
                }else{
                    eja += '_'+arr_page[a];
                } 
            }else{
                var num = no++;
                params[num] = arr_page[a];
            }
            
        }
    }else{
        eja += arr_page[0];
    }
    if ($('#menu_'+eja)) {
        menu = $('#menu_'+eja).data('active');
        title_page = $('#menu_'+eja).data('title_page');
    }
    
    if (menu == true) {
        $('#parent_menu_footer .text-success').addClass('text-secondary-off');
        $('#parent_menu_footer .text-success').removeClass('text-success');
        if (active == true) {
            $('#menu_'+page+' .'+page).addClass('text-success');
            $('#menu_'+page+' .'+page).removeClass('text-secondary-off');
        }
    }
     
    $('.manipulate_page.showin').addClass('hidin');
    $('.manipulate_page.showin').removeClass('showin');

    if ($('.component.'+eja)) {
        $('.component.showin').addClass('hidin');
        $('.component.showin').removeClass('showin');

        $('.component.'+eja).removeClass('hidin');
        $('.component.'+eja).addClass('showin');
    }
    
    
    $('#'+eja).removeClass('hidin');
    $('#'+eja).addClass('showin');

    var jumlah_page = page.split("_");
    var merge_title = '';
    var pagename = page;
    if (jumlah_page.length > 1) {
        for (let i = 0; i < jumlah_page.length; i++) {
            merge_title += jumlah_page[i].charAt(0).toUpperCase() + jumlah_page[i].slice(1)+' ';
        }
        merge_title = merge_title.trim();
    }else{
        merge_title = pagename.charAt(0).toUpperCase() + pagename.slice(1);
    }
    
    var url = BASE_URL + page;
    var prev = window.location.href
    var pg = '';
    prev = prev.split(domain);
    prev = prev[1].split('/')
    if (prev.length <= 3) {
        for (let p = 1; p < prev.length; p++) {
            if (p == 1) {
                pg += prev[p];
            }else{
                pg += '/'+prev[p];
            }
        }
        // console.log(pg);
        prev_page = pg;
    }else{
        prev_page = 'profil';
    }
    
   
    if (title_page == true) {
        
        $('#paging_title').text(merge_title);
    }
    if (main_page.includes(page)) {
        $('#menu_back').removeClass('showin');
        $('#menu_back').addClass('hidin');
        
        $('#kt_app_footer').addClass('showin_float');
        $('#kt_app_footer').removeClass('hidin');
        $('#kt_app_footer_transaksi').removeClass('showin_float');
        $('#kt_app_footer_transaksi').addClass('hidin');  
        
    }else{
        $('#menu_back').addClass('showin');
        $('#menu_back').removeClass('hidin');
        
        if (eja != 'transaksi') {
            $('#kt_app_footer').removeClass('showin_float');
            $('#kt_app_footer').addClass('hidin');
            $('#kt_app_footer_transaksi').removeClass('showin_float');
            $('#kt_app_footer_transaksi').addClass('hidin');  
        }else{
            $('#kt_app_footer').addClass('hidin');
            $('#kt_app_footer').removeClass('showin_float');
            $('#kt_app_footer_transaksi').removeClass('hidin');
            $('#kt_app_footer_transaksi').addClass('showin_float');  
        }

        
       
    }
    $('html, body').animate({ scrollTop: 0 }, 'fast');
    
    const title = web_title+' '+merge_title;
    document.title = title;
    window.history.pushState('', '', url);

}



function back_page() {
    page_red_to(prev_page, true);
}

function setup_value(place,value) {
    $(place).val(value);
}