<?php

require "../init.php";

if ($_GET['action'] == 'edit' && $_GET['slug']) {
    $slug = $_GET['slug'];
    $categories = getAll("select * from category");
    $product = getOne("select * from product where slug='$slug'");
    $category = getOne("select * from category where id='$product->category_id'");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $request = $_REQUEST;

        $name = $request['name'];
        $category_id = $request['category_id'];
        $sale_price = $request['sale_price'];
        $description = $request['description'];
        $img = $_FILES['img'];

        if (isset($img) && !empty($img['name'])) {
            //update new image
            $img_name = slug($img['name']);
            $path = "../image/$img_name";
            $tmp = $img['tmp_name'];
            move_uploaded_file($tmp, $path);
            if (file_exists("../image/$product->image")) {
                unlink("../image/$product->image");
            }
        } else {
            //use old image
            $img_name = $product->image;
        }

        $update = query("update product set name=?,category_id=?,image=?,sale_price=?,description=? where slug=?", [
            $name,
            $category_id,
            $img_name,
            $sale_price,
            $description,
            $slug,
        ]);

        if ($update) {
            setMsg("Update Successful");
            // dd($_SESSION);
            redirect("edit.php?action=edit&slug=$slug");
            die();
        } else {
            setError("Update Fail");
            redirect("edit.php?action=edit&slug=$slug");
            die();
        }
    }
} else {
    redirect('index.php');
    die();
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">Product > <small class="badge bg-warning text-dark">Edit</small></div>
                <a href="<?= $root . "product/index.php"; ?>" class="btn btn-sm btn-outline-dark">All Product</a>
            </div>

            <!-- Product Info And Inventory  -->
            <div class="card">
                <form method="POST" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="my-2">
                            <?php showError(); ?>
                            <?php showMsg(); ?>
                        </div>

                        <div class="row">
                            <!-- product info  -->
                            <div class="col-md">
                                <div class="fs-4 text-center">Product Edit</div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="category_id">Choose Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <?php foreach ($categories as $c) : ?>
                                                    <?php
                                                    $selected = $c->id == $category->id ? "selected" : "";
                                                    ?>
                                                    <option value="<?= $c->id ?>" <?= $selected; ?>><?= $c->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name" value="<?= $product->name; ?>" id="name" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="img">Product Image</label>
                                            <?php
                                            $required = $product->image == "" ? 'required' : '';
                                            ?>
                                            <input type="file" name="img" id="img" class="form-control" <?= $required; ?>>
                                            <?php if ($product->image) { ?>
                                                <img src="<?= "../image/" . $product->image; ?>" width="200" alt="">
                                            <?php } ?>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="sale_price">Sale Price</label>
                                            <input id="sale_price" type="number" name="sale_price" value="<?= $product->sale_price; ?>" placeholder="Sale Price" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Product Description</label>
                                            <textarea type="text" name="description" id="description" class="form-control" required><?= $product->description; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <button class="btn btn-warning rounded-1">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>