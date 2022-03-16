<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Gdrive | Login</title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.css" />
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/css/vendor.addons.css" />
      <!-- endinject -->
      <!-- vendor css for this page -->
      <!-- End vendor css for this page -->
      <!-- inject:css -->
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/shared/style.css" />
      <!-- endinject -->
      <!-- Layout style -->
      <?php $theme = self::$config['dark_theme'] ? 'dark' : 'light'; ?>
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/<?=$theme?>/style.css">      
      <!-- Layout style -->
      <link rel="shortcut icon" href="<?=getThemeURI()?>/assets/images/<?=self::$config['favicon']?>" />
   </head>
   <body>
      <div class="authentication-theme auth-style_1">
         <div class="row">
            <div class="col-12 logo-section">
               <a href="#" class="logo">
               <img src="<?=PROOT?>/uploads/images/<?=self::$config['logo']?>" height="30" alt="logo" />
               </a>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-5 col-md-7 col-sm-9 col-11 mx-auto">
               <div class="grid">
                  <div class="grid-body">
                     <div class="row">
                        <div class="col-lg-7 col-md-8 col-sm-9 col-12 mx-auto form-wrapper">
                           <?php $this->displayAlerts(); ?>
                           <form action="<?=$_SERVER['REQUEST_URI']?>" method="post" >
                              <div class="form-group ">
                                 <input type="text" class="form-control" name="username" placeholder="Username" />
                              </div>
                              <div class="form-group">
                                 <input type="password" class="form-control"  name="password" placeholder="Password" />
                              </div>
                              <button type="submit" class="btn btn-primary btn-block"> Login </button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="auth_footer">
            <p class="text-muted text-center">Gerador de player @ 2021 <a href="https://mercadophp.com/" target="_blank">MERCADOPHP</a></p>
         </div>
      </div>
   </body>
</html>