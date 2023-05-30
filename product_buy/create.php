<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

function productNotFound()
{
    setError("Product Not Found");
    redirect("/product/index.php");
    die();
}

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $product = getOne("select * from product where slug='$slug'");
    if ($product->slug != $slug) return productNotFound();

    $buy_product = getOne("select * from product_buy where product_id='$product->id' order by id desc");

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $request = $_REQUEST;

        $buy_price = $request['buy_price'];
        $total_quantity = $request['total_quantity'];
        $buy_date = $request['buy_date'];

        query("insert into product_buy (product_id,buy_price,total_quantity,buy_date) values (?,?,?,?)", [
            $product->id,
            $buy_price,
            $total_quantity,
            $buy_date,
        ]);

        $total_qty = $product->total_quantity + $total_quantity;

        query("update product set total_quantity=? where slug=?", [
            $total_qty,
            $slug,
        ]);

        setMsg("Update Buy Product Successful");
        redirect("/product_buy/index.php?slug=$slug");
        die();
    }
} else {
    productNotFound();
}



?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div>Buy Product > <small class="badge bg-dark">Create</small></div>

                <div class="my-2">
                    <?php showError(); ?>
                    <?php showMsg(); ?>
                </div>

                <div class="my-2">
                    <a href=<?= $root . "product_buy/index.php?slug=$slug"; ?> class="btn btn-sm btn-outline-dark">Buy Product Info</a>
                </div>


                <div class="fs-5 my-3 text-muted">Product Name > <small class="badge bg-success"><?= $product->name; ?></small></div>

                <form action="" method="POST" class="mt-3">
                    <div class="form-group mb-3">
                        <label for="buy_price">Buy Price <span class="text-muted">(Sale Price : <?= $product->sale_price; ?>)</span></label>
                        <input type="number" name="buy_price" value="<?= $buy_product->buy_price ?>" id="buy_price" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="total_quantity">Total Quantity <span class="text-muted">(<?= $product->total_quantity; ?>)</span></label>
                        <input type="number" name="total_quantity" id="total_quantity" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="buy_date">Buy Date</label>
                        <input type="date" name="buy_date" id="buy_date" value="<?= date('Y-m-d'); ?>" class="form-control">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Buy Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>