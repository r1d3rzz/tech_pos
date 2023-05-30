<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $product = getOne("select * from product where slug='$slug'");
    $buy_products = getAll("select * from product_buy where product_id='$product->id' order by buy_date desc");

    if ($product->slug == $slug) {
        // dd($buy_products);
    } else {
        setError("Product Not Found");
        redirect("/product/index.php");
        die();
    }
} else {
    setError("Product Not Found");
    redirect("/product/index.php");
    die();
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mb-2">Buy Product > <small class="badge bg-primary">Info</small></div>
                    <div><a href="/product/index.php" class="btn btn-sm btn-outline-dark">Back</a></div>
                </div>
                <a href="<?= $root . "product_buy/create.php?slug=$slug"; ?>" class="btn btn-sm btn-outline-dark">Buy Product</a>


                <div class="my-2">
                    <?php showError(); ?>
                    <?php showMsg(); ?>
                </div>

                <table class="table">
                    <thead>
                        <?php if (count($buy_products)) { ?>
                            <tr>
                                <th scope="col">Buy Price</th>
                                <th scope="col">Buy Quantity</th>
                                <th scope="col">Buy Date</th>
                                <th scope="col">Option</th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody id="tblData">
                        <?php

                        if (count($buy_products)) { ?>

                            <div class="fs-5 my-3 text-muted">Product Name > <small class="badge bg-success"><?= $product->name; ?></small></div>

                            <?php foreach ($buy_products as $product) : ?>
                                <tr>
                                    <td><?= $product->buy_price ?></td>
                                    <td><?= $product->total_quantity ?></td>
                                    <td><?= $product->buy_date ?></td>
                                    <td><a href="#" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php } else { ?>
                            <div class="alert alert-warning mt-3">Empty Product</div>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>