<?php

require "../../init.php";

if ($_SESSION['user']) {
    unset($_SESSION['user']);
    redirect($root);
}
