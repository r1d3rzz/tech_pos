<?php
require "./init.php";

require "./include/header.php";

$users = getOne("select * from users where id = 2");

dd($users);

require "./include/footer.php";
