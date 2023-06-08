<?php

class Post
{

    public static function getPublishPosts()
    {
        if ( isset( $_GET['id'] ) ) {

            $db = new DB();

             //  $sql = "SELECT * FROM posts WHERE id = :id";
            $posts =  $db->fetch(
                "SELECT * FROM posts WHERE id = :id AND status = :status",
                [
                'id' => $_GET['id']
                ]
            );
         
            if ( !$posts ) {
             // if post don't exists, then we redirect back to manage-posts
             header("Location: /manage-posts");
             exit;
           }
           return $posts;

         } else {
           // if $_GET['id'] is not available, then redirect the user back to manage-users
           header("Location: /manage-posts");
           exit;
         }
    }

    public static function getPostsByUserRole()
    {
        // load database
        $db = new DB();

        // get all posts
        if( Auth::isAdmin() || Auth::isEditor()){
        // * means get all the columns from the selected table
        return $db->fetchAll(
            "SELECT 
            posts.*, 
            users.name AS user_name,
            users.email AS user_email 
            FROM posts 
            JOIN users 
            ON posts.user_id = users.id",
        );
        } else {
            return $db->fetchAll(
                "SELECT 
                posts.id, 
                posts.title, 
                posts.status, 
                users.name AS user_name 
                FROM posts 
                JOIN users 
                ON posts.user_id = users.id 
                where posts.user_id = :user_id",

            [
                'user_id' => $_SESSION["user"]["id"]
            ]
            
            );
        }
    }

    public static function getPostByID(  )
    {
        if ( isset( $_GET['id'] ) ) {

            $db = new DB();

            return $db->fetch(
            "SELECT posts.*, 
            users.name 
            FROM posts 
            JOIN users
            ON posts.modified_by = users.id
            WHERE posts.id = :id",
            //  $sql = "SELECT * FROM posts WHERE id = :id";
            [
                'id' => $_GET['id']
            ]);

            } else {
            // if $_GET['id'] is not available, then redirect the user back to manage-users
            header("Location: /manage-posts");
            exit;
        }
    }

    public static function add()
    {
        $db = new DB();

        $title = $_POST['title'];
        $content = $_POST['content'];

        if(empty( $title ) || empty( $content )){
            $error = "Please enter all fields";
        }

        if (isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-post-add");
        }

       "INSERT INTO posts (`title`, `content`, `user_id`)
        VALUES(:title, :content, :user_id)";

        $db->insert(  "INSERT INTO posts (`title`, `content`, `user_id`)
        VALUES(:title, :content, :user_id)", 
        [
            'title' => $title,
            'content' => $content,
            'user_id' => $_SESSION["user"]["id"]
        ]);
        
        $_SESSION["success"] = "New post added";
        header("Location: /manage-post");
        exit;
    }

    public static function edit()
    {
        $db = new DB();

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
        
        
        $db->update(
            "UPDATE posts SET title = :title, content = :content, status = :status, modified_by = :modified_by WHERE id = :id" , 
            [
                'title' => $title,
                'content' => $content,
                'status' => $status,
                'id' => $id,
                'modified_by' => $_SESSION['user']['id']
            ]
        );

        $_SESSION["success"] = "Post edited";
        $_SESSION["update_post"] = $title;

        header("Location: /manage-post");
        exit;
    }

    public static function delete()
    {
        $db = new DB();

        $id = $_POST["id"];

        if(empty($id)){
            $error = "Error 404";
        }

        if (isset($error)){
            $_SESSION['error'] = $error;
            header("Location: /manage-post");
            exit;
        }
        
        $db->delete(
            "DELETE FROM posts WHERE id = :id", 
            [
            'id' => $id
            ]);

        $_SESSION["success"]="Post deleted";

        header("Location: /manage-post");
        exit;
    }
}