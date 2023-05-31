<?php
require "./init.php";

$date = date('Y-m-d');
$total_sale = getOne("select sum(sale_price) as price from product_sale where date=?", [$date])->price;
$total_buy = getOne("select sum(buy_price) as price from product_buy where buy_date=?", [$date])->price;
$net_income = $total_sale - $total_buy;

$latest_sale = getAll(
    "
        select product_sale.*,product.name as product_name from product_sale
        left join product on product.id = product_sale.product_id
        where date=?
        order by id desc
        limit 5
    ",
    [$date]
);

$latest_buy = getAll(
    "
        select product_buy.*,product.name as product_name from product_buy
        left join product on product.id = product_buy.product_id
        where buy_date=?
        order by id desc
        limit 5
    ",
    [$date]
);


?>

<?php require "include/header.php"; ?>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card bg-light">
            <div class="card-body">
                <?php

                $user = $_SESSION['user'];
                if ($user) { ?>
                    <div class="row text-white text-center">
                        <div class="col-md-4 mb-1">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <div>Total Sale</div>
                                    <?php
                                    if ($total_sale > 0) { ?>
                                        <div class="badge bg-dark mt-3"><?= $total_sale; ?></div>
                                    <?php } else { ?>
                                        <div class="badge bg-dark mt-3">0</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <div>Total Buy</div>
                                    <?php
                                    if ($total_buy > 0) { ?>
                                        <div class="badge bg-dark mt-3"><?= $total_buy; ?></div>
                                    <?php } else { ?>
                                        <div class="badge bg-dark mt-3">0</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-1">
                            <div class="card bg-primary">
                                <div class="card-body">
                                    <div>Net Income</div>
                                    <?php
                                    if ($net_income > 0) { ?>
                                        <div class="badge bg-dark mt-3"><?= $net_income; ?></div>
                                    <?php } else { ?>
                                        <div class="badge bg-dark mt-3">0</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md">
                            <hr />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-1">
                            <div class="fs-5 fw-bold text-success">Latest Sale List</div>
                            <div class="card">
                                <div class="card-body">
                                    <?php

                                    if (count($latest_sale)) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Sale Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($latest_sale as $p) : ?>
                                                    <tr>
                                                        <td><?= $p->product_name; ?></td>
                                                        <td><?= $p->sale_price; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="alert alert-warning text-center">Empty Sale List for Today</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="fs-5 fw-bold text-danger">Latest Buy List</div>
                            <div class="card">
                                <div class="card-body">
                                    <?php

                                    if (count($latest_buy)) { ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">buy Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($latest_buy as $p) : ?>
                                                    <tr>
                                                        <td><?= $p->product_name; ?></td>
                                                        <td><?= $p->buy_price; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <div class="alert alert-warning text-center">Empty Buy List for Today</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else {
                    return redirect($root . "include/auth/login.php");
                } ?>

            </div>
        </div>
    </div>
</div>

<?php require "include/footer.php"; ?>