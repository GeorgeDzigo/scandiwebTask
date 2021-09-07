<?php
require_once '../db.php';
abstract class MainProductLogic
{
    abstract public function create($product);
    abstract public static function products();
    abstract public static function delete($id);
}

class ProductBaseClass extends MainProductLogic
{
    protected function validate($product, $isString = false)
    {
        if ($isString) return strlen($product) != 0;
        else return is_numeric($product);
    }
    protected function validation($product)
    {
        $errors = [];

        $errors['sku'] = $this->validate($product['sku'], true);
        $errors['name'] = $this->validate($product['name'], true);

        $errors['price'] = $this->validate($product['price']);
        $errors['type'] = $product['type'] != "Type_Switcher";
        if ($product['type'] != "Type_Switcher") {
            if (gettype($product[$product['type']]) != "string") // Checking if product type is Height/Width/Length
                foreach ($product[$product['type']] as $key => $value) $errors[$key] = $this->validate($value);
            else
                $errors[$product['type']] = $this->validate($product[$product['type']]);
        }
        $errors = array_filter($errors, function ($v) {
            return !$v;
        });

        foreach ($errors as $key => $value) {
            $errors[$key] = "Please provide valid " . $key;
            $product[$key] = NULL;
        }
        return $errors;
    }
    public function create($product)
    {
        $errors = $this->validation($product);
        if (count($errors) != 0) return $errors;

        $stmt = Connection::db()->prepare("INSERT INTO products (sku, name, price, type, size, hwl, weight)
                                                        VALUES (:sku, :name, :price, :type, :mb, :dimension, :kg)");

        $dimension = NULL;
        if ($product['type'] == 'hwl')   $dimension = "{$product['hwl']['height']}x{$product['hwl']['width']}x{$product['hwl']['length']}";

        $stmt->bindParam(':sku', $product['sku']);
        $stmt->bindParam(':name', $product['name']);
        $stmt->bindParam(':price', $product['price']);
        $stmt->bindParam(':type', $product['type']);
        $stmt->bindParam(':mb', $product['size']);
        $stmt->bindParam(':kg', $product['weight']);
        $stmt->bindParam(':dimension', $dimension);

        $stmt->execute();

        return header("Location: ./");
    }


    public static function products()
    {
        $data = [];
        $stmt = Connection::db()->query('SELECT * FROM products');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            $data[] = $row;

        return $data;
    }

    public static function delete($products)
    {
        if (count($products) != 0) {
            $products = implode(",", $products["id"]);
            Connection::db()->query("DELETE FROM products WHERE id in ($products)");
        }
        return header('Location: ./');
    }

    /* Setters and Getters */
    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function __get($key)
    {
        return $this->$key;
    }
}

class Size extends ProductBaseClass
{
}
class Weight extends ProductBaseClass
{
}
class Hwl extends ProductBaseClass
{
}
