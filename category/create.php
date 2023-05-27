<?php

require "../init.php";

if (!$_SESSION['user']) return redirect('/include/auth/login.php');


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $category_name = $_REQUEST['category_name'];

    if (empty($category_name)) {
        setError('Enter Category Name');
    }

    if (!hasError()) {
        query('insert into category (slug,name) values (?,?)', [
            slug($category_name),
            $category_name,
        ]);

        setMsg('Create New Category Successful');
    }
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div>Category > <small class="badge bg-dark">Create</small></div>

                <div class="my-2">
                    <?php showError(); ?>
                    <?php showMsg(); ?>
                </div>

                <div class="my-2">
                    <a href="<?= $root . "category/index.php"; ?>" class="btn btn-sm btn-outline-dark">All Category</a>
                </div>

                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label for="category">Name</label>
                        <input type="text" name="category_name" id="category" class="form-control">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>