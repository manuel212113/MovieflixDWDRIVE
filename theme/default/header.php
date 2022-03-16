<?php defined("APP") or die() ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Gdrive | Dashboard</title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/css/vendor.addons.css">
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/summernote/dist/summernote-lite.css">
      <!-- endinject -->
      <!-- vendor css for this page -->
      <!-- End vendor css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/shared/style.css">
      <?php $theme = self::$config['dark_theme'] ? 'dark' : 'light'; ?>
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/<?=$theme?>/style.css?v2.1">
      <!-- endinject -->
      <link rel="shortcut icon" href="<?=PROOT?>/uploads/images/<?=self::$config['favicon']?>" />
   </head>
   <body class="header-fixed">
      <nav class="t-header">
         <div class="t-header-brand-wrapper">
            <a href="/">
            <img class="logo" src="<?=PROOT?>/uploads/images/<?=self::$config['logo']?>" alt="Logo">
            <img class="logo-mini" src="<?=PROOT?>/uploads/images/<?=self::$config['logo']?>" alt="Logo">
            </a>
            <button class="t-header-toggler t-header-desk-toggler d-none d-lg-block">
               <svg class="logo" viewBox="0 0 200 200">
                  <path class="top" d="
                     M 40, 80
                     C 40, 80 120, 80 140, 80
                     C180, 80 180, 20  90, 80
                     C 60,100  30,120  30,120
                     "></path>
                  <path class="middle" d="
                     M 40,100
                     L140,100
                     "></path>
                  <path class="bottom" d="
                     M 40,120
                     C 40,120 120,120 140,120
                     C180,120 180,180  90,120
                     C 60,100  30, 80  30, 80
                     "></path>
               </svg>
            </button>
         </div>
         <div class="t-header-content-wrapper">
            <div class="t-header-content">
               <button class="t-header-toggler t-header-mobile-toggler d-block d-lg-none">
               <i class="mdi mdi-menu"></i>
               </button>
               <form action="#" class="t-header-search-box">
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <div class="input-group-text">
                           <i class="mdi mdi-magnify"></i>
                        </div>
                     </div>
                     <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Search" autocomplete="off">
                  </div>
               </form>
               <ul class="nav ml-auto">
                  <a href="/" class="text-dark" target="_blank"><i class="mdi mdi-internet-explorer mdi-2x "></i></a>
               </ul>
            </div>
         </div>
      </nav>
      <div class="page-body">
      <?php include(TEMPLATE.'/sidebar.php'); ?>
      <div class="page-content-wrapper">