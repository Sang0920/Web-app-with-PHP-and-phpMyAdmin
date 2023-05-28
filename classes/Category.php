<?php
class Category
{
    public $categoryid;
    public $categoryname;
    public $categorysubname;

    public static function getAll($pdo)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM categories;");
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getById($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM categories WHERE categoryid = :id;");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            unset($e);
            return null;
        }
    }

    public function create($pdo)
    {
        $stmt = $pdo->prepare("INSERT INTO categories (categoryname, categorysubname) VALUES (:categoryname, :categorysubname);");
        $stmt->bindParam(':categoryname', $this->categoryname, PDO::PARAM_STR);
        $stmt->bindParam(':categorysubname', $this->categorysubname, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $this->categoryid = $pdo->lastInsertId();
            return true;
        }
    }

    public function update($pdo)
    {
        try {
            $stmt = $pdo->prepare("UPDATE categories SET categoryname = :categoryname, categorysubname = :categorysubname WHERE categoryid = :categoryid;");
            $stmt->bindParam(':categoryname', $this->categoryname, PDO::PARAM_STR);
            $stmt->bindParam(':categorysubname', $this->categorysubname, PDO::PARAM_STR);
            $stmt->bindParam(':categoryid', $this->categoryid, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function delete($pdo)
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM categories WHERE categoryid = :categoryid;");
            $stmt->bindParam(':categoryid', $this->categoryid, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getAllByCategoryName($pdo, $categoryname)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM categories WHERE categoryname = :categoryname;");
            $stmt->bindParam(':categoryname', $categoryname, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Category');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
