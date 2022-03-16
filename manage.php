<?php
include "function.php";
head();
?>
<div class="container">
    <div class="sidebar">
        <div class="card">
            <div class="card-head toggle">Manage site menu <div><i class="material-icons">menu</i></div></div>
            <ul class="v-menu" data_tab="manage_tab">
                <li tab_select='manage_download' class="active"><i class="material-icons">vertical_align_bottom</i> Download</li>
                <li tab_select='video_player'><i class="material-icons">play_circle_outline</i> Video Player</li>
                <li tab_select='manage_ads'><i class="material-icons">local_atm</i> Ads</li>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php response_status() ?>
        <div class="card" tab_id="manage_tab">
            <div id="manage_download" class="active">
                <div class="card-head">THIS IS A FREE RELEASE FROM AZetaK FOR BABIATO.CO, DON'T PAY FOR IT</div>
                <form method="POST">
                    <ul class="panel">
                        <li class="select">
                            <div>
                                <label for="generator_display">Link Download Generator</label>
                            </div>
                            <div>
                                <select name="generator_display" class="wide" id="generator_display">
                                    <option value="1"<?php echo (siteinfo('generator_display') === '1' ? ' selected' : '') ?>>Show for All</option>
                                    <option value="0"<?php echo (siteinfo('generator_display') === '0' ? ' selected' : '') ?>>Admin Only</option>
                                </select>
                            </div>
                        </li>
                        <li>
                            <div>
                                <label for="shortlink">Shortlink</label>
                                <span>Disable this will hide shortlink option from Link Generator</span>
                            </div>
                            <div>
                                <input type="checkbox" name="shortlink" class="switch" value="<?php echo siteinfo('shortlink') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label>Disable Direct type link</label>
                                <span>Disable this will make all link type to Button type link</span>
                            </div>
                            <div>
                                <input type="checkbox" name="direct_link" class="switch" value="<?php echo siteinfo('direct_link') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label for="countdown">Countdown time</label>
                            </div>
                            <div>
                                <input type="number" name="countdown" id="countdown" min="1" step="1" value="<?php echo (siteinfo('countdown') ? siteinfo('countdown') : '5') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label>Anti Adblock</label>
                            </div>
                            <div>
                                <input type="checkbox" name="anti_adblock" class="switch" value="<?php echo siteinfo('anti_adblock') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label>API</label>
                            </div>
                            <div>
                                <input type="checkbox" name="api" class="switch" value="<?php echo siteinfo('api') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label>AfterLoad Download Button</label>
                                <span>Show Download Button after all Ads loaded</span>
                            </div>
                            <div>
                                <input type="checkbox" name="afterload" class="switch" value="<?php echo siteinfo('afterload') ?>">
                            </div>
                        </li>
                    </ul>
                    <div class="m1">
                        <button class="button big">Save</button>
                    </div>
                </form>
            </div>
            
            <div id="video_player">
                <div class="card-head">Manage Player</div>
                <form method="POST">
                    <ul class="panel">
                        <li>
                            <div>
                                <label for="video_preview">Video Preview</label>
                                <span>Show video player in Download page</span>
                            </div>
                            <div>
                                <input type="checkbox" name="video_preview" class="switch" value="<?php echo siteinfo('video_preview') ?>">
                            </div>
                        </li>
                        <li>
                            <div>
                                <label for="video_embed">Video Embed</label>
                                <span>Enable/Disable Embed player</span>
                            </div>
                            <div>
                                <input type="checkbox" name="video_embed" class="switch" value="<?php echo siteinfo('video_embed') ?>">
                            </div>
                        </li>
                        <div class="m1">
                            <button class="button big">Save</button>
                        </div>
                    </ul>
                </form>
            </div>

            <div id="manage_ads">
                <div class="card-head">Manage Ads</div>
                <div class="card-body">
                    <form method="POST">
                        <label for="ads_top">Ads Top</label>
                        <textarea name="ads_top" id="ads_top" class="autosize" rows="5"><?php echo siteinfo('ads_top') ?></textarea>

                        <label for="ads_bottom">Ads Bottom</label>
                        <textarea name="ads_bottom" id="ads_bottom" class="autosize" rows="5"><?php echo siteinfo('ads_bottom') ?></textarea>

                        <label for="footer_script">Footer Script</label>
                        <textarea name="footer_script" id="footer_script" class="autosize" rows="5"><?php echo siteinfo('footer_script') ?></textarea>
                        <small>Footer script is using for place Pop Ads type or another script</small>
                        <button class="button big mt1">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foot(); ?>