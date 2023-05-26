<?php
require "../init.php";

// for category 

query("delete from category");

query('alter table category auto_increment=1');

$categories = ['Hat', 'Shirt', 'Shoe', 'Toys'];

foreach ($categories as $category) {
    query("insert into category (slug,name) values (?,?)", [
        slug($category),
        $category
    ]);
}
// --------------------------------------------------------------------------

echo "Seeded Successful";
