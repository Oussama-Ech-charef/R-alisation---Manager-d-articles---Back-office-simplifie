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
}