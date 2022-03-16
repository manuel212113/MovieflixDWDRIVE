<?php
include "function.php";
$pagetitle = $file['name'];
head();
?>
<div class="container">
    <?php response_status() ?>
    <div class="my1 mx-auto text-center">
        <?php echo ads('top'); ?>
    </div>

    <div class="card medium center">
        <div class="card-head center"><?php echo $file['host'] ?></div>
        
        <?php
        if (siteinfo('video_preview') && $file['download'] && $file['type'] == 'video' && !$file['error']) { ?>
            <video id="player" preload="none">
                <source src="<?=$file['download']?>" type="video/mp4"/>
            </video>
        <?php } ?>
        <ul class="list-1">
            <li><b>Filename:</b> <span><?php echo $file['name'] ?></span></li>
            <li><b>Filesize:</b> <span><?php echo $file['size'] ?></span></li>
        </ul>
        <div class="card-body center">
            <?php if ($file['error']) {
                echo "<div class='alert danger'><strong>#Error</strong> $file[error]</div>";
            } else if ($file['download']) {
                if (siteinfo('countdown') && $file['down_type'] == 'countdown') {
                    echo "<a id='dl' class='button disabled' countdown='".siteinfo('countdown')."' countdown_href='$file[download]'>Please Wait</a>";
                } else if (siteinfo('afterload')) {
                    echo '<a id="dl" class="button disabled" afterload="'.$file['download'].'">Please wait</a>';
                } else {
                    echo '<a id="dl" class="button" href="'.$file['download'].'">Download</a>';
                }
            } else {
                echo "<div class='alert danger'>Not Found</div>";
            } ?>
        </div>
    </div>

    <div class="my1 mx-auto text-center">
        <?php echo ads('bottom'); ?>
    </div>
</div>
<?php anti_adblock('checker'); ?>
<?php echo siteinfo('footer_script'); ?>
<?php foot(); ?>