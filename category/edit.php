<?php

require "../init.php";

function categoryNotFound()
{
    setError("Category Not Found");
    redirect('/category/index.php');
    die();
}

if (!$_SESSION['user']) return redirect('/include/auth/login.php');
if (!$_GET['slug']) {
    categoryNotFound();
};

if (isset($_GET['action']) == 'edit') {
    $category = getOne("select * from category where slug=?", [$_GET['slug']]);

    if ($category->slug !== $_GET['slug']) {
        categoryNotFound();
    };


    if (!isset($_REQUEST['category_name'])) {
        $category_name = $category->name;
    } else {
        $category_name = $_REQUEST['category_name'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $slug = $_GET['slug'];

        if (empty($category_name)) {
            setError('Enter Category Name');
        }

        if (!hasError()) {
            query("update category set name=?,slug=? where slug=?", [
                $category_name,
                slug($category_name),
                $slug,
            ]);

            setMsg('Update Category Successful');
        }
    }
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div>Category > <small class="badge bg-secondary">Edit</small></div>

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
                        <input type="text" name="category_name" value="<?= $category_name; ?>" id="category" class="form-control">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>