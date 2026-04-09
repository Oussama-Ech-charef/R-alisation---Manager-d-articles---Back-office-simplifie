<?php


require 'connexion.php';

require 'article.php';


$database = new Database();

$db = $database->getConnection();

$article_obj = new Article($db);


$articles = $article_obj->all();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management Blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="header-container">
        <h1>Post Manager</h1>


        <a href="create.php" class="btn-add"> + New Article</a>

    </div>


    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article Info</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>


                    <tr>
                        <td style="color: #999;"><?php echo $article['id_post']; ?></td>
                        <td>
                            <span class="post-title"><?php echo htmlspecialchars($article['title']); ?></span>
                            <div class="post-content"><?php echo nl2br(htmlspecialchars($article['content'])); ?></div>
                        </td>
                        <td class="author-name"><?php echo htmlspecialchars($article['user_name']); ?></td>
                        <td><span class="category-badge"><?php echo htmlspecialchars($article['category_name']) ?? 'General'; ?></span></td>
                        <td style="white-space: nowrap; font-size: 13px;"><?php echo date('M d, Y', strtotime($article['publish_date'])); ?></td>
                        <td>
                            <span class="status-pill <?php  echo $article['status'];?>">
                                <?php echo $article['status']; ?>
                            </span>
                        </td>
                    </tr>

                    <?php endforeach; ?>
            </tbody>
        </table>

    </div>

 
</body>
</html>