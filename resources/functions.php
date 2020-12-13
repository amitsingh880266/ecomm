<?php

    function set_message($msg){
        if(!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            $msg = "";
        }
    }

    function display_message(){
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
    }

    function redirect($location){
        header("Location: $location");
    }

    function query($sql){
        global $connection;

        return mysqli_query($connection,$sql);
    }

    function confirm($result){
        global $connection;
        if(!$result){
            die("Query Failed".mysqli_error($connection));
        }
    }
    function escape_string($string){
        global $connection;
        return mysqli_real_escape_string($connection,$string);
    }

    function fetch_array($result){
        return mysqli_fetch_array($result);
    }
    /********************************************Front End Functions************************************************** */

    // get products

    function get_products(){
        $query = query("SELECT *FROM products");
        confirm($query);
        while($row = fetch_array($query)){
            $products = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                <a href="item.php?id={$row['product_id']}"><img style="height:200px;width:240px" src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h4 class="pull-right">&#8377;{$row['product_price']}</h4><br>
                        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p>{$row['shor_desc']}</p>
                        <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a>    
                    </div>
                </div>
            </div>
        DELIMETER;
            echo $products;
        }
    }

    function get_categories(){
        $query = query("SELECT * FROM categories");
        confirm($query);
        while($row = mysqli_fetch_array($query)){
            
            $category_links = <<<DELIMETER
            <a href='category.php?id={$row['cat_id']}' class = 'list-group-item'>{$row['cat_title']}</a>

            DELIMETER;

            echo $category_links;

        }
    }
    function get_products_in_cat_page(){
        $query = query("SELECT *FROM products WHERE product_category_id =".escape_string($_GET['product_category_id'])."");
        confirm($query);
        while($row = fetch_array($query)){
            $products = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img style="height:200px;width:240px"src="{$row['product_image']}" alt="">
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>{$row['shor_desc']}</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        DELIMETER;
            echo $products;
        }
    }

    function get_products_in_shop_page(){
        $query = query("SELECT *FROM products");
        confirm($query);
        while($row = fetch_array($query)){
            $products = <<<DELIMETER
            <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img style="height:200px;width:240px"src="{$row['product_image']}" alt="">
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>{$row['shor_desc']}</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>

        DELIMETER;
            echo $products;
        }
    }

    function login_user(){
    if(isset($_POST['submit'])){    
        $usermail = escape_string($_POST['useremail']);
        $userpass = escape_string($_POST['password']);

        $query = query("SELECT * FROM user WHERE Email = '{$usermail}' AND PASSWORD = '{$userpass}'");
        confirm($query);
    
   
            if(mysqli_fetch_array($query)==0){
                set_message("Your Password or Username are wrong");
                redirect("login.php");
            }
            else{
                $_SESSION['username'] = $usermail;
                set_message("Welcome to Admin ");
                redirect("admin");
            }

        }
    }

    function send_message(){
        if(isset($_POST['submit'])){
            $to = "amitsingh880266@gmail.com";
            $from_name = $_POST['name'];
            $subject = $_POST['subject'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $headers = "From :{$from_name} {$email}";

            $result = mail($to,$subject,$message,$headers);
            if(!$result){
                echo "ERROR";
            }else{
                echo "SENT";
            }
        }
    }
    




































    /*******************************************Back End Functions************************************************** */
?>