<?php


class Article {

    private $conn;


    private $table_name  = "posts";


    public function __construct($db){

        $this->conn = $db;
        
    }


     public function all() {
        $query = "SELECT p.*, u.user_name, c.category_name 
                    from {$this->table_name} p
                    join users u on p.id_user = u.id_user 
                    left join category c on p.id_category = c.id_category
                    order by p.publish_date desc";


        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title, $content, $id_user, $id_category,$status, $image_url) {

        $query = "INSERT INTO {$this->table_name}
                     (title, content, id_user, id_category, status, image_url)
                     VALUES (:title, :content, :id_user, :id_category, :status, :image_url)";


        $stmt = $this->conn->prepare($query);


            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_category', $id_category);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image_url', $image_url);


        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_post = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
}

    public function single($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_post = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $content, $id_category, $status, $image_url) {
    $query = "UPDATE " . $this->table_name . " 
              SET title = :title,
               content = :content,
               id_category = :id_category,
                status = :status, 
                image_url = :image_url 
              WHERE id_post = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id_category', $id_category);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':image_url', $image_url);
        return $stmt->execute();
}





}