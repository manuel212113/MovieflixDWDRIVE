<?php
include "function.php";
head();
?>
<div class="container">
    <div class="card small center">
        <div class="card-head">Login to Admin panel</div>
        <div class="card-body">
            <?php response_status() ?>
            <form action="login.php" method="POST">
                <label for="user">Username</label>
                <input type="text" name="user" id="user" required>
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" required>
                <button class="button big">Log in</button>
            </form>
        </div>
    </div>
</div>
<?php foot() ?>