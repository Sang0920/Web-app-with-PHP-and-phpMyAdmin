<?php
class Brand
{
    public $brandid;
    public $brandname;
    public $brandimagepath;

    public static function getAll($pdo)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM brands;");
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getById($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM brands WHERE brandid = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Brand');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            unset($e);
            return null;
        }
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO brands (brandname, brandimagepath) VALUES (:brandname, :brandimagepath);");
        $stmt->bindParam(':brandname', $this->brandname, PDO::PARAM_STR);
        $stmt->bindParam(':brandimagepath', $this->brandimagepath, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->brandid = $pdo->lastInsertId();
            return true;
        }
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare("UPDATE brands SET brandname = :brandname, brandimagepath = :brandimagepath WHERE brandid = :brandid;");
        $stmt->bindParam(':brandname', $this->brandname, PDO::PARAM_STR);
        $stmt->bindParam(':brandimagepath', $this->brandimagepath, PDO::PARAM_STR);
        $stmt->bindParam(':brandid', $this->brandid, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare("DELETE FROM brands WHERE brandid = :brandid;");
        $stmt->bindParam(':brandid', $this->brandid, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
