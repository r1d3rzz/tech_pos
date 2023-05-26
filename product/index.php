<?php
require "../init.php";

if (!$_SESSION['user']) require redirect("/");

$products = getAll("select * from product order by id desc");

?>

<?php require "../include/header.php"; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="mb-2">Product > <small class="badge bg-primary">All</small></div>
                <a href="<?= $root . "product/create.php"; ?>" class="btn btn-sm btn-outline-dark">Create Product</a>


                <div class="my-2">
                    <?php showMsg(); ?>
                    <?php showError(); ?>
                </div>

                <table class="table">
                    <thead>
                        <?php if (count($products)) { ?>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Sale Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody id="tblData">
                        <?php

                        if (count($products)) { ?>

                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= $product->name ?></td>
                                    <td><?= $product->total_quantity ?></td>
                                    <td><?= $product->sale_price ?></td>
                                    <td class="btn-group">
                                        <a href="<?= $root . "product/edit.php?action=edit&slug=$product->slug"; ?>" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a onclick="return confirm('Are your sure want to delete it?')" href="<?= $root . "product/delete.php?action=delete&slug=$product->slug"; ?>" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <a href="<?= $root . "product/edit.php?action=edit&slug=$product->slug"; ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <span class="mx-2 fw-bold">|</span>
                                        <a href="<?= $root . "product/edit.php?action=edit&slug=$product->slug"; ?>" class="btn btn-sm btn-outline-danger">
                                            Buy
                                        </a>
                                        <a href="<?= $root . "product/edit.php?action=edit&slug=$product->slug"; ?>" class="btn btn-sm btn-outline-primary">
                                            Sale
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