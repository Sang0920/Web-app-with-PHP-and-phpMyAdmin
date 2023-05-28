<?php
class ProductColor
{
    public $productid;
    public $color;

    public function create($pdo)
    {
        try {
            $stmt = $pdo->prepare('INSERT INTO productcolors (productid, color) VALUES (:productid, :color);');
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function isExisted($pdo)
    {
        try {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM productcolors WHERE productid = :productid AND color = :color');
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            return ($count > 0);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($pdo)
    {
        try {
            $stmt = $pdo->prepare('DELETE FROM productcolors WHERE productid = :productid AND color = :color;');
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getAll($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare('SELECT * FROM productcolors WHERE productid = :productid;');
            $stmt->bindParam(':productid', $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'ProductColor');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getAllByProduct($pdo, $productid){
        try {            
            $stmt = $pdo->prepare("SELECT * FROM productcolors WHERE productid = :productid;");
            $stmt->bindParam(':productid', $productid, PDO::PARAM_INT);
            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'ProductColor');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
