<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);


?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div>Create</div>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>