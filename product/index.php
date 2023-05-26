<?php
require "../init.php";

if (!$_SESSION['user']) require redirect("/");

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">Product > <small class="badge bg-primary">All</small></div>
                <a href="<?= $root . "product/create.php"; ?>" class="btn btn-sm btn-outline-dark">Create Product</a>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>