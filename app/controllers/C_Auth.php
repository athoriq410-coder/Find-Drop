<?php

class C_Auth extends Controller
{
   public function __construct()
   {
      $this->action = $this->model('M_action');
   }

   public function index()
   {
      $this->show_login();
   }

   // ─── Halaman Login ───────────────────────────────────────────────
   public function show_login()
   {
      // Kalau sudah login, langsung redirect
      if (session(WEB_NAME . '_id_user')) {
         $role = session(WEB_NAME . '_id_role');
         if ($role == 1) {
            redirect('dashboard');
         } else {
            redirect('home');
         }
      }
      $setting = $this->action->get_single('setting', ['id_setting' => 1]);
      $data['setting']  = $setting;
      $data['title']    = 'Login';
      $themes = 'user';
      $page['up'][]   = 'header';
      $page['down'][] = 'footer';
      $this->view('Auth/V_Login', $data, $themes, $page);
   }

   // ─── Halaman Login Admin ─────────────────────────────────────
   public function show_login_admin()
   {
      if (session(WEB_NAME . '_id_user')) {
      $role = session(WEB_NAME . '_id_role');
      if ($role == 1) {
         redirect('dashboard');
      } else {
         redirect('home');
      }
   }
      $setting = $this->action->get_single('setting', ['id_setting' => 1]);
      $data['setting'] = $setting;
      $data['title']   = 'Login Admin';
      $themes = 'default';
      $this->view('Auth/V_Login_Admin', $data, $themes);

   }

   // ─── Proses Login Admin ──────────────────────────────────────
public function login_admin()
{
   $email    = $_POST['email']    ?? '';
   $password = $_POST['password'] ?? '';

   if (!$email || !$password) {
      $data['status'] = false;
      $data['alert']['message'] = 'Email dan password tidak boleh kosong!';
      echo json_encode($data);
      exit;
   }

   $cek_admin = $this->action->get_single('admin', ['email' => $email]);
   if (!$cek_admin) {
      $data['status'] = false;
      $data['alert']['message'] = 'Akun admin tidak ditemukan!';
      echo json_encode($data);
      exit;
   }

   if ($cek_admin->password != hash_my_password($email . $password)) {
      $data['status'] = false;
      $data['alert']['message'] = 'Password salah!';
      echo json_encode($data);
      exit;
   }

   $_SESSION[WEB_NAME.'_id_user'] = $cek_admin->id_admin;
   $_SESSION[WEB_NAME.'_nama']    = $cek_admin->nama;
   $_SESSION[WEB_NAME.'_email']   = $cek_admin->email;
   $_SESSION[WEB_NAME.'_id_role'] = 1;
   $_SESSION[WEB_NAME.'_notelp']  = $cek_admin->notelp;
   $_SESSION[WEB_NAME.'_role']    = get_role(1);
   $_SESSION[WEB_NAME.'_foto']    = $cek_admin->foto;

   $data['status'] = 200;
   $data['alert']['message'] = 'Selamat datang Admin ' . $cek_admin->nama;
   $data['redirect'] = base_url('dashboard', true);

   echo json_encode($data);
   exit;
}

   // ─── Halaman Daftar ──────────────────────────────────────────────
   public function show_daftar()
   {
      // Kalau sudah login, langsung redirect
      if (session(WEB_NAME . '_id_user')) {
         redirect('home');
      }
      $setting = $this->action->get_single('setting', ['id_setting' => 1]);
      $data['setting']  = $setting;
      $data['title']    = 'Daftar';
      $themes = 'user';
      $page['up'][]   = 'header';
      $page['down'][] = 'footer';
      $this->view('Auth/V_Daftar', $data, $themes, $page);
   }

   // ─── Proses Registrasi ───────────────────────────────────────────
   public function register()
   {
      $arrVar['nama']       = 'Nama lengkap';
      $arrVar['email']      = 'Alamat email';
      $arrVar['notelp']     = 'Nomor handphone';
      $arrVar['password']   = 'Kata sandi';
      $arrVar['konfirmasi'] = 'Konfirmasi kata sandi';

      foreach ($arrVar as $var => $value) {
         $$var = $_POST[$var] ?? '';
         if (!$$var) {
            $data['required'][] = ['req_daftar_' . $var, $value . ' tidak boleh kosong !'];
            $arrAccess[] = false;
         } else {
            $arrAccess[] = true;
         }
      }

      if (!in_array(false, $arrAccess)) {
         // Validasi email
         if (!validasi_email($email)) {
            $data['status']          = 700;
            $data['alert']['message'] = 'Format email tidak valid!';
            sleep(1);
            echo json_encode($data);
            exit;
         }

         // Cek password cocok
         if ($password !== $konfirmasi) {
            $data['status']          = 700;
            $data['alert']['message'] = 'Kata sandi dan konfirmasi tidak cocok!';
            sleep(1);
            echo json_encode($data);
            exit;
         }

         // Cek email sudah terdaftar
         $cek = $this->action->get_single('user', ['email' => $email]);
         if ($cek) {
            $data['status']          = 700;
            $data['alert']['message'] = 'Email sudah terdaftar! Silahkan gunakan email lain.';
            sleep(1);
            echo json_encode($data);
            exit;
         }

         // Simpan user baru
        $in['nama']     = trim($nama);
        $in['email']    = trim($email);
        $in['notelp']   = trim($notelp);
        $in['password'] = hash_my_password($email . $password);
        $in['status']   = 'Y';

         $insert = $this->action->insert('user', $in);
         if ($insert) {
            $data['status']           = 200;
            $data['alert']['message'] = 'Akun berhasil dibuat! Silahkan login.';
            $data['redirect']         = base_url('login', true);
         } else {
            $data['status']           = false;
            $data['alert']['message'] = 'Gagal membuat akun, silahkan coba lagi.';
         }
      } else {
         $data['status'] = false;
      }

      sleep(1);
      echo json_encode($data);
      exit;
   }

    public function login()
    {
        // VARIABEL
        $arrVar['email']           = 'Alamat email';
        $arrVar['password']         = 'Kata sandi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $_POST[$var] ?? '';
            if (!$$var) {
                $data['required'][] = ['req_login_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                sleep(1.5);
                echo json_encode($data);
                exit;
            }
            $cek_admin = $this->action->get_single('admin',['email' => $email]);
            if ($cek_admin) {
                $role = 1;
                $result = $cek_admin;
                $id = $result->id_admin;
            }else{
                $cek_user = $this->action->get_single('user', ['email' => $email, 'status' => 'Y']);
                if ($cek_user) {
                    $role = 2;
                    $result = $cek_user;
                    $id = $result->id_user;
                }else{
                    $data['status'] = false;
                    $data['alert']['message'] = 'Akun tidak terdaftar!';
                    sleep(1.5);
                    echo json_encode($data);
                    exit;
                }
            }

            if ($result->password != hash_my_password($email.$password)) {
                $data['status'] = false;
                $data['alert']['message'] = 'Kata sandi salah! Silahkan coba lagi';
                sleep(1.5);
                echo json_encode($data);
                exit;
            }
            $_SESSION[WEB_NAME.'_id_user'] = $id;
            $_SESSION[WEB_NAME.'_nama'] = $result->nama;
            $_SESSION[WEB_NAME.'_email'] = $result->email;
            $_SESSION[WEB_NAME.'_id_role'] = $role;
            $_SESSION[WEB_NAME.'_notelp'] = $result->notelp;
            $_SESSION[WEB_NAME.'_role'] = get_role($role);
            $_SESSION[WEB_NAME.'_foto'] = $result->foto;

            $data['status'] = 200;
            $data['alert']['message'] = 'Berhasil masuk! Selamat datang ' . get_role($role) . ' ' . $result->nama;
            if ($role == 1) {
                $data['redirect'] = base_url('dashboard',true);
            }else{
                $data['redirect'] = base_url('home',true);
            }
            
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
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
        unset($_SESSION[WEB_NAME.'_foto']);

        redirect('home');
    }
}