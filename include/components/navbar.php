<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                <nav>
                    <a class="text-decoration-none" href="<?= $root; ?>">HOME</a> |
                    <?php
                    error_reporting(1);

                    $user = $_SESSION['user'];

                    if (!$user) { ?>
                        <a class="text-decoration-none" href="<?= $root . "include/auth/login.php"; ?>">LOGIN</a>
                    <?php } else { ?>
                        <a class="text-decoration-none" href="<?= $root . "include/auth/logout.php"; ?>">LOGOUT</a>
                    <?php } ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>

</style>