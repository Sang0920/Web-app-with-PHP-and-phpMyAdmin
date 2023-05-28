<?php
class Cart
{
    public $cartid;
    public $productsizeid;
    public $userid;
    public $qty;
    public $ischeckout;
    public $isdelivered;

    public function isExisted($pdo)
    {
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE productsizeid = :productsizeid AND userid = :userid");
        $stmt->bindParam(':productsizeid', $this->productsizeid, PDO::PARAM_INT);
        $stmt->bindParam(':userid', $this->userid, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        }
    }

    public function create($pdo)
    {
        if ($this->isExisted($pdo)) {
            $stmt = $pdo->prepare("UPDATE cart SET qty = qty + :qty WHERE productsizeid = :productsizeid AND userid = :userid");
            $stmt->bindParam(':productsizeid', $this->productsizeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $this->userid, PDO::PARAM_INT);
            $stmt->bindParam(':qty', $this->qty, PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            $stmt = $pdo->prepare("INSERT INTO cart (productsizeid, userid, qty, ischeckout, isdelivered) VALUES (:productsizeid, :userid, :qty, :ischeckout, :isdelivered)");
            $stmt->bindParam(':productsizeid', $this->productsizeid, PDO::PARAM_INT);
            $stmt->bindParam(':userid', $this->userid, PDO::PARAM_INT);
            $stmt->bindParam(':qty', $this->qty, PDO::PARAM_INT);
            $stmt->bindParam(':ischeckout', $this->ischeckout, PDO::PARAM_INT);
            $stmt->bindParam(':isdelivered', $this->isdelivered, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }

    public function delete($pdo)
    {
        $stmt = $pdo->prepare("DELETE FROM cart WHERE cartid = :cartid");
        $stmt->bindParam(':cartid', $this->cartid, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update($pdo)
    {
        $stmt = $pdo->prepare("UPDATE cart SET qty = :qty, ischeckout = :ischeckout, isdelivered = :isdelivered WHERE cartid = :cartid");
        $stmt->bindParam(':qty', $this->qty, PDO::PARAM_INT);
        $stmt->bindParam(':ischeckout', $this->ischeckout, PDO::PARAM_INT);
        $stmt->bindParam(':isdelivered', $this->isdelivered, PDO::PARAM_INT);
        $stmt->bindParam(':cartid', $this->cartid, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function setIsdelivered($pdo, $isdelivered)
    {
        $stmt = $pdo->prepare("UPDATE cart SET isdelivered = :isdelivered WHERE cartid = :cartid");
        $stmt->bindParam(':isdelivered', $isdelivered, PDO::PARAM_INT);
        $stmt->bindParam(':cartid', $this->cartid, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function getById($pdo, $id)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM cart WHERE cartid = :cartid");
            $stmt->bindParam(':cartid', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
                return $stmt->fetch();
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public static function getCart($pdo, $userid)
    {
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE userid = ?");
        $stmt->execute([$userid]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cart');
    }

    public static function getAllByIsCheckout($pdo, $ischeckout)
    {
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE ischeckout = ?");
        $stmt->execute([$ischeckout]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cart');
    }

    public static function decreaseProductSizeQty($pdo, $productSizeId, $qty)
    {
        $productSize = ProductSize::getById($pdo, $productSizeId);
        if ($productSize) {
            $newQty = $productSize->qty - $qty;
            if ($newQty >= 0) {
                $productSize->qty = $newQty;
                $productSize->update($pdo);
            } else {
                // Handle insufficient quantity error
                echo "Insufficient quantity available.";
            }
        } else {
            // Handle product size not found error
            echo "Product size not found.";
        }
    }    
}
