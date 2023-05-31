<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $_GET['slug'];
    $product = getOne("select * from product where slug='$slug'");
    $sale_products = getAll("select * from product_sale where product_id='$product->id' order by id desc");

    if ($product->slug != $slug) {
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
                    <div class="mb-2 fs-4">Sale List</div>
                    <div><a href="/product/index.php" class="btn btn-sm btn-dark">Back</a></div>
                </div>

                <div class="my-2">
                    <?php showError(); ?>
                    <?php showMsg(); ?>
                </div>

                <table class="table">
                    <thead>
                        <?php if (count($sale_products)) { ?>
                            <tr>
                                <th scope="col">Sale_Price</th>
                                <th scope="col">Date</th>
                                <th scope="col">Option</th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody id="tblData">
                        <?php

                        if (count($sale_products)) { ?>

                            <div class="fs-5 my-3 text-muted">Product Name > <a href="<?= $root . "product/detail.php?action=detail&slug=$product->slug"; ?>"><small class="badge bg-success"><?= $product->name; ?></small></a></div>

                            <?php foreach ($sale_products as $p) : ?>
                                <tr>
                                    <td><?= $p->sale_price ?></td>
                                    <td><?= $p->date ?></td>
                                    <td><a onclick="return confirm('Are Sure to Remove from Sale List?')" href="/product_sale/remove.php?action=remove&slug=<?= $slug ?>&id=<?= $p->id; ?>&product_id=<?= $p->product_id; ?>" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php } else { ?>
                            <div class="alert alert-warning mt-3">Empty Sale List</div>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>