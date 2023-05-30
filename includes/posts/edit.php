<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $id = $_POST["id"];

    if(empty($content) || empty($status)) {
        $error = "Please enter field";
    }

    if (isset($error)) {
        $_SESSION['error']=$error;
        header("Location: /manage-post-edit?id=$id");
        exit;
    }

    $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'id' => $id
    ]);

    $_SESSION["success"] = "Post edited";

    header("Location: /manage-post");
    exit;
?>