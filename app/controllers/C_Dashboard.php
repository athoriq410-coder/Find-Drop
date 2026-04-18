<?php

class C_Dashboard extends Admin
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
      // SET TITLE
      $data['title'] = 'Dashboard';
      // GET DATA
      $now = strtotime(date('Y-m-d'));
      $start = date('Y-m-d', strtotime('-6 days', $now));
      $cnt_start = date('d', strtotime($start));
      $cnt_end = date('d', $now);

      $date = [];
      $value = [];
      for ($i = 0; $i <= 6; $i++) {
      $date[] = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($start)));
      }
      $field = $date;

      $params['groupby'] = 'DATE(create_date)';
      $params['arrorderby']['kolom'] = 'create_date';
      $params['arrorderby']['order'] = 'ASC';

      $where['DATE(create_date) >='] = date('Y-m-d',strtotime($date[0]));
      $where['DATE(create_date) <='] = date('Y-m-d',strtotime($date[(count($date) - 1)]));
      $result = $this->action->get_where_params('user',$where,'DATE(create_date) AS tanggal, COUNT(id_user) AS jumlah',$params);

      $arr1 = [];
      $maxval = 0;
      if ($result) {
         foreach ($result as $row) {
            $arr1[date('dmY',strtotime($row->tanggal))] = $row->jumlah;
            $maxval += $row->jumlah;
         }
      }
      $grvalue = [];
      for ($i = $cnt_start; $i <= $cnt_end; $i++) {
         if(isset($arr1[date('dmY',strtotime($i.'-'.date('m-Y')))])) {
            $valval = ($arr1[date('dmY',strtotime($i.'-'.date('m-Y')))] / $maxval * 100);
         }else{
            $valval = 0;
         }

         $grvalue[] = $valval;
      }

      // echo "<pre>";
      // var_dump($field);
      // echo "</br>";
      // var_dump($grvalue);
      // die;

      // LOAD JS
      $data['js'][] = '<script>var page = "dashboard";var maxval = '.$maxval.';var field = '.json_encode($field).';var grvalue=' . json_encode($grvalue) . ';</script>';
      $data['js'][] = '<script src="' . assets_url() . 'admin/js/modul/dashboard/dashboard.js"></script>';
      // SET VIEW
      $this->display('Dashboard/V_Dashboard',$data);
   }

   public function profil()
   {
      
      // SETTING TITLE
      $data['title'] = 'Profil';

      // GET DATA
      if ($this->id_role == 1) {
         $result = $this->action->get_single('admin',['id_admin' => $this->id_user,'status' => 'Y']);
      }
      

      // CETAK DATA
      $data['result'] = $result;
      
      // SET VIEW
      $this->display('Dashboard/V_Profil',$data);
   }

   public function ubah_profil()
   {
      // VARIABEL
      $arrVar['nama']             = 'Nama member';
      if ($this->id_role == 1) {
         $arrVar['notelp']           = 'Nomor member';
      }
      
      $arrVar['email']           = 'Alamat email';

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
      $id_user = $this->id_user;
      if ($this->id_role == 1) {
         $result = $this->action->get_single('admin',['id_admin' => $this->id_user,'status' => 'Y']);
      }
      $password = $_POST['password'] ?? '';
      $newpassword = $_POST['newpassword'] ?? '';
      $repassword = $_POST['repassword'] ?? '';
      $nama_foto = $_POST['nama_foto'] ?? '';
        

      if ($result->email != $email) { 
         if (!$password) {
            $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena email berubah'];
            $arrAccess[] = false;
         } 
         if (!$newpassword) {
            $data['required'][] = ['req_newpassword', 'Kata sandi baru tidak boleh kosong ! Karena email berubah'];
            $arrAccess[] = false;
         } 
         if (!$repassword) {
            $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena email berubah'];
            $arrAccess[] = false;
         }   
      }
      if (!in_array(false, $arrAccess)) {
         if (!validasi_email($email)) {
            $data['status'] = 700;
            $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
            echo json_encode($data);
            exit;
         }
         $admin_email = $this->action->get_single('admin', ['email' => $email,'id_admin !=' => $id_user]);
         if ($admin_email) {
            $data['status'] = false;
            $data['alert']['message'] = 'Email sudah terdaftar!';
            echo json_encode($data);
            exit;
         }else{
            $user_email = $this->action->get_single('user', ['email' => $email]);
            if ($user_email) {
               $data['status'] = false;
               $data['alert']['message'] = 'Email sudah terdaftar sebagai member!';
               echo json_encode($data);
               exit;
            }

         }
         if ($password) {
            if (hash_my_password($result->email.$password) == $result->password) {
               if ($newpassword != $repassword) {
                  $data['status'] = false;
                  $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                  echo json_encode($data);
                  exit;
               } else {
                  $post['password'] = hash_my_password($email . $newpassword);
               }
            }else{
               $data['status'] = false;
               $data['alert']['message'] = 'Password yang anda masukan salah!';
               echo json_encode($data);
               exit;
            }
         }
         if (!empty($_FILES['foto']['tmp_name'])) {
            if ($this->id_role == 1) {
               $tujuan = './data/admin/';
               if (!file_exists('./data/')) {
                  mkdir('./data');
               }
               if (!file_exists('./data/admin/')) {
                  mkdir('./data/admin');
               }
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
         if ($this->id_role == 1) {
            if ($result->notelp != $notelp) {
               $cek_notelp = $this->action->get_single('admin', ['notelp' => $notelp,'id_admin != ' => $this->id_user]);
               if ($cek_notelp) {
                  $data['status'] = false;
                  $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                  echo json_encode($data);
                  exit;
               }
            }
         }
         
         if ($this->id_role == 1) {
            $update = $this->action->update('admin', $post, ['id_admin' => $this->id_user]);
         }

         
         if ($update) {
            $_SESSION[WEB_NAME.'_nama'] = $nama;
            $_SESSION[WEB_NAME.'_notelp'] = $notelp;
            $_SESSION[WEB_NAME.'_email'] = $email;

            $data['status'] = true;
            $data['alert']['message'] = 'Data profil berhasil di rubah!';
            $data['load'][0]['parent'] = '#kt_content';
            $data['load'][0]['reload'] = base_url('profile #form_ubah_profil',true);
            $data['load'][1]['parent'] = '#kt_aside_footer';
            $data['load'][1]['reload'] = base_url('profile #reload_aside_footer',true);
         } else {
            $data['status'] = false;
             $data['alert']['message'] = 'Data profil gagal di rubah!';
         }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
   }


   public function transaksi()
   {
      // VARIABEL
      $arrVar['id_buku']                     = 'Buku pinjaman';
      $arrVar['id_user']                     = 'Nama peminjam';
      $arrVar['end_date']            = 'Batas peminjaman';
      $arrVar['stock']                       = 'Stock';

      // INFORMASI UMUM
      foreach ($arrVar as $var => $value) {
         $$var = $_POST[$var] ?? '';
         if (!$$var) {
            $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
            $arrAccess[] = false;
         } else {
            if (!in_array($var,['stock'])) {
               $post[$var] = trim($$var);
               
            }
            $arrAccess[] = true;
         }
      }
      $peminjam = $_POST['peminjam'] ?? 0;
      $post['create_by'] = $this->id_user;
      $post['kode'] = 'PJM'.$id_user.date('YmdHis');

      if (!in_array(false, $arrAccess)) {
         if ($stock <= $peminjam) {
            $data['status'] = false;
            $data['alert']['message'] = 'Tidak ada stok tersedia!';
            echo json_encode($data);
            exit;
         }
          $params['arrjoin']['buku']['statement'] = 'peminjaman.id_buku = buku.id_buku';
         $params['arrjoin']['buku']['type'] = 'LEFT';
         $params['arrjoin']['user']['statement'] = 'peminjaman.id_user = user.id_user';
         $params['arrjoin']['user']['type'] = 'LEFT';
         $cek_user = $this->action->get_where_params('peminjaman',['peminjaman.id_user' => $id_user,'peminjaman.back_date' => NULL,'DATE(end_date) < ' => date('Y-m-d H:i:s')],'buku.*,user.nama AS user',$params);
         if ($cek_user) {
            $msg = '<b>'.$cek_user[0]['user'].'</b> dilarang meminjam buku! Karena <span class="text-danger">terlambat</span> mengembalikan buku <br>';
            $msg .= '<table class="table table-bordered mt-3">';
            $msg .= '<tbody>';
            foreach ($cek_user as $row) {
               $msg .= '<tr>';
               $msg .= '<td><b>'.$row['judul'].'</b></td>';
               $msg .= '</tr>';
            }
            $msg .= '</tbody>';
            $msg .= '</table>';
            
             $data['status'] = false;
            $data['alert']['message'] = $msg;
            echo json_encode($data);
            exit;
         }
         $insert = $this->action->insert('peminjaman', $post);
         if ($insert) {
            $data['status'] = true;
            $data['alert']['message'] = 'Data peminjaman berhasil di tambahkan!';
            $data['reload'] = true;
         } else {
            $data['status'] = false;
             $data['alert']['message'] = 'Data peminjaman gagal di tambahkan!';
         }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
   }

   public function restor()
   {
      // VARIABEL
      $arrVar['id_peminjaman']   = 'Data pinjaman';

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
      $post['return_by'] = $this->id_user;

      if (!in_array(false, $arrAccess)) {
         $cek = $this->action->get_single('peminjaman',['id_peminjaman' => $id_peminjaman]);
         if (!$cek) {
            $data['status'] = false;
            $data['alert']['message'] = 'Data peminjaman tidak ditemukan!';
            echo json_encode($data);
            exit;
         }
         $post['back_date'] = date('Y-m-d H:i:s');
         $update = $this->action->update('peminjaman', $post,['id_peminjaman' => $id_peminjaman]);
         if ($update) {
            $msg = '';
            if (strtotime($cek['end_date']) < strtotime(date('Y-m-d H:i:s'))) {
               $msg .= ' Dengan status <span class="text-danger"><b>terlambat</b></span>';
            }
            $data['status'] = true;
            $data['alert']['message'] = 'Buku berhasil dikembalikan!'.$msg;
            $data['reload'] = true;
         } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Buku gagal dikembalikan';
         }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
   }
}

