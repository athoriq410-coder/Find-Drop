<?php

class C_Master extends Admin
{
    var $id_user = '';
    var $id_role = '';
    public function __construct()
    {
        $this->action = $this->model('M_action');
        $this->id_user = session(WEB_NAME.'_id_user');
        $this->id_role = session(WEB_NAME.'_id_role');
    }

    public function index()
    {
        redirect('master/member');
    }


    public function admin()
    {
        // GET FILTER DATA
        $search = (isset($_GET['search'])) ? search_encode($_GET['search']) : '';
        $status = (isset($_GET['status'])) ? $_GET['status'] : '';

        // SET TITLE
        $data['title'] = 'Data Admin';

        // SET JS
        $data['js'][] = '<script>var page = "master/admin"</script>';
        $data['js'][] = '<script src="'.assets_url('admin/js/modul/master/admin.js').'"></script>';

        // GET DATA
        $offset = uri_segment(2);
        $limit = 5;
        $params = [];
        $where = [];

        // WHERE
        if ($status && $status != 'all') {
            $where['status'] = $status;
        }
        
        // PARAMS
        if ($search) {
            $params['columnsearch'][] = 'nama';
            $params['columnsearch'][] = 'email';
            $params['columnsearch'][] = 'notelp';
            $params['search'] = $search;
        }
        $jumlah = $this->action->get_where_params('admin',$where,'*',$params);

        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $result = $this->action->get_where_params('admin',$where,'*',$params);
        // SET DATA
        $data['result'] = $result;
        $data['jumlah'] = count($jumlah);
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['search'] = $search;

        // SET VIEW
        $this->display('Master/V_Admin',$data);
    }

    public function member()
    {
        // GET FILTER DATA
        $search = (isset($_GET['search'])) ? search_encode($_GET['search']) : '';
        $status = (isset($_GET['status'])) ? $_GET['status'] : '';

        // SET TITLE
        $data['title'] = 'Data Member';

        // SET JS
        $data['js'][] = '<script>var page = "master/member"</script>';
        $data['js'][] = '<script src="'.assets_url('admin/js/modul/master/member.js').'"></script>';

        // GET DATA
        $offset = uri_segment(2);
        $limit = 5;
        $params = [];
        $where = [];

        // WHERE
        if ($status && $status != 'all') {
            $where['status'] = $status;
        }
        
        // PARAMS
        if ($search) {
            $params['columnsearch'][] = 'nama';
            $params['columnsearch'][] = 'email';
            $params['columnsearch'][] = 'notelp';
            $params['search'] = $search;
        }
        $jumlah = $this->action->get_where_params('user',$where,'*',$params);

        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $result = $this->action->get_where_params('user',$where,'*',$params);
        // SET DATA
        $data['result'] = $result;
        $data['jumlah'] = count($jumlah);
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['search'] = $search;

        // SET VIEW
        $this->display('Master/V_Member',$data);
    }


    public function kategori()
    {
        // GET FILTER DATA
        $search = (isset($_GET['search'])) ? search_encode($_GET['search']) : '';
        $status = (isset($_GET['status'])) ? $_GET['status'] : '';

        // SET TITLE
        $data['title'] = 'Data Kategori';

        // SET JS
        $data['js'][] = '<script>var page = "master/kategori"</script>';
        $data['js'][] = '<script src="'.assets_url('admin/js/modul/master/kategori.js').'"></script>';

        // GET DATA
        $offset = uri_segment(2);
        $limit = 5;
        $params = [];
        $where = [];

        // WHERE
        if ($status) {
            $where['status'] = $status;
        }
        
        // PARAMS
        if ($search) {
            $params['columnsearch'][] = 'nama';
            $params['search'] = $search;
        }
        $jumlah = $this->action->get_where_params('kategori',$where,'*',$params);

        $params['limit'] = $limit;
        $params['offset'] = $offset;
        $result = $this->action->get_where_params('kategori',$where,'*',$params);
        // SET DATA
        $data['result'] = $result;
        $data['jumlah'] = count($jumlah);
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['search'] = $search;

        // SET VIEW
        $this->display('Master/V_Kategori',$data);
    }

    public function produk()
    {
        // GET FILTER DATA
        $search = (isset($_GET['search'])) ? search_encode($_GET['search']) : '';
        $status = (isset($_GET['status'])) ? $_GET['status'] : '';

        // SET TITLE
        $data['title'] = 'Data Produk';

        // SET JS
        $data['js'][] = '<script>var page = "master/produk"</script>';
        $data['js'][] = '<script src="'.assets_url('admin/js/modul/master/produk.js').'"></script>';

        // GET DATA
        $offset = uri_segment(2);
        $limit = 5;
        $params = [];
        $where = [];

        // WHERE
        if ($status) {
            $where['produk.status'] = $status;
        }
        // PARAMS
        if ($search) {
            $params['columnsearch'][] = 'produk.nama';
            $params['columnsearch'][] = 'kategori.nama';
            $params['search'] = $search;
        }
        $params['arrjoin']['kategori']['statement'] = 'produk.id_kategori = kategori.id_kategori';
        $params['arrjoin']['kategori']['type'] = 'LEFT';
        $jumlah = $this->action->get_where_params('produk',$where,'*',$params);

        $params['limit'] = $limit;
        $params['offset'] = $offset;

        $result = $this->action->get_where_params('produk',$where,'produk.*,kategori.nama AS kategori',$params);
        $kategori = $this->action->get_all('kategori',['status' => 'Y']);
        // SET DATA
        $data['result'] = $result;
        $data['kategori'] = $kategori;
        $data['jumlah'] = count($jumlah);
        $data['limit'] = $limit;
        $data['offset'] = $offset;
        $data['search'] = $search;

        // SET VIEW
        $this->display('Master/V_Produk',$data);
    }



    // FUNGSI_ADMIN

    public function tambah_admin()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama admin';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['email']           = 'Alamat email';
        $arrVar['password']         = 'Kata sandi';
        $arrVar['repassword']       = 'Konfirmasi kata sandi ';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['password', 'repassword'])) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $tujuan = './data/admin/';
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/admin/')) {
                    mkdir('./data/admin');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];

                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            $admin_mail = $this->action->get_single('admin', ['email' => $email]);
            if ($admin_mail) {
                $data['status'] = false;
                $data['alert']['message'] = 'Email sudah terdaftar sebagai admin!';
                echo json_encode($data);
                exit;
            }else{
                $user_mail = $this->action->get_single('user', ['email' => $email]);
                if ($user_mail) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Email sudah terdaftar sebagai member!';
                    echo json_encode($data);
                    exit;
                }
            }
             $user_telp = $this->action->get_single('admin', ['notelp' => $notelp]);
            if ($user_telp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                echo json_encode($data);
                exit;
            }

            if ($password != $repassword) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                echo json_encode($data);
                exit;
            } else {
                $post['password'] = hash_my_password($email . $password);
            }
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }
            
            $insert = $this->action->insert('admin', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data admin berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/admin #reload_table',true);
                $data['modal']['id'] = '#kt_modal_admin';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_admin()
    {
        // VARIABEL
        $arrVar['id_admin']          = 'Id admin';
        $arrVar['nama']             = 'Nama admin';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['email']            = 'Alamat email';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var];
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action->get_single('admin', ['id_admin' => $id_admin]);
        $password = $_POST['password'] ?? '';
        $repassword = $_POST['repassword'] ?? '';
        $nama_foto = $_POST['nama_foto'] ?? '';
        $tujuan = './data/admin/';
        if ($result->email != $email) {
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            $admin_mail = $this->action->get_single('admin', ['email' => $email,'id_admin !=' => $id_admin]);
            if ($admin_mail) {
                $data['status'] = false;
                $data['alert']['message'] = 'Email sudah terdaftar sebagai admin!';
                echo json_encode($data);
                exit;
            }else{
                $user_mail = $this->action->get_single('user', ['email' => $email]);
                if ($user_mail) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Email sudah terdaftar sebagai user!';
                    echo json_encode($data);
                    exit;
                }
            } 
            if (!$password) {
                $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            } 
            if (!$repassword) {
                $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            }   
             
        }
        if (!in_array(false, $arrAccess)) {
            if ($result->notelp != $notelp) {
                $cek_notelp = $this->action->get_single('admin', ['notelp' => $notelp,'id_admin !=' => $id_admin]);
                if ($cek_notelp) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }      
            }

            if ($password) {
                if ($password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($email . $password);
                }
            } 

            if (!empty($_FILES['foto']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/admin/')) {
                    mkdir('./data/admin');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];
                    if ($nama_foto) {
                        if (file_exists($tujuan.$nama_foto)) {
                            unlink($tujuan.$nama_foto);
                        }
                    }
                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }else{
                 if (!$nama_foto) {
                    if ($result->foto != '' && file_exists($tujuan.$result->foto)) {
                        unlink($tujuan.$result->foto);
                    }
                    $post['foto'] = '';
                }
            }
            
            $update = $this->action->update('admin', $post, ['id_admin' => $id_admin]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data admin berhasil di rubah!';
                 $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/admin #reload_table', true);
                $data['modal']['id'] = '#kt_modal_admin';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_admin()
    {
        $id = $_POST['id'];
        $res = $this->action->get_single('admin',['id_admin' => $id]);
        if ($res) {
            $hapus = $this->action->delete('admin',['id_admin' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data admin berhasil dihapus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/admin #reload_table', true);
                if ($res->foto != '' && file_exists('./data/admin/'.$res->foto)) {
                    unlink('./data/admin/'.$res->foto);
                 }
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data admin gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data admin tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }




    // FUNGSI_MEMBER

    public function tambah_member()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama member';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['email']           = 'Alamat email';
        $arrVar['password']         = 'Kata sandi';
        $arrVar['repassword']       = 'Konfirmasi kata sandi ';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['password', 'repassword'])) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $tujuan = './data/member/';
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/member/')) {
                    mkdir('./data/member');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];

                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            $user_mail = $this->action->get_single('user', ['email' => $email]);
            if ($user_mail) {
                $data['status'] = false;
                $data['alert']['message'] = 'Email sudah terdaftar sebagai member!';
                echo json_encode($data);
                exit;
            }else{
                $admin_mail = $this->action->get_single('admin', ['email' => $email]);
                if ($admin_mail) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Email sudah terdaftar sebagai admin!';
                    echo json_encode($data);
                    exit;
                }
            }
             $user_telp = $this->action->get_single('user', ['notelp' => $notelp]);
            if ($user_telp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                echo json_encode($data);
                exit;
            }

            if ($password != $repassword) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                echo json_encode($data);
                exit;
            } else {
                $post['password'] = hash_my_password($email . $password);
            }
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }
            
            $insert = $this->action->insert('user', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data member berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/member #reload_table',true);
                $data['modal']['id'] = '#kt_modal_member';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_member()
    {
        // VARIABEL
        $arrVar['id_user']          = 'Id user';
        $arrVar['nama']             = 'Nama user';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['email']            = 'Alamat email';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var];
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action->get_single('user', ['id_user' => $id_user]);
        $password = $_POST['password'] ?? '';
        $repassword = $_POST['repassword'] ?? '';
        $nama_foto = $_POST['nama_foto'] ?? '';
        $tujuan = './data/member/';
        if ($result->email != $email) {
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            $user_mail = $this->action->get_single('user', ['email' => $email,'id_user !=' => $id_user]);
            if ($user_mail) {
                $data['status'] = false;
                $data['alert']['message'] = 'Email sudah terdaftar sebagai member!';
                echo json_encode($data);
                exit;
            }else{
                $admin_mail = $this->action->get_single('admin', ['email' => $email]);
                if ($admin_mail) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Email sudah terdaftar sebagai admin!';
                    echo json_encode($data);
                    exit;
                }
            } 
            if (!$password) {
                $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            } 
            if (!$repassword) {
                $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            }   
             
        }
        if (!in_array(false, $arrAccess)) {
            if ($result->notelp != $notelp) {
                $cek_notelp = $this->action->get_single('user', ['notelp' => $notelp,'id_user !=' => $id_user]);
                if ($cek_notelp) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }      
            }

            if ($password) {
                if ($password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($email . $password);
                }
            } 

            if (!empty($_FILES['foto']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/member/')) {
                    mkdir('./data/member');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];
                    if ($nama_foto) {
                        if (file_exists($tujuan.$nama_foto)) {
                            unlink($tujuan.$nama_foto);
                        }
                    }
                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }else{
                 if (!$nama_foto) {
                    if ($result->foto != '' && file_exists($tujuan.$result->foto)) {
                        unlink($tujuan.$result->foto);
                    }
                    $post['foto'] = '';
                }
            }
            
            $update = $this->action->update('user', $post, ['id_user' => $id_user]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data user berhasil di rubah!';
                 $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table', true);
                $data['modal']['id'] = '#kt_modal_member';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_member()
    {
        $id = $_POST['id'];
        $res = $this->action->get_single('user',['id_user' => $id]);
        if ($res) {
            $hapus = $this->action->delete('user',['id_user' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data user berhasil dihapus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/member #reload_table', true);
                if ($res->foto != '' && file_exists('./data/user/'.$res->foto)) {
                    unlink('./data/user/'.$res->foto);
                 }
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data user gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data user tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }
   



    // FUNSGI_KATEGORI

    public function tambah_kategori()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama Kategori';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }
            
            $insert = $this->action->insert('kategori', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data kategori berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/kategori #reload_table',true);
                $data['modal']['id'] = '#kt_modal_kategori';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_kategori()
    {

        // VARIABEL
        $arrVar['id_kategori']      = 'Kategori';
        $arrVar['nama']             = 'Nama Kategori';
        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            $update = $this->action->update('kategori', $post,['id_kategori' => $id_kategori]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data kategori berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/kategori #reload_table',true);
                $data['modal']['id'] = '#kt_modal_kategori';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_kategori()
    {
        $id = $_POST['id'];
        $res = $this->action->get_single('kategori',['id_kategori' => $id]);
        if ($res) {
            $hapus = $this->action->delete('kategori',['id_kategori' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data kategori berhasil dihapus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/kategori #reload_table',true);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data kategori gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data kategori tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }







    // FUNGSI_PRODUK
    public function tambah_produk()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama produk';
        $arrVar['id_kategori']      = 'Kategori';
        $arrVar['verify']           = 'Verifikasi';
        $arrVar['deskripsi']        = 'Deskripsi';
        $arrVar['tutorial']         = 'Tutorial';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $tujuan = './data/produk/';
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/produk/')) {
                    mkdir('./data/produk');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];

                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }else{
                $data['status'] = 500;
                $data['alert']['message'] = 'Foto tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
            $link_website = $_POST['link_website'] ?? '';
            $link_youtube = $_POST['link_youtube'] ?? '';
            if ($link_website != '') {
                $post['link_website'] = $link_website;
            }
            if ($link_youtube != '') {
                $post['link_youtube'] = $link_youtube;
            }
            if ($this->id_user) {
                $post['create_by'] = $this->id_user;
            }
            $insert = $this->action->insert('produk', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data produk berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/produk #reload_table',true);
                $data['modal']['id'] = '#kt_modal_produk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_produk()
    {
        // VARIABEL
        $arrVar['id_produk']             = 'ID produk';
        $arrVar['nama']             = 'Nama produk';
        $arrVar['id_kategori']           = 'Kategori';
        $arrVar['verify']           = 'Verifikasi';
        $arrVar['deskripsi']           = 'Deskripsi';
        $arrVar['tutorial']           = 'Tutorial';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action->get_single('produk', ['id_produk' => $id_produk]);
        $nama_foto = $_POST['nama_foto'] ?? '';
        $tujuan = './data/produk/';
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                if (!file_exists('./data/')) {
                    mkdir('./data');
                }
                if (!file_exists('./data/produk/')) {
                    mkdir('./data/produk');
                }
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = array('png','jpg','jpeg','PNG','JPEG','JPG');
                $config['file'] = $_FILES['foto'];

                $upload = upload_file($config);
                if ($upload['status'] == true) {
                    $post['foto'] = $upload['data']['nama'];

                } else {
                
                    $data['status'] = false;
                    $data['alert']['message'] = $upload['message'];
                    echo json_encode($data);
                    exit;
                }
            }else{
                 if (!$nama_foto) {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Foto tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }
            
            $link_website = $_POST['link_website'] ?? '';
            $link_youtube = $_POST['link_youtube'] ?? '';
            if ($link_website != '') {
                $post['link_website'] = $link_website;
            }
            if ($link_youtube != '') {
                $post['link_youtube'] = $link_youtube;
            }

            $update = $this->action->update('produk', $post, ['id_produk' => $id_produk]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data produk berhasil di rubah!';
                 $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/produk #reload_table',true);
                $data['modal']['id'] = '#kt_modal_produk';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_produk()
    {
        $id = $_POST['id'];
        $res = $this->action->get_single('produk',['id_produk' => $id]);
        if ($res) {
            $hapus = $this->action->delete('produk',['id_produk' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data produk berhasil dihapus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/produk #reload_table',true);
                if ($res->foto != '' && file_exists('./data/produk/'.$res->foto)) {
                    unlink('./data/produk/'.$res->foto);
                }
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data produk gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data produk tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

}