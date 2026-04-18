<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title><?= ucfirst(WEB_NAME) ?> <?= (isset($title)) ? '| '.$title : ''; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= assets_url('user/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?= image_check($setting->icon,'setting'); ?>" />


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?= assets_url('user/') ?>css/fontawesome.css">
    <link rel="stylesheet" href="<?= assets_url('user/') ?>css/templatemo-cyborg-gaming.css">
    <link rel="stylesheet" href="<?= assets_url('user/') ?>css/owl.css">
    <link rel="stylesheet" href="<?= assets_url('user/') ?>css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= assets_url('public/') ?>js/alert/sweetalert2.css">
    <!-- TemplateMo 579 Cyborg Gaming https://templatemo.com/tm-579-cyborg-gaming-->
     
    <style>
        .required:after {
          content: "*";
          position: relative;
          font-size: inherit;
          color: var(--bs-danger);
          padding-left: 0.25rem;
          font-weight: 600;
      }
    </style>
  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="<?= base_url('home',true); ?>" class="logo">
                        <img src="<?= image_check($setting->logo,'setting'); ?>" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search End ***** -->
                    <div class="search-input">
                      <form id="search" action="<?= base_url('search', true) ?>" method="GET">
                         <input type="text" placeholder="Pencarian..." id='searchText' name="q" onkeypress="if(event.keyCode==13){this.form.submit()}" />
                         <i class="fa fa-search" onclick="document.getElementById('search').submit()" style="cursor:pointer"></i>
                      </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="<?= base_url('home',true) ?>" class="<?= (in_array(uri_segment(0), ['home']) || uri_segment(0) == NULL) ? 'active' : ''; ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('trending',true) ?>" class="<?= (in_array(uri_segment(0), ['trending'])) ? 'active' : ''; ?>">🔥 Trending</a></li>
                        <li><a href="<?= base_url('about',true) ?>" class="<?= (in_array(uri_segment(0), ['about'])) ? 'active' : ''; ?>">Tentang Kami</a></li>
                        
                        <?php if(session(WEB_NAME.'_id_user')) : ?>
                          <li>
                              <a  href="<?= base_url('logout',true) ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan meninggalkan sistem?')">Keluar</a>
                          </li>
                        <li>
                          <a href="<?= base_url('profil',true) ?>" class="d-flex justify-content-center align-items-center">Profil <div class="img-background-profile ms-2" style="background-image: url('<?= image_check(session(WEB_NAME.'_foto'),'member','user') ?>')"></div>
                          </a>
                        </li>
                        <?php else : ?>
                       <li><a href="<?= base_url('login', true) ?>" class="<?= (in_array(uri_segment(0), ['login'])) ? 'active' : ''; ?>">Login</a></li>
                       <li><a href="<?= base_url('daftar', true) ?>" class="<?= (in_array(uri_segment(0), ['daftar'])) ? 'active' : ''; ?>">Daftar</a></li>
                        <?php endif;?>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <link rel="stylesheet" href="<?= assets_url('user/') ?>css/custom.css">

  <link rel="stylesheet" href="<?= assets_url('user/css/custom.css') ?>">