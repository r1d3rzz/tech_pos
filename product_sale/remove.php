<?php

require "../init.php";

if (!isset($_SESSION['user'])) return redirect($root);

$slug = $_GET['slug'];

if (isset($_GET['action']) && !empty($_GET['slug']) && !empty($_GET['product_id'])) {
    $id = $_GET['id'];
    $product_id = $_GET['product_id'];

    $product = getOne("select * from product where id='$product_id'");

    $total_quantity = $product->total_quantity + 1;

    query("update product set total_quantity=? where slug=?", [
        $total_quantity,
        $slug,
    ]);

    query("delete from product_sale where id=?", [$id]);

    setMsg("Product Remove Successful");
    redirect("/product_sale/index.php?slug=" . $slug);
    die();
} else {
    setError("Product Not Found");
    redirect("/product_sale/index.php?slug=" . $slug);
    die();
}
