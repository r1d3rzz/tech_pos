<div class="row mb-2">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                <nav class="fw-bold">
                    <a class="text-decoration-none" href="<?= $root; ?>">HOME</a> |
                    <?php
                    error_reporting(1);

                    $user = $_SESSION['user'];

                    if (!$user) { ?>
                        <a class="text-decoration-none" href="<?= $root . "/include/auth/login.php"; ?>">LOGIN</a>
                    <?php } else { ?>
                        <a class="text-decoration-none" href="<?= $root . "category/index.php"; ?>">CATEGORY</a> |
                        <a class="text-decoration-none" href="<?= $root . "product/index.php"; ?>">PRODUCT</a> |
                        <a class="text-decoration-none text-danger" href="<?= $root . "include/auth/logout.php"; ?>">LOGOUT</a>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>

</style>