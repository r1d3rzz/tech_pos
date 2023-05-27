<?php
error_reporting(1);

require "../init.php";

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $product = getOne("SELECT 
    product.*,
    category.name as category_name,
    (SELECT COUNT(id) FROM product_sale WHERE product.id=product_sale.product_id) as sale_count
    FROM product
    LEFT JOIN category on category.id=product.category_id
    WHERE product.slug='$slug'");

    if ($slug !== $product->slug) {
        redirect("index.php");
        die();
    }
} else {
    redirect("index.php");
    die();
}

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                        <?php if ($product->image) { ?>
                            <img src="../image/<?= $product->image; ?>" alt="<?= $product->image; ?>" class="img-fluid">
                        <?php } else { ?>
                            <div>There is no Image</div>
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="fs-5"><?= $product->name; ?></div>
                                <div class="text-muted fw-bold-400 my-1">Category > <small class="badge bg-primary"><?= $product->category_name; ?></small></div>


                                <table class="table">
                                    <thead>
                                        <?php if ($product) { ?>
                                            <tr>
                                                <th scope="col">Sale Count</th>
                                                <th scope="col">Sale Price</th>
                                                <th scope="col">Remain Qunatity</th>
                                            </tr>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?= $product->sale_count; ?></td>
                                            <td><?= $product->sale_price; ?></td>
                                            <td><?= $product->total_quantity; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="bg-light p-1 rounded-1">
                                    <div>
                                        <?= $product->description; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md text-end">
                        <div>
                            <a href="index.php" class="btn btn-sm btn-dark">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>