<?php

class C_Pengaturan extends Admin
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
      $data['title'] = 'Pengaturan';
      // GET DATA
      
      $setting = $this->action->get_single('setting',['id_setting' => 1]);

      $data['result'] = $setting;
      // SET VIEW
      $this->display('Setting/V_Index',$data);
   }








    // FUNGSI SETTING
    public function setup()
    {
        $post = [];
        $tujuan = './data/setting/';
        $nama_logo = $_POST['nama_logo'] ?? '';
        if (!empty($_FILES['logo']['tmp_name'])) {
            if (!file_exists('./data/')) {
                mkdir('./data/');
            }
            if (!file_exists('./data/setting/')) {
                mkdir('./data/setting/');
            }
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = array('png');
            $config['file'] = $_FILES['logo'];

            $upload = upload_file($config);
            if ($upload['status'] == true) {
                $post['logo'] = $upload['data']['nama'];
                if (file_exists($tujuan . $nama_logo)) {
                    unlink($tujuan . $nama_logo);
                }
                

            } else {
               
                $data['status'] = false;
                $data['alert']['message'] = $upload['message'];
                echo json_encode($data);
                exit;
            }
        }else{
            if ($nama_logo == '') {
                $data['status'] = false;
                $data['alert']['message'] = 'Logo tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
        }

        $nama_icon = $_POST['nama_icon'] ?? '';
        if (!empty($_FILES['icon']['tmp_name'])) {
            if (!file_exists('./data/')) {
                mkdir('./data');
            }
            if (!file_exists('./data/setting/')) {
                mkdir('./data/setting');
            }
            $config2['upload_path'] = $tujuan;
            $config2['allowed_types'] = array('png','ico');
            $config2['file'] = $_FILES['icon'];

            $upload2 = upload_file($config2);
            if ($upload2['status'] == true) {
                $post['icon'] = $upload2['data']['nama'];
                if (file_exists($tujuan . $nama_icon)) {
                    unlink($tujuan . $nama_icon);
                }

            } else {
               
                $data['status'] = false;
                $data['alert']['message'] = $upload2['message'];
                echo json_encode($data);
                exit;
            }
        }else{
            if ($nama_icon == '') {
                $data['status'] = false;
                $data['alert']['message'] = 'Icon tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
        }
        
        if (!empty($_FILES['logo']['tmp_name']) || !empty($_FILES['icon']['tmp_name'])) {
            $update = $this->action->update('setting', $post, ['id_setting' => 1]);
        }else{
            $update = NULL;
        }
        
        if ($update) {
            $data['status'] = true;
            $data['alert']['message'] = 'Data setting berhasil di rubah!';
            $data['load'][0]['parent'] = '#reload_sidebar';
            $data['load'][0]['reload'] = base_url('pengaturan',true).' #kt_app_sidebar';
        } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Tidak ada data yang di rubah!';
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
        
    }


    public function switch($db = 'user')
    {
        $id = $_POST['id'];
        $action = $_POST['action'];
        $reason = $_POST['reason'] ?? '';
         $res = $this->action->get_single($db,['id_'.$db => $id]);
        if (!$res) {
             $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data '.$db.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'N') {
            $set['reason'] = $reason;
        } else {
            $set['reason'] = '';
        }

        $update = $this->action->update($db, $set, ['id_'.$db => $id]);
        $alasan = '';
        if ($update) {
            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'Y') {
                $data['alert']['message'] = 'Akses '.$db.' telah di aktifkan!';
            } else {
                if ($reason != '') {
                    $alasan .= ' Dengan alasan '.$reason;
                }
                $data['alert']['message'] = 'Akses '.$db.' telah di matikan!'.$alasan;
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = $db.' gagal di update! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function drag($action = 'deleted',$db = 'user',$path = 'master|user')
    {
        $path = base64url_decode($path);
        $id = $_POST['id_batch'];
        $cek = $this->action->get_all($db,['id_'.$db => $id]);
        if (!$cek) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data '.$db.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data '.$db.' belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_'.$db] = $value;
                $set[$num]['status'] = 'N';
                $set[$num]['block_by'] = $this->id_user;
                $set[$num]['block_date'] = date('Y-m-d H:i:s');
            }
            $block = $this->action->update_batch($db, $set, 'id_'.$db);
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil mematikan akses pada sejumlah '.$db;
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url($path.' #reload_table',true);
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal mematikan akses pada sejumlah '.$db;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_'.$db] = $value;
                $set[$num]['status'] = 'Y';
                $set[$num]['block_by'] = NULL;
                $set[$num]['block_date'] = NULL;
            }
            $block = $this->action->update_batch($db, $set, 'id_'.$db);
            if ($block) {

                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka akses sejumlah '.$db;
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url($path.' #reload_table',true);
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka akses sejumlah '.$db;
            }
        } elseif ($action == 'deleted') {
            $ed = [];
            $no = 0;
            foreach ($id as $value) {
                $num = $no++;
                $ed[] = $value;
            }
            
            // var_dump($id);die;
            $delete = $this->action->delete($db,['id_'.$db => $ed]);
            if ($delete) {

                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah '.$db;
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url($path.' #reload_table',true);
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah '.$db;
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }

    public function get_single($db = 'user')
    {
        $id = $_POST['id'];

        $result = $this->action->get_single($db, ['id_'.$db => $id]);
        echo json_encode($result);
        exit;
    }
}

