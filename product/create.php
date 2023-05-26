<?php
require "../init.php";

$categories = getAll("select * from category order by id desc");

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
                <div class="card-body">
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
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="img">Product Image</label>
                                        <input type="file" name="img" id="img" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="description">Product Description</label>
                                        <textarea type="text" name="description" id="description" class="form-control"></textarea>
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
                                        <input type="number" name="sale_price" placeholder="Sale Price" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="text-secondary mb-1">
                                        <small><i class="fas fa-info-circle me-2"></i><span>For Buy Info</span></small>
                                    </div>


                                    <div class="form-group mb-3">
                                        <input type="number" name="total_qty" placeholder="Total Quantity" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="number" name="buy_price" placeholder="Buy Price" class="form-control">
                                    </div>

                                    <div class="form-group mb-3">
                                        <input type="date" name="buy_date" value="<?= date('Y-m-d'); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "../include/footer.php"; ?>