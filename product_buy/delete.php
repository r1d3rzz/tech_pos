<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

if (isset($_GET['action']) == "delete" && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $slug = $_GET['slug'];
    $buy_product = getOne("select * from product_buy where id='$id'");
    $product = getOne("select * from product where id='$buy_product->product_id'");
    $total_qty = $product->total_quantity - $buy_product->total_quantity;

    query("delete from product_buy where id='$id'");
    query("update product set total_quantity=? where slug=?", [
        $total_qty,
        $slug,
    ]);

    setMsg("Destroy Buy Product Successful");
    redirect("/product_buy/index.php?slug=$slug");
    die();
} else {
    setError("Product Not Found");
    redirect("/product_buy/index.php?slug=" . $slug);
    die();
}
