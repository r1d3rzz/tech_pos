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

function showError()
{
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = [];
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

function showMsg()
{
    $messages = $_SESSION['messages'];
    $_SESSION['messages'] = [];
    if (isset($_SESSION['messages']) && count($messages)) {
        foreach ($messages as $message) {
            echo "<div class='alert alert-warning'>$message</div>";
        }
    }
}
