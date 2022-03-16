<?php defined("APP") or die() ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <title><?=$title?></title>
      <meta
         name="description"
         property="og:description"
         content="A simple HTML5 media player with custom controls and WebVTT captions."
         />
      <meta name="author" content="CodySeller" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/vendors/plyr/plyr.css">
      <!-- Preload -->
      <link
         rel="preload"
         as="font"
         crossorigin
         type="font/woff2"
         href="https://cdn.plyr.io/static/fonts/gordita-medium.woff2"
         />
      <link
         rel="preload"
         as="font"
         crossorigin
         type="font/woff2"
         href="https://cdn.plyr.io/static/fonts/gordita-bold.woff2"
         />
      <link rel="stylesheet" href="<?=getThemeURI()?>/assets/css/shared/plyr.css">
      <style>
         .plyr--video {
         position: absolute;
         left: 0;
         top: 0;
         right: 0;
         bottom: 0;
         margin:0;
         }
      </style>
      <?php if($gp): ?>
      <meta name="referrer" content="never" />
      <meta name="referrer" content="no-referrer" />
      <link rel='dns-prefetch' href='//lh3.googleusercontent.com' />
      <?php endif; ?>
   </head>
   <body>
      <div id="loader-wrapper">
         <div id="loader"></div>
      </div>
      <video
         controls
         playsinline
         data-poster="<?=$poster?>"
         id="player"
         >
      </video>
      <script src="<?=getThemeURI()?>/assets/vendors/plyr/plyr.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script>
         const controls = [
             'play-large', // The large play button in the center
             'restart', // Restart playback
             'rewind', // Rewind by the seek time (default 10 seconds)
             'play', // Play/pause playback
             'fast-forward', // Fast forward by the seek time (default 10 seconds)
             'progress', // The progress bar and scrubber for playback and buffering
             'current-time', // The current time of playback
             'duration', // The full duration of the media
             'mute', // Toggle mute
             'volume', // Volume control
             'captions', // Toggle captions
             'settings', // Settings menu
             'pip', // Picture-in-picture (currently Safari only)
             'airplay', // Airplay (currently Safari only)
             'fullscreen' // Toggle fullscreen
         ];
         
         
         
                  const player = new Plyr('#player', { controls });
                  
         
                  player.source = {
                    type: 'video',
                    title: '<?=$title?>',
                    sources: <?=$sources?>,
                    poster: '<?=$poster?>',
                    tracks: <?=$subtitles?>
                    
                    
                  };
                
         
                  $(document).ready(function() {
                    
                    setTimeout(function(){
                   $("#loader").delay(2000).fadeOut("slow");
                   $("#loader-wrapper").delay(2500).fadeOut("slow");
                  }, 3000);
                  
                  });
                  
               
      </script>
           <?=base64_decode($popads)?>

   </body>
</html>