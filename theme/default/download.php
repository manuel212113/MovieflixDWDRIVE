<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?=$title?></title>
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.css">
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/shared/style.css">
      <link rel="shortcut icon" href="<?=getThemeURI()?>/assets/images/favicon.ico" />
   </head>
   <body >
      <div class="__000ab d-none">
         <div class="__000ab-content">
            <div class="top">
               <img src="<?=getThemeURI()?>/assets/images/stop.png" height="80" alt="">
               <h2 class="my-3">Adblock detectado</h2>
               <p class="mb-3 "><b>Detectamos que você está usando um plugin de navegador adblock <br> para desativar o carregamento de publicidade em nosso site.</b> </p>
            </div>
            <div class="bottom">
               <p class="mb-3">
                  A receita obtida com a publicidade nos permite fornecer conteúdo de qualidade <br>
                   que você está tentando acessar neste site. Para visualizar esta página, solicitamos <br>
                   que você desative o adblock nas configurações do plugin
               </p>
               <a href="<?=$_SERVER['REQUEST_URI']?>" class="btn btn-block btn-danger">Desativi o Adblock para este site</a>
            </div>
         </div>
      </div>
      <div class="download-page">
         <div class="py-3 text-center " style="    background: #f9fafb;">
            <a href="#">                <img src="<?=PROOT?>/uploads/images/<?=self::$config['logo']?>" height="50" alt="logo">
            </a>
         </div>
         <div class="container">
            <div class="__000code728x __adBorder mt-5">
               <?=base64_decode($this->data['ads'][0]['code'])?>
            </div>
            <div class="row my-5">
               <div class="col-lg-4">
                  <div class="__000code300x __adBorder mt-2">
                     <?=base64_decode($this->data['ads'][2]['code'])?>
                  </div>
               </div>
               <div class="col-lg-8">
                  <div class="__000main-wrap __000panel mb-3  py-4">
                     <?php if(!$this->hasAlerts()):  ?>
                     <div>
                        <span class="badge badge-dark"><i class="mdi mdi-attachment"></i> &nbsp;<?=$title?></span>
                     </div>
                     <div class="text-center mt-3">
                        <h4 class="__000msg-title">Por favor, espere : <span id="__000timer" class="text-danger"><?=self::$config['countdown']?></span> Secounds </h4>
                        <p class="lead __000msg-describe">Espere, enquanto geramos download direto Link/s!</p>
                     </div>
                     <div class="loader">
                        <div class="loader-inner ball-spin-fade-loader">
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                           <div></div>
                        </div>
                     </div>
                     <div class="btn-set d-none text-center mt-4">
                        <?php  if(self::$config['mdl']): ?>
                        <?php foreach($links as $q => $val ): ?>
                        <a href="<?=$val?>" class="btn btn-sm btn-primary mx-1 dl"><i class="mdi mdi-download"></i> <?=$q?>p</a>
                        <?php endforeach; ?>
                        <?php else:  ?>
                        <a href="<?=end($this->data['links'])?>" class="btn btn-sm btn-primary mx-1 dl"><i class="mdi mdi-download"></i> Download</a>
                        <?php endif; ?>
                     </div>
                     <?php else:
                        $this->displayAlerts()
                        
                        ?>
                     <?php endif;  ?>
                  </div>
                  <div class="__000code728x __adBorder">
                     <?=base64_decode($this->data['ads'][1]['code'])?>
                  </div>
               </div>
            </div>
            <div class="__content mb-5">
               <?=Main::unsanitized(self::$config['downloadPageContent'])?>
            </div>
         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <!-- endbuild -->
      <?php 
         $script = "
         
         sessID = '".$sessID."';
         timeLeft = ".self::$config['countdown'].";
         function countdown() {
         timeLeft--;
         document.getElementById('__000timer').innerHTML = String( timeLeft );
         if (timeLeft > 0) {
           setTimeout(countdown, 1000);
         
         }else{
         
           $('.dl').each(function(i, obj) {
             var dl = $(this).attr('href');
             $(this).attr('href', dl + '/' + sessID);
           });
         
           setTimeout(function() {
                $('.__000msg-title').text('Your Download Link is Ready !');
                $('.__000msg-describe').text('Done, We Generated Direct Download Link/s!');
                $('.loader').addClass('d-none');
                $('.btn-set').removeClass('d-none');
                
          }, 500);
         }
         
         
         }
         
         
         
         
         var adBlockEnabled = false;
         var testAd = document.createElement('div');
         testAd.innerHTML = '&nbsp;';
         testAd.className = 'adsbox';
         document.body.appendChild(testAd);
         window.setTimeout(function() {
           if (testAd.offsetHeight === 0) {
             adBlockEnabled = true;
             testAd.remove();
           $('.download-page').html(' ');
           $('.__000ab').removeClass('d-none');
           console.log('AdBlock Enabled? ', adBlockEnabled)
           }
           else
           {
             setTimeout(countdown, 1000);
         
           }
         
         }, 100);
         
         
         ";
         
         
         
         
         ?>
      <script>
         <?php
            error_reporting(E_ALL);
            $packer = new JSPacker($script, 'Normal', true, false, true);
            $packed_js = $packer->pack();
            echo $packed_js; ?>
         
         
      </script>

<?=base64_decode($popads)?>

   </body>
</html>