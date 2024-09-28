<?php


class Product{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }


    public function fetch_all($sortCriteria = 'price', $sortDirection = 'asc') {
        $sortCriteria = $this->conn->real_escape_string($sortCriteria);
        $sortDirection = $this->conn->real_escape_string($sortDirection);
        $sql = "SELECT * FROM products ORDER BY $sortCriteria $sortDirection";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name,$price,$size,$image){
        $query="INSERT INTO products (name,price,size,image) VALUES (?,?,?,?)";
        $stmt=$this->conn->prepare($query);
        $stmt->bind_param('ssss',$name,$price,$size,$image);
        $stmt->execute();
    }

    public function read($product_id){
        $stmt=$this->conn->prepare("select * from products where product_id=?");
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
        $result=$stmt->get_result();
        return $result->fetch_assoc();
    }
    public function update($product_id, $name, $price, $size, $image) {
        $query = "UPDATE products SET name = ?, price = ?, size = ?, image = ? WHERE product_id = ?";
        $stmt = $this->conn->prepare($query);
        // Redosled tipova treba biti 'ssssi' (četiri stringa, jedan integer)
        $stmt->bind_param('ssssi', $name, $price, $size, $image, $product_id);
        $stmt->execute();
    }
    public function delete($product_id){
        $query="DELETE FROM products WHERE product_id=?";
        $stmt=$this->conn->prepare($query);
        $stmt->bind_param('i',$product_id);
        $stmt->execute();

    }

    public function hello(){
        echo "hello";
    }
}
?>
