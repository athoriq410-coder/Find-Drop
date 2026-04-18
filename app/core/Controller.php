<?php

class Controller
{
   public function view($view, $data = [],$code_template = 'default',$page_template = [])
   {
      extract($data);
      unset($data);
      if ($code_template != false) {
         if (isset($page_template['up']) && count($page_template['up']) > 0) {
            foreach ($page_template['up'] as $page) {
               if (file_exists('./app/themes/'.$code_template.'/'.$page.'.php')) {
                  require_once './app/themes/'.$code_template.'/'.$page.'.php';
               }
            }
         }
         
      }
      if (file_exists('./app/views/'.$view.'.php')) {
         require_once "./app/views/".$view.".php";
      }else{
         require_once "./app/config/error/notfound.php";
      }

      if ($code_template != false) {
         if (isset($page_template['down']) && count($page_template['down']) > 0) {
            foreach ($page_template['down'] as $page) {
               if (file_exists('./app/themes/'.$code_template.'/'.$page.'.php')) {
                  require_once './app/themes/'.$code_template.'/'.$page.'.php';
               }
            }
         }
         
      }


      
   }

   public function model($model)
   {
      require_once "./app/models/$model.php";
      return new $model;
   }
}

class User extends Controller
{
   public function display($view, $data = [])
   {
      $id_user = session(WEB_NAME.'_id_user');
      $id_role = session(WEB_NAME.'_id_role');
      if ($id_user) {
         if (in_array($id_role,[1])) {
            redirect('dashboard');
         }
      }
       $setting = $this->action->get_single('setting',['id_setting' => 1]);
      $data['setting'] = $setting;
      $themes = 'user';
      $page['up'][] = 'header';
      $page['down'][] = 'footer';
      $this->view('User/'.$view, $data,$themes, $page);
   }
    
}

class Admin extends Controller
{

   
   public function display($view, $data = [])
   {
      $id_user = session(WEB_NAME.'_id_user');
      $id_role = session(WEB_NAME.'_id_role');
      if (!$id_user) {
         redirect('home');
      }else{
         if (in_array($id_role,[2])) {
            redirect('home');
         }
      }
      $setting = $this->action->get_single('setting',['id_setting' => 1]);
      $data['setting'] = $setting;

      $themes = 'admin';
      $page['up'][] = 'header';
      $page['up'][] = 'sidemenu';
      $page['down'][] = 'footer';
      $this->view('Admin/'.$view, $data,$themes, $page);
   }
    
}