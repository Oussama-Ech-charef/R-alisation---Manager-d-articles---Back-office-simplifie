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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="header_container">
        <h1>Post Manager</h1>
        <a href="create.php" class="btn_add">+ New Article</a>
    </div>
    <div class="posts_grid">
    <?php if(!empty($articles)): ?>
        <?php foreach($articles as $article): ?>
            <div class="post_card">
                    <?php if (!empty($article['image_url'])): ?>
                        <img class="post_card_img" src="<?php echo $article['image_url']; ?>">
                    <?php else: ?>
                        
                          <p class="image_not" >Image not available</p>  
                        
                    <?php endif; ?>                
                    <div class="post_card_body">
                        <span class="post_card_category">
                            <?php echo htmlspecialchars($article['category_name'] ?? 'General'); ?>
                        </span>
        
                         <h2 class="post_card_title"><?php echo htmlspecialchars($article['title']); ?></h2>
        
                         <p class="post_card_content">
                                <?php echo htmlspecialchars($article['content']); ?>
                        </p>
                        <div class="post_card_footer">
                            <span>By <strong><?php echo htmlspecialchars($article['user_name']); ?></strong></span>
                            <span><?php echo date('M d, Y', strtotime($article['publish_date'])); ?></span>
                        </div>
                    </div>

                    <div class="post_actions">
                        <a href="edit.php?id=<?php echo $article['id_post']; ?>" class="btn_edit">Edit</a>
                        <a href="delete.php?id=<?= $article['id_post'] ?>" class="btn_delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>
</div>
    
</body>
</html>