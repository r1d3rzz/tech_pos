<?php
require "../init.php";

if (isset($_GET['action']) == 'delete') {
    query("delete from category where slug=?", [$_GET['slug']]);
    setMsg("Delete Category Successful");
    redirect($root . "category/index.php");
}
