<?php
class ProductSize
{
  public $id;
  public $productid;
  public $color;
  public $size;
  public $qty;

  public function create($pdo)
  {
    $stmt = $pdo->prepare("INSERT INTO productsizes (productid, color, size, qty) VALUES (:productid, :color, :size, :qty)");
    $stmt->bindParam(':productid', $this->productid);
    $stmt->bindParam(':color', $this->color);
    $stmt->bindParam(':size', $this->size);
    $stmt->bindParam(':qty', $this->qty);
    return $stmt->execute();
  }

  public function delete($pdo)
  {
    $stmt = $pdo->prepare("DELETE FROM productsizes WHERE id = :id");
    $stmt->bindParam(':id', $this->id);
    return $stmt->execute();
  }

  public function update($pdo)
  {
    $stmt = $pdo->prepare("UPDATE productsizes SET qty = :qty WHERE id = :id");
    $stmt->bindParam(':qty', $this->qty);
    $stmt->bindParam(':id', $this->id);
    return $stmt->execute();
  }

  public static function getAll($pdo, $id, $color)
  {
    $stmt = $pdo->prepare("SELECT * FROM productsizes WHERE productid = :id AND color = :color");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':color', $color);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, 'ProductSize');
  }

  public static function getById($pdo, $id)
  {
    $stmt = $pdo->prepare("SELECT * FROM productsizes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchObject('ProductSize');
  }

  public static function getAllByProductColor($pdo, $productid, $color)
  {
    $stmt = $pdo->prepare("SELECT * FROM productsizes WHERE productid = :productid AND color = :color");
    $stmt->bindParam(':productid', $productid);
    $stmt->bindParam(':color', $color);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_CLASS, 'ProductSize');
  }
}
