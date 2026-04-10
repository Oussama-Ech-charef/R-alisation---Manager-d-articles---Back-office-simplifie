<?php
require 'connexion.php';
require 'article.php';

$database = new Database();
$db = $database->getConnection();
$article_obj = new Article($db);

$id = $_GET['id'];
$post = $article_obj->single($id); 
$categories = $db->query("SELECT * FROM category")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $article_obj->update(
    $id,
    $_POST['title'],
    $_POST['content'],
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
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form_wrapper">

        <h2>Edit Article</h2>

        <form method="POST">

            <div class="form_group">

                <label>Title</label>

                <input type="text" name="title" value="<?= $post['title'] ?>" required>

            </div>


            <div class="form_group">

                <label>Image URL</label>

                <input type="url" name="image_url" value="<?= $post['image_url'] ?>">

            </div>


            <div class="form_group">

                <label>Category</label>

                <select name="id_category">

                    <?php foreach($categories as $c): ?>

                        <option value="<?= $c['id_category'] ?>" <?= ($c['id_category'] == $post['id_category']) ? 'selected' : '' ?>>

                            <?= $c['category_name'] ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            


            <div class="form_group">

                <label>Content</label>

                <textarea name="content" required><?= $post['content'] ?></textarea>

            </div>


            <div class="form_group">

                <label>Status</label>

                <select name="status">

                    <option value="published" <?= ($post['status'] == 'published') ? 'selected' : '' ?>>Published</option>

                    <option value="draft" <?= ($post['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>

                </select>

            </div>


            <div class="btn_sv_cnc">

                <button type="submit" class="btn_add ">Update Article</button>

                <a href="index.php" class="btn_cancel">Cancel</a>

            </div>    

        </form>


    </div>
</body>
</html>