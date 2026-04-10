<?php
require 'connexion.php';
require 'article.php';

$database = new Database();
$db = $database->getConnection();
$article_obj = new Article($db);

$categories = $db->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);
$users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_obj->create(

        $_POST['title'],
        $_POST['content'],
        $_POST['id_user'],
        $_POST['id_category'],
        $_POST['status'],
        $_POST['image_url']
    );
        header("Location: index.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header_container">
        <h1>New Article</h1>
        <a href="index.php" class="btn_add">+ New Article</a>
    </div>
    <div class="form_wrapper">

        <form action="" method="POST">

                <div class="form_group">

                    <label>Title</label>

                    <input type="text" name="title" required>

                </div>

                <div class="form_group">

                    <label>Image URL</label>

                    <input type="url" name="image_url">

                </div>

                <div class="form_row">

                    <div class="form_group">

                        <label>Category</label>

                        <select name="id_category">

                            <?php foreach($categories as $c): ?>

                            <option value="<?= $c['id_category'] ?>"><?= $c['category_name'] ?></option>
                            
                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="form_group">

                        <label>Author</label>

                        <select name="id_user">

                            <?php foreach($users as $u): ?>

                                <option value="<?= $u['id_user'] ?>"><?= $u['user_name'] ?></option>


                            <?php endforeach; ?>

                        </select>

                    </div>

            </div>

            <div class="form_group">

                <label>Content</label>

                <textarea name="content" required></textarea>
                
            </div>

            <div class="form_group">

                <label>Status</label>

                <select name="status">

                    <option value="published">Published</option>

                    <option value="draft">Draft</option>

                </select>

            </div>

            <div class="btn_sv_cnc">

            

                <button type="submit" class="btn_add">Save Article</button>

                <a href="index.php" class="btn_cancel">Cancel</a>

            </div>

        </form>

    </div>


    
</body>
</html>