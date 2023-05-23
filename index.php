<?php
    session_start();

    require "includes/function.php";

    $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    $path = trim($path, "/");

    switch ($path) {
        case 'auth/login':
            require 'includes/auth/login.php';
            break;

        case 'auth/signup':
            require 'includes/auth/signup.php';
            break;

        case 'manage-posts':
            require "pages/posts/manage-post.php";
            break;

        case 'manage-posts-add':
            require "pages/posts/manage-post-add.php";
            break;

        case 'manage-posts-edit':
            require "pages/posts/manage-post-edit.php";
            break;

        case 'manage-users':
            require "pages/users/manage-users.php";
            break;

        case 'manage-users-add':
            require "pages/users/manage-users-add.php";
            break;

        case 'manage-users-edit':
            require "pages/users/manage-users-edit.php";
            break;

        case 'manage-users-changepwd':
            require "pages/users/manage-users-change.php";
            break;

        case 'login':
            require "pages/login.php";
            break;

        case 'signup':
            require "pages/signup.php";
            break;

        case 'logout':
            require "pages/logout.php";
            break;

        case 'post':
            require "pages/post.php";
            break;
    
        case 'dashboard':
            require "pages/dashboard.php";
            break;
        
        default:
            require "pages/home.php";
            break;
    }
?>