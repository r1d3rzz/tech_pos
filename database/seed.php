<?php
require "../init.php";

// for category 

query("delete from category");

query('alter table category auto_increment=1');

$categories = ['Hat', 'Shirt', 'Shoe', 'Toys', 'Hats'];

foreach ($categories as $category) {
    query("insert into category (slug,name) values (?,?)", [
        slug($category),
        $category
    ]);
}
// --------------------------------------------------------------------------


//for Product

query("delete from product");

query("alter table product auto_increment=1");

$products = [
    ['category_id' => 1, 'slug' => slug('slug'), 'name' => 'A', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 1, 'slug' => slug('slug'), 'name' => 'A', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 1, 'slug' => slug('slug'), 'name' => 'A', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 2, 'slug' => slug('slug'), 'name' => 'B', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 2, 'slug' => slug('slug'), 'name' => 'B', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 2, 'slug' => slug('slug'), 'name' => 'B', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 3, 'slug' => slug('slug'), 'name' => 'C', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 3, 'slug' => slug('slug'), 'name' => 'C', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 3, 'slug' => slug('slug'), 'name' => 'C', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 4, 'slug' => slug('slug'), 'name' => 'D', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 4, 'slug' => slug('slug'), 'name' => 'D', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 4, 'slug' => slug('slug'), 'name' => 'D', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 5, 'slug' => slug('slug'), 'name' => 'E', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 5, 'slug' => slug('slug'), 'name' => 'E', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
    ['category_id' => 5, 'slug' => slug('slug'), 'name' => 'E', 'image' => 'img', 'description' => 'This is Description', 'total_quantity' => 10, 'sale_price' => 100],
];

foreach ($products as $product) {
    query("insert into product (category_id,slug,name,image,description,total_quantity,sale_price) values (?,?,?,?,?,?,?)", [
        $product['category_id'],
        $product['slug'],
        $product['name'],
        $product['image'],
        $product['description'],
        $product['total_quantity'],
        $product['sale_price'],
    ]);
}

// --------------------------------------------------------------------------
echo "Seeded Successful";
