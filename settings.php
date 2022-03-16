<?php
include "function.php";
head();
?>

<div class="container">
    <div class="sidebar">
        <div class="card">
            <div class="card-head toggle">Settings menu <div><i class="material-icons">menu</i></div></div>
            <ul class="v-menu" data_tab="settings_tab">
                <li tab_select="user_settings" class="active"><i class="material-icons">account_circle</i> Admin account</li>
                <li tab_select="site_settings"><i class="material-icons">settings</i> Site Settings</li>
            </ul>
        </div>
    </div>
    <div class="content">
        <?php response_status() ?>
        <div class="card" tab_id="settings_tab">
            <div id="user_settings" class="active">
                <div class="card-head">Admin account</div>
                <div class="card-body">
                    <form method="POST">
                        <label for="user">Username</label>
                        <input type="text" name="user" id="user" value="<?php echo userActive() ?>">

                        <div class="inline">
                            <div>
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass">
                            </div>
                            <div>
                                <label for="repass">Repeat Password</label>
                                <input type="password" name="repass" id="repass">
                            </div>
                        </div>
                        <small>leave empty if you don't want change password</small>

                        <button class="button big" name="useredit">Save</button>
                    </form>
                </div>
            </div>
            <div id="site_settings">
            <div class="card-head">Site Settings</div>
                <div class="card-body">
                    <form method="POST">
                        <label for="title">Site Title</label>
                        <input type="text" name="title" id="title" value="<?php echo siteinfo('title') ?>">

                        <label for="description">Site Description</label>
                        <textarea name="description" id="description" cols="30" rows="10"><?php echo siteinfo('description') ?></textarea>

                        <button class="button big" name="siteedit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foot(); ?>