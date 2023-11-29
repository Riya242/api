<?php 
class Product{
    private $conn;
    private $table_name="products";

    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    public function __construct($db) {
        $this->conn=$db;
    }
    public function read(){
        $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM `$this->table_name` p LEFT JOIN categories c
                ON p.category_id = c.id ORDER BY p.created DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function create(){
        $query = "INSERT INTO `$this->table_name`(name,description,price,category_id,created) VALUES(?,?,?,?,?)";
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array($this->name,$this->description,$this->price,$this->category_id,$this->created));
    }
    public function readOne(){
        $query = "SELECT * FROM `$this->table_name` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(array($this->id));
        $res = $stmt->fetch();
        $this->id=$res['id'];
        $this->name=$res['name'];
        $this->description=$res['description'];
        $this->price=$res['price'];
        $this->category_id=$res['category_id'];
        $this->created=$res['created'];
    }

    public function update(){
        $query = "UPDATE `$this->table_name` SET `name` = ?,`description` = ?,price=?,category_id=?,created=? WHERE `id` = ?";
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->created = htmlspecialchars(strip_tags($this->created));
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array($this->name,$this->description,$this->price,$this->category_id,$this->created,$this->id));
    }
    public function delete(){
        $query = "DELETE FROM `$this->table_name` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array($this->id));
    }
}
?>