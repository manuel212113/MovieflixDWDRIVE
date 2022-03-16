<?php
include 'function.php';
head();
?>

<div class="container">
    <div class="left">
        <div class="card">
            <div class="card-head"><span>Google Drive Link Download Generator</span> <div class="button-group" data_tab="link_generate"><a class="active" tab_select="batch_tab"><i class="material-icons">code</i></a><a tab_select="link_tab"><i class="material-icons">link</i></a></div></div>
            <div class="card-body" tab_id="link_generate">
                <div id="batch_tab" class="active">

                    <?php if (siteinfo('generator_display') || userActive()) { ?>
                    <div class="textarea">
                        <textarea id="linklist" class="autosize nowrap" placeholder="https://drive.google.com/file/d/1HwAZnqckeKRBFno-ukeJ9PdkVaS5oOC6/view"></textarea>
                    </div>
                    
                    <?php if (siteinfo('shortlink') || userActive()) { ?>
                    <div class="shortlink">
                        <label for="shortlink">Shortlink</label>
                        <input type="checkbox" id="shortlink" class="switch" value="<?php echo isset($_COOKIE['shortlink'])? $_COOKIE['shortlink'] : '' ?>">
                    </div>
                    <?php } ?>

                    <div class="dl-list-type">
                        <select id="type">
                            <option value="0">Button</option>
                            <option value="1">Direct</option>
                            <option value="2">Countdown</option>
                            <?php if (siteinfo('video_embed')) echo '<option value="3">Embed</option>' ?>
                        </select>
                        <a id="generate" class="button">Generate</a>
                    </div>

                    <?php } else {
                        echo '<div class="alert danger">Generator Box is Disabled</div>';
                    } ?>
                </div>
                <div id="link_tab">

                    <?php if (siteinfo('api') || userActive()) { ?>
                    
                    <p>Use this url if you want to generate link by url</p>
                    <div class="code"><?php echo siteinfo('url') ?>api.php?go=<b>[LINK]</b></div>
                    <p>Change <span class="code small select">[LINK]</span> with your link original link</p>
                    <p>or add <span class="code small select">&type=<b>[TYPE]</b></span> to choose link type you want</p>
                    <div class="code"><?php echo siteinfo('url') ?>api.php?go=<b>[LINK]</b>&type=<b>[TYPE]</b></div>
                    <p>Change <span class="code small select">[TYPE]</span> with <span class="code small select">button</span>, <span class="code small select">direct</span> or <span class="code small select">countdown</span></p>

                    <?php } else {
                        echo '<div class="alert danger">API is Disabled</div>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="card" id="resultlist">
            <div class="card-head">Result <div class="button-group"><a id="result_text" class="active"><i class="material-icons">code</i></a><a id="result_list"><i class="material-icons">view_list</i></a></div></div>
            <div class="card-body">
                <ul class="linklist">
                    <div class="textarea">
                        <textarea class="autosize nowrap"></textarea>
                    </div>
                </ul>
            </div>
        </div>
        <div class="card" id="supported">
            <div class="card-head">Supported Host</div>
            <div class="card-body">
                <?php
                    $host = [];
                    foreach (host() as $key => $val) {
                        if ($val == 'online') {
                            array_push($host, '<span>'.$key.'</span>');
                        }
                    }
                    echo implode(', ', $host);
                ?>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="card" id="howtouse">
            <div class="card-head">Shared by AZetaK</div>
            <div class="card-body">
                <ol>
                    <b>babiato.co</b>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php foot() ?>