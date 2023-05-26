<?php
require "../init.php";

if (!$_SESSION['user']) require redirect("/");

$categories = getAll("select * from category order by id desc");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $category_id = $_REQUEST['category_id'];
    $name = $_REQUEST['name'];
    $description = $_REQUEST['description'];
    $total_qty = $_REQUEST['total_qty'];
    $sale_price = $_REQUEST['sale_price'];
    $buy_price = $_REQUEST['buy_price'];
    $buy_date = $_REQUEST['buy_date'];

    //Image 
    $img = $_FILES['img'];
    $limit_img_size = 1024 * 1024 * 2;
    $img_name = slug($img['name']);
    $path = "../image/$img_name";
    $img_tmp = $img['tmp_name'];
    move_uploaded_file($img_tmp, $path);

    if ($img['size'] > $limit_img_size) {
        setError('Image Size Muse be lower 2mb');
    } else {
        query("insert into product (category_id,slug,name,image,description,total_quantity,sale_price) values (?,?,?,?,?,?,?)", [
            $category_id,
            slug($name),
            $name,
            $img_name,
            $description,
            $total_qty,
            $sale_price,
        ]);

        $product_id = $conn->lastInsertId();

        query("insert into product_buy (product_id,buy_price,total_quantity,buy_date) values (?,?,?,?)", [
            $product_id,
            $buy_price,
            $total_qty,
            $buy_date,
        ]);

        setMsg('Product Create Successful');
    }
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">Product > <small class="badge bg-dark">Create</small></div>
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
                            <div class="col-md-6">
                                <div class="fs-4 text-center">Product Info</div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="category_id">Choose Category</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <?php foreach ($categories as $category) : ?>
                                                    <option value="<?= $category->id ?>"><?= $category->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="img">Product Image</label>
                                            <input type="file" name="img" id="img" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Product Description</label>
                                            <textarea type="text" name="description" id="description" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- inventory  -->
                            <div class="col-md-6">
                                <div class="fs-4 text-center">Inventory</div>

                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="text-primary mb-1">
                                            <small><i class="fas fa-info-circle me-2"></i><span>For Sale Info</span></small>
                                        </div>


                                        <div class="form-group mb-3">
                                            <input type="number" name="sale_price" placeholder="Sale Price" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-secondary mb-1">
                                            <small><i class="fas fa-info-circle me-2"></i><span>For Buy Info</span></small>
                                        </div>


                                        <div class="form-group mb-3">
                                            <input type="number" name="total_qty" placeholder="Total Quantity" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <input type="number" name="buy_price" placeholder="Buy Price" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <input type="date" name="buy_date" value="<?= date('Y-m-d'); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <button class="btn btn-dark rounded-1">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>