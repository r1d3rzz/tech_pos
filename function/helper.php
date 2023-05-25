<?php

function dd($data)
{
    echo "<pre/>";
    die(print_r($data, true));
};

$_SESSION['errors'] = [];
function setError($errors)
{
    $_SESSION['errors'][] = $errors;
}

function showError()
{
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = [];
    if (count($errors)) {
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
