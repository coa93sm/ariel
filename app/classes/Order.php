<?php

class Order extends Cart{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }


    public function create($delivery_address){
        //echo "create seigjmsopdghs[gji";
        //var_dump($this->get_cart_items());
        //var_dump($delivery_address);
        $stmt=$this->conn->prepare("INSERT into orders (user_id,delivery_address) 
                                    values (?,?)");
        $stmt->bind_param("is",$_SESSION['user_id'],$delivery_address);
        $stmt->execute();
       
        $order_id=$this->conn->insert_id;
        $cart_items=$this->get_cart_items();
        //var_dump($order_id);
        //var_dump($cart_items);
        $stmt=$this->conn->prepare("insert into order_items (order_id, product_id,quantity) values (?,?,?)");
        //echo "dvolennnnnnnnnnn";
        //console.log($item['product_id']);
        foreach($cart_items as $item){
            $stmt->bind_param("iis",$order_id,$item['product_id'],$item['quantity']);
            $stmt->execute();
        }
        $this->destroy_cart();
    }

    public function get_orders(){
        $user_id=$_SESSION['user_id'];
        $sql="
            SELECT
                orders.order_id,
                orders.delivery_address,
                orders.created_at,
                order_items.quantity,
                products.name,
                products.size,
                products.image
            FROM orders
            INNER JOIN order_items ON orders.order_id=order_items.order_id
            INNER JOIN products On order_items.product_id=products.product_id
            WHERE orders.user_id=?
            ORDER BY orders.created_at DESC
        ";

        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();

        $result=$stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

//////////////////////////////////////////////////////////////////
    public function admin_get_orders(){
        $sql="SELECT * FROM `orders` INNER JOIN `users` ON users.user_id=orders.user_id;";
        //  $sql="SELECT orders.order_id,
        //              orders.delivery_address,
        //              orders.created_at,
        //              orders.user_id, 
        //              order_items.quantity, 
        //              products.name, 
        //              products.size, 
        //              products.image 
        //     FROM orders 
        //     INNER JOIN order_items 
        //     ON orders.order_id=order_items.order_id 
        //     INNER JOIN products 
        //     On order_items.product_id=products.product_id 
        //     ORDER BY orders.created_at DESC";
        $result=$this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function get_order_items($order_id){
        $user_id=$order_id;
        $sql="
            SELECT
                orders.order_id,
                orders.delivery_address,
                orders.created_at,
                order_items.quantity,
                products.name,
                products.price,
                products.size,
                products.image,
                users.user_id,
                users.name,
                users.email
            FROM orders
            INNER JOIN users ON users.user_id=orders.user_id
            INNER JOIN order_items ON orders.order_id=order_items.order_id
            INNER JOIN products On order_items.product_id=products.product_id
            WHERE orders.order_id=?
            ORDER BY orders.created_at DESC
        ";

        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param('i',$user_id);
        $stmt->execute();

        $result=$stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }


    
}
?>

<!--?php

class Order{
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }


    public function create($cart_items){

        var_dump($cart_items);

        
    }
}-->