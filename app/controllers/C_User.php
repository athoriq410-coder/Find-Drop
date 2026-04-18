<?php

class C_User extends User
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
      $where['produk.status'] = 'Y';
      $kategori = $this->action->get_all('kategori',['status' => 'Y']);

      $result = $this->action->get_where_params('produk',$where,'produk.*',[]);
      $arr = [];
      if ($result) {
         foreach ($result as $row) {
            $arr[$row->id_kategori][] = [
               'id_produk'   => $row->id_produk,
               'nama'        => $row->nama,
               'foto'        => image_check($row->foto,'produk'),
               'deskripsi'   => $row->deskripsi,
               'id_kategori' => $row->id_kategori,
               'verify'      => $row->verify,
            ];
         }
      }

      // Query trending untuk dashboard
      $query_trending = "
      SELECT 
         p.*,
         COUNT(DISTINCT up.id_user) AS total_favorit,
         COUNT(DISTINCT k.id_komentar) AS total_komentar,
         (COUNT(DISTINCT up.id_user) * 2 + COUNT(DISTINCT k.id_komentar) * 1) AS skor_trending
      FROM produk p
      LEFT JOIN user_produk up ON p.id_produk = up.id_produk
      LEFT JOIN komentar k ON p.id_produk = k.id_produk
      WHERE p.status = 'Y'
      GROUP BY p.id_produk
      HAVING skor_trending > 0
      ORDER BY skor_trending DESC
      LIMIT 3
      ";
      $this->action->db->query($query_trending);
      $top_trending = $this->action->db->resultSet();
      if ($top_trending) {
         foreach ($top_trending as $row) {
            $row->foto = image_check($row->foto, 'produk');
         }
      }

      $data['kategori'] = $kategori;
      $data['result'] = $arr;
      $data['top_trending'] = $top_trending ?? [];
      $this->display('V_Index',$data);
   }

   public function about()
   {
      $data = [];
      $this->display('V_About',$data);
   }

   public function detail($id = NULL)
   {
      if ($id == NULL) {
         redirect('home');
      }
      $where['produk.status'] = 'Y';
      $where['id_produk'] = $id;
      $result = $this->action->get_where_params('produk',$where,'produk.*',[]);
      $fav = $this->action->get_single('user_produk',['id_user' => $this->id_user,'id_produk' => $id]);

      $par['arrjoin']['user']['statement'] = 'komentar.id_user = user.id_user';
      $par['arrjoin']['user']['type'] = 'LEFT';
      $komentar = $this->action->get_where_params('komentar',['id_produk' => $id],'komentar.*,user.nama AS user,user.foto',$par);
      if ($result) {
         $result = $result[0];
      }
      $data['komentar'] = $komentar;
      $data['result'] = $result;
      $data['fav'] = ($fav) ? true : false;
      $this->display('V_Detail',$data);
   }

   public function profil()
   {
      if (!$this->id_user) {
         redirect('home');
      }
      $result = $this->action->get_single('user',['id_user' => $this->id_user]);
      $params['arrjoin']['produk']['statement'] = 'user_produk.id_produk = produk.id_produk';
      $params['arrjoin']['produk']['type'] = 'LEFT';
      $airdrop = $this->action->get_where_params('user_produk',['id_user' => $this->id_user],'produk.*',$params);
      $data['result'] = $result;
      $data['airdrop'] = $airdrop;

      $this->display('V_Profil',$data);
   }

   public function search()
   {
      $q = isset($_GET['q']) ? urldecode($_GET['q']) : '';
      $data['q'] = $q;
      $data['result'] = [];

      if ($q) {
         $where['produk.status'] = 'Y';
         $params['search'] = $q;
         $params['columnsearch'] = ['produk.nama'];
         $result = $this->action->get_where_params('produk', $where, 'produk.*', $params);
         $data['result'] = $result ?? [];
      }

      $this->display('V_Search', $data);
   }

   public function trending()
   {
      $query = "
         SELECT 
            p.*,
            COUNT(DISTINCT up.id_user) AS total_favorit,
            COUNT(DISTINCT k.id_komentar) AS total_komentar,
            (COUNT(DISTINCT up.id_user) * 2 + COUNT(DISTINCT k.id_komentar) * 1) AS skor_trending
         FROM produk p
         LEFT JOIN user_produk up ON p.id_produk = up.id_produk
         LEFT JOIN komentar k ON p.id_produk = k.id_produk
         WHERE p.status = 'Y'
         GROUP BY p.id_produk
         HAVING skor_trending > 0
         ORDER BY skor_trending DESC
         LIMIT 9
      ";

      $this->action->db->query($query);
      $trending = $this->action->db->resultSet();

      if ($trending) {
         foreach ($trending as $row) {
            $row->foto = image_check($row->foto, 'produk');
         }
      }

      $data['trending'] = $trending ?? [];
      $this->display('V_Trending', $data);
   }

   public function add_komentar()
   {
      $arrVar['komentar']      = 'Komentar';
      $arrVar['id_produk']     = 'id produk';

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

      $post['id_user'] = $this->id_user;

      if (!in_array(false, $arrAccess)) {
         $insert = $this->action->insert('komentar', $post);
         if ($insert) {
               $data['status'] = true;
               $data['alert']['message'] = 'Data komentar berhasil di tambahkan!';
               $data['load'][0]['parent'] = '#base_table';
               $data['load'][0]['reload'] = base_url('user/detail/'.$id_produk.' #reload_table',true);
               $data['input']['textarea'] = true;
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

   public function add_fav($id = NULL)
   {
      if ($id == NULL) {
         redirect('home');
      }
      $in['id_user'] = $this->id_user;
      $in['id_produk'] = $id;
      $insert = $this->action->insert('user_produk',$in);
      redirect('profil');
   }

   public function remove_fav($id = NULL)
   {
      if ($id == NULL) {
         redirect('home');
      }
      $where['id_user'] = $this->id_user;
      $where['id_produk'] = $id;
      $delete = $this->action->delete('user_produk',$where);
      redirect('user/detail/'.$id);
   }

   public function ubah_profil()
   {
      $arrVar['nama']    = 'Nama lengkap';
      $arrVar['email']   = 'Alamat email';

      foreach ($arrVar as $var => $value) {
         $$var = $_POST[$var] ?? '';
         if (!$$var) {
            $data['required'][] = ['req_profil_' . $var, $value . ' tidak boleh kosong !'];
            $arrAccess[] = false;
         } else {
            $post[$var] = trim($$var);
            $arrAccess[] = true;
         }
      }

      $result = $this->action->get_single('user', ['id_user' => $this->id_user]);
      $password     = $_POST['password'] ?? '';
      $newpassword  = $_POST['newpassword'] ?? '';
      $repassword   = $_POST['repassword'] ?? '';
      $nama_foto    = $_POST['nama_foto'] ?? '';
      $notelp       = $_POST['notelp'] ?? '';

      if ($notelp) {
         $post['notelp'] = $notelp;
      }

      if (!in_array(false, $arrAccess)) {
         if (!validasi_email($email)) {
            $data['status'] = false;
            $data['alert']['message'] = 'Email tidak valid!';
            echo json_encode($data);
            exit;
         }

         // Cek email duplikat
         $cek_email = $this->action->get_single('user', ['email' => $email, 'id_user !=' => $this->id_user]);
         if ($cek_email) {
            $data['status'] = false;
            $data['alert']['message'] = 'Email sudah digunakan akun lain!';
            echo json_encode($data);
            exit;
         }

         // Validasi password jika diisi
         if ($password || $newpassword || $repassword) {
            if (hash_my_password($result->email . $password) != $result->password) {
               $data['status'] = false;
               $data['alert']['message'] = 'Kata sandi lama salah!';
               echo json_encode($data);
               exit;
            }
            if ($newpassword != $repassword) {
               $data['status'] = false;
               $data['alert']['message'] = 'Konfirmasi kata sandi tidak sesuai!';
               echo json_encode($data);
               exit;
            }
            $post['password'] = hash_my_password($email . $newpassword);
         }

         // Upload foto jika ada
         if (!empty($_FILES['foto']['tmp_name'])) {
            $tujuan = './data/member/';
            if (!file_exists('./data/')) mkdir('./data');
            if (!file_exists('./data/member/')) mkdir('./data/member');

            $config['upload_path']    = $tujuan;
            $config['allowed_types']  = array('png', 'jpg', 'jpeg', 'PNG', 'JPEG', 'JPG');
            $config['file']           = $_FILES['foto'];

            $upload = upload_file($config);
            if ($upload['status'] == true) {
               $post['foto'] = $upload['data']['nama'];
               // Hapus foto lama
               if ($result->foto && file_exists($tujuan . $result->foto)) {
                  unlink($tujuan . $result->foto);
               }
            } else {
               $data['status'] = false;
               $data['alert']['message'] = $upload['message'];
               echo json_encode($data);
               exit;
            }
         }

         $update = $this->action->update('user', $post, ['id_user' => $this->id_user]);
         if ($update) {
            $_SESSION[WEB_NAME . '_nama']  = $nama;
            $_SESSION[WEB_NAME . '_email'] = $email;
            $data['status'] = true;
            $data['alert']['message'] = 'Profil berhasil diperbarui!';
            $data['redirect'] = base_url('profil', true);
         } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Gagal memperbarui profil, coba lagi!';
         }
      } else {
         $data['status'] = false;
      }
      sleep(1);
      echo json_encode($data);
      exit;
   }

   public function logout()
   {
      unset($_SESSION[WEB_NAME.'_id_user']);
      unset($_SESSION[WEB_NAME.'_nama']);
      unset($_SESSION[WEB_NAME.'_email']);
      unset($_SESSION[WEB_NAME.'id_role']);
      unset($_SESSION[WEB_NAME.'_notelp']);
      unset($_SESSION[WEB_NAME.'_role']);

      redirect('auth');
   }
}