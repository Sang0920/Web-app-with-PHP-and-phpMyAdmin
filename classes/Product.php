<?php
class Product
{
    public $productid;
    public $productname;
    public $price;
    public $discount;
    public $shortdescription;
    public $description;
    public $gender;
    public $sizetype;
    public $brandid;
    public $categoryid;

    public static function getAll($pdo, $offset = 0, $limit = null)
    {
        $limit = isset($limit) ? $limit : Product::getCount($pdo);
        try {            
            $stmt = $pdo->prepare("SELECT * FROM products ORDER BY productid DESC LIMIT :limit OFFSET :offset;");
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    
    public static function getAllByGender($pdo, $gender, $offset = 0, $limit = null){
        $limit = isset($limit) ? $limit : Product::getCount($pdo);
        try{
            $stmt = $pdo->prepare("SELECT * FROM products WHERE gender = :gender ORDER BY productid DESC LIMIT :limit OFFSET :offset;");
            $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getAllByBrand($pdo, $products, $brandid){
        return array_filter($products, function($product) use ($brandid){
            return $product->brandid == $brandid;
        });
    }

    public static function getById($pdo, $id)
    {
        try {            
            $stmt = $pdo->prepare("SELECT * FROM products WHERE productid = :productid;");
            $stmt->bindParam(':productid', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function create($pdo)
    {
        try {            
            $stmt = $pdo->prepare('INSERT INTO products (productname, price, discount, shortdescription, description, gender, sizetype, brandid, categoryid) 
                VALUES (:productname, :price, :discount, :shortdescription, :description, :gender, :sizetype, :brandid, :categoryid);');
            $stmt->bindParam(':productname', $this->productname, PDO::PARAM_STR);
            $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
            $stmt->bindParam(':discount', $this->discount, PDO::PARAM_STR);
            $stmt->bindParam(':shortdescription', $this->shortdescription, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $this->gender, PDO::PARAM_INT);
            $stmt->bindParam(':sizetype', $this->sizetype, PDO::PARAM_STR);
            $stmt->bindParam(':brandid', $this->brandid, PDO::PARAM_INT);
            $stmt->bindParam(':categoryid', $this->categoryid, PDO::PARAM_INT);
            $stmt->execute();
            $this->productid = $pdo->lastInsertId();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($pdo)
    {
        try {            
            $stmt = $pdo->prepare('UPDATE products 
                SET productname = :productname, price = :price, discount = :discount, 
                shortdescription = :shortdescription, description = :description, 
                gender = :gender, sizetype = :sizetype, 
                brandid = :brandid, categoryid = :categoryid 
                WHERE productid = :productid;');
            $stmt->bindParam(':productname', $this->productname, PDO::PARAM_STR);
            $stmt->bindParam(':price', $this->price, PDO::PARAM_STR);
            $stmt->bindParam(':discount', $this->discount, PDO::PARAM_STR);
            $stmt->bindParam(':shortdescription', $this->shortdescription, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $this->gender, PDO::PARAM_INT);
            $stmt->bindParam(':sizetype', $this->sizetype, PDO::PARAM_STR);
            $stmt->bindParam(':brandid', $this->brandid, PDO::PARAM_INT);
            $stmt->bindParam(':categoryid', $this->categoryid, PDO::PARAM_INT);
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function delete($pdo, $id)
    {
        try {            
            $stmt = $pdo->prepare('DELETE FROM `products` WHERE `productid` = :productid;');
            $stmt->bindParam(':productid', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getFistImagePath($pdo){
        try {            
            $stmt = $pdo->prepare("SELECT * FROM productphotos WHERE productid = :productid LIMIT 1;");
            $stmt->bindParam(':productid', $this->productid, PDO::PARAM_INT);
            if($stmt->execute()){
                $stmt->setFetchMode(PDO::FETCH_OBJ);
                $photo = $stmt->fetch();
                return $photo->imagepath;
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function countColors($pdo){
        try {            
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM productcolors WHERE productid = :productid;");
            $stmt->bindValue(':productid', $this->productid, PDO::PARAM_INT);
            if($stmt->execute()){
                return $stmt->fetchColumn();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getCount($pdo)
    {
        try {    
            $stmt = $pdo->prepare('SELECT COUNT(products.productid) FROM products;');
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function searchByName($pdo, $name){
        try {            
            $stmt = $pdo->prepare("SELECT * FROM products WHERE productname LIKE :productname;");
            $stmt->bindValue(':productname', "%$name%", PDO::PARAM_STR);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
                return $stmt->fetchAll();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

}
