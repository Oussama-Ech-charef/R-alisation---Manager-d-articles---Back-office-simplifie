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


        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function create($title, $content, $id_user, $id_category,$status) {

        $query = "INSERT INTO {$this->table_name}
                     (title, content, id_user, id_category, status)
                     VALUES (:title, :content, :id_user, :id_category, :status)";


        $stmt = $this->conn->prepare($query);


            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':id_user', $id_user);
            $stmt->bindParam(':id_category', $id_category);
            $stmt->bindParam(':status', $status);


        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}