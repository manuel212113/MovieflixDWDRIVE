<?php defined("APP") or die(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
   <meta charset="utf-8">
   <title><?= $title ?></title>
   <style>
      body {
         padding: 0;
         margin: 0;
      }

      #jwplayer {
         position: absolute;
         top: 0;
         left: 0;
         bottom: 0;
         right: 0;
         width: auto !important;
         height: auto !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-slider-time {
         padding: 0 15px !important;
         height: 14px !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-button-container {
         padding: 0 !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-slider-time .jw-slider-container {
         height: 8px !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-inline:not(.jw-text-live) .jw-svg-icon,
      .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-volume .jw-svg-icon {
         height: 25px !important;
         width: 25px !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-inline:not(.jw-text-live),
      .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-icon-volume {
         height: 50px !important;
         width: 50px !important;
      }

      .jw-breakpoint-7 .jw-controlbar .jw-button-container .jw-text {
         font-size: 0.75rem !important;
      }
   </style>
   <meta name="author" content="CodySeller" />
   <script type="text/javascript" src="https://cdn.jwplayer.com/libraries/aVr2lJgW.js"></script>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <?php if ($gp) : ?>
      <meta name="referrer" content="never" />
      <meta name="referrer" content="no-referrer" />
      <link rel='dns-prefetch' href='//lh3.googleusercontent.com' />
   <?php endif; ?>
   <link rel="stylesheet" href="<?= getThemeURI() ?>/assets/css/shared/plyr.css">
</head>

<body>



   <div id="loader-wrapper">
      <div id="loader"></div>
   </div>
   <!-- <button style="z-index: 999999;position: fixed;"> click me</button> -->
   <div id="jwplayer"></div>
   <?php


   $script = 'const playerInstance = jwplayer("jwplayer").setup({
           playlist: [{
               title: "' . $title . '",
               sources: ' . $sources . ',
               "image": "' . $poster . '",
               "tracks": ' . $subtitles . '
           }],
           
         "logo": {
            "file": "' . $logo . '",
            "link": "#",
            "hide": "false",
            "position": "top-right"
         },
         "advertising": {
            "client": "vast",
            "adscheduleid": "Az87bY12",
            "schedule": [' . $ads . ']
          }
         });
         
         
         
         ';


   if (self::$config['isDownload']) {
      $script .= "const buttonId = 'download-video-button';
            const iconPath = '" . getThemeURI() . "/assets/images/icons/download.svg';
            const tooltipText = 'Download Video';
            playerInstance.addButton(iconPath, tooltipText, buttonClickAction, buttonId);
            function buttonClickAction() {
            console.log('downloaded !');
            const anchor = document.createElement('a');
            anchor.setAttribute('href', '" . $downloadLink . "');
            anchor.setAttribute('target', '_parent');
            anchor.style.display = 'none';
            document.body.appendChild(anchor);
            anchor.click();
            document.body.removeChild(anchor);
            }
            
            ";
   }




   ?>
   <script>
      <?php
      error_reporting(E_ALL);
      $packer = new JSPacker($script, 'Normal', true, false, true);
      $packed_js = $packer->pack();
      echo $packed_js; ?>
   </script>
   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   <script></script>
   <script>
      $(document).ready(function() {

         setTimeout(function() {
            $("#loader").delay(1000).fadeOut("slow");
            $("#loader-wrapper").delay(1500).fadeOut("slow");


         }, 2000);


         var adBlockEnabled = false;
         var testAd = document.createElement('div');
         testAd.innerHTML = '&nbsp;';
         testAd.className = 'adsbox';
         document.body.appendChild(testAd);
         if (testAd.offsetHeight === 0) {
            adBlockEnabled = true;
            testAd.remove();
            var __000ab = document.getElementById('__000ab');
            var jwplayer1 = document.getElementById('jwplayer');
            __000ab.classList.remove('d-none');
            jwplayer1.remove();

            console.log('AdBlock Enabled? ', adBlockEnabled)
         }




      });
   </script>
   <?= base64_decode($popads) ?>
</body>

</html>