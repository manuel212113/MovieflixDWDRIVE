<?php
include "function.php";
$nonav = true;
$pagetitle = $file['name'];
head();
if ($file['type'] != 'video') $file['error'] = "can't embed this file";
if (siteinfo('video_embed')) {
    if ($file['error']) {
        echo $file['error'];
    } else if ($file['download']) { ?>
        <video id="player" style="height: 100vh!important">
            <source src="<?=$file['download']?>" type="video/mp4"/>
        </video>
<?php
    } else {
        echo "Not found";
    }
} else {
    echo "video embed is disabled";
}
foot(); ?>