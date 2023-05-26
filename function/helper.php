<?php

function dd($data)
{
    echo "<pre/>";
    die(print_r($data, true));
};

function setError($errors)
{
    $_SESSION['errors'] = [];
    $_SESSION['errors'][] = $errors;
}

$_SESSION['errors'] = [];
function showError()
{
    $errors = $_SESSION['errors'];
    if (isset($_SESSION['errors']) && count($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}

function hasError()
{
    $errors = $_SESSION['errors'];

    if (count($errors)) {
        return true;
    }

    return false;
}

function redirect($path)
{
    header("Location: $path");
}

function slug($name)
{
    return uniqid() . "-" . strtolower(str_replace(" ", "-", $name));
}

function setMsg($message)
{
    $_SESSION['messages'] = [];
    $_SESSION['messages'][] = $message;
}

$_SESSION['messages'] = [];
function showMsg()
{
    $messages = $_SESSION['messages'];
    if (isset($_SESSION['messages']) && count($messages)) {
        foreach ($messages as $message) {
            echo "<div class='alert alert-warning'>$message</div>";
        }
    }
}

function categoryPaginate($rec_per_page = 5)
{
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 2;
    }

    if ($page <= 0) {
        $page = 2;
    }

    // 1 => 0,2
    // 2 => 2,2
    // 3 => 4,2

    $start = ($page - 1) * $rec_per_page;
    $limit = "$start,$rec_per_page";
    $sql = "select * from category order by id desc limit $limit";
    $data = getAll($sql);
    echo json_encode($data);
}
