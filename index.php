<?php
require "./init.php";
?>

<?php require "include/header.php"; ?>

<div class="row mt-2">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <?php

                $user = $_SESSION['user'];
                if ($user) { ?>
                    <div>Welcome <?= $user->name; ?></div>
                <?php } else { ?>
                    <div>This is HOME PAGE</div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<?php require "include/footer.php"; ?>