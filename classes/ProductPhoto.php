<?php
class ProductPhoto
{
    public $id;
    public $productid;
    public $color;
    public $imagepath;

    public function create($pdo)
    {
        try {
            $stmt = $pdo->prepare('INSERT INTO productphotos (productid, color, imagepath) VALUES (:id, :color, :imagepath)');
            $stmt->bindParam(':id', $this->productid, PDO::PARAM_INT);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            $stmt->bindParam(':imagepath', $this->imagepath, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($pdo){
        try {
            $stmt = $pdo->prepare('DELETE FROM productphotos WHERE id = :id');
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($pdo){
        try {
            $stmt = $pdo->prepare('UPDATE productphotos SET productid = :productid, color = :color, imagepath = :imagepath WHERE id = :id');
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            $stmt->bindParam(':color', $this->color, PDO::PARAM_STR);
            $stmt->bindParam(':imagepath', $this->imagepath, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function getAll($pdo, $productid, $color)
    {
        $stmt = $pdo->prepare('SELECT * FROM productphotos WHERE productid = ? AND color = ?');
        $stmt->execute([$productid, $color]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'ProductPhoto');
    }

    public static function getById($pdo, $id)
    {
        $stmt = $pdo->prepare('SELECT * FROM productphotos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetchObject('ProductPhoto');
    }

    public static function getAllByProductColor($pdo, $productid, $color)
    {
        $stmt = $pdo->prepare('SELECT * FROM productphotos WHERE productid = ? AND color = ?');
        $stmt->execute([$productid, $color]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'ProductPhoto');
    }
}