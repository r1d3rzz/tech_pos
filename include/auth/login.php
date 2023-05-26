<?php
error_reporting(1);

require "../../init.php";

if ($_SESSION['user']) {
    redirect($root);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if (empty($email)) {
        setError("Enter Email Address");
    }

    if (empty($password)) {
        setError("Enter Your Password");
    }

    if ($email !== "") {
        $user = getOne("select * from users where email=?", [$email]);

        if (!$user) {
            setError("Email not Found");
        }

        if ($user) {
            $ver = password_verify($password, $user->password);
            if (!$ver) {
                setError('Password is wrong');
            }
        }
    }



    if (!hasError()) {
        $_SESSION['user'] = $user;
        redirect($root);
    }
}

?>

<?php require "../header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto">

        <div class="card">

            <div class="card-body">
                <div class="fs-4 mb-3">Login</div>

                <?php showError(); ?>

                <form method="POST">
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="enter your email">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="enter your password">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark w-100 text-center">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../footer.php"; ?>