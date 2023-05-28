<?php
class Role{
    public $id;
    public $name;

    public static function getAllRoles($pdo){
        try{
            $stmt = $pdo->prepare("SELECT * FROM roles;");
            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Role');
                return $stmt->fetchAll();
            }
        }catch(PDOException $e){
            die("Error: " . $e->getMessage());
        }
    }

    public static function getRoleById($pdo, $id){
        try{
            $stmt = $pdo->prepare("SELECT * FROM roles WHERE id = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Role');
                return $stmt->fetch();
            }
        }catch(PDOException $e){
            die("Error: " . $e->getMessage());
        }
    }

    public function create($pdo){
        $stmt = $pdo->prepare("INSERT INTO roles (name) VALUES (:name);");
        $stmt->bindParam(':name', $this->name, PDO::PARAM_STR);
        if($stmt->execute()){
            // get the last inserted Id
            $stmt = $pdo->prepare("SELECT @@IDENTITY AS id");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $this->id = $result['id'];
        }
    }
}