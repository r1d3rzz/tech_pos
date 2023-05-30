<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

if (isset($_GET['slug']) && !empty($_GET['slug'])) {
    $slug = $_GET['slug'];

    $product = getOne("select * from product where slug='$slug'");

    $product_id = $product->id;
    $sale_price = $product->sale_price;
    $sale_date = date('Y-m-d');

    query("insert into product_sale (product_id,sale_price,date) values (?,?,?)", [
        $product_id,
        $sale_price,
        $sale_date,
    ]);

    $total_quantity = $product->total_quantity - 1;

    query("update product set total_quantity=? where slug=?", [
        $total_quantity,
        $product->slug,
    ]);

    setMsg("Product Sale Successful");
    redirect("/product/index.php");
    die();
} else {
    setError("Product Not Found");
    redirect("/product/index.php");
    die();
}
