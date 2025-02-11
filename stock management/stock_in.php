<?php
    session_start();
    include("./includes/configs/config.php");
    if(empty($_SESSION['admin_info'])){
        header("Location: index.php");
    }
    $page_title="Stock In | Stock Management System";
    include("./includes/pages/site/header.php");
?>
    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1> <i class="fas fa-arrow-up icon-form"></i> Stock in</h1>
            </div>
            <form action="" method="post">
        <input type="text" name="p_code" placeholder="Product Code">
        <input type="text" name="p_name" placeholder="Product name">
        <input type="number" name="p_quantity" placeholder="Product quantity">
        <input type="number" name="p_price" placeholder="Product Price">
        <div class="btn">
            <button name="stock_in">Stock in</button>
        </div>

        <?php
        if(isset($_POST['stock_in'])){
            $p_code=$_POST['p_code'];
            $p_name=$_POST['p_name'];
            $p_quantity=$_POST['p_quantity'];
            $p_price=$_POST['p_price'];

            if($p_code && $p_name && $p_quantity && $p_price){
                $total_price=$p_quantity * $p_price;
                $access_stock=mysqli_query($con,"SELECT * FROM stock WHERE p_code='$p_code'");
                $fetch_stock=mysqli_fetch_assoc($access_stock);
                if($fetch_stock['p_code']==$p_code){
                    $new_quantity=$fetch_stock['p_quantity'] + $p_quantity;
                    $newTotalPrice=$new_quantity * $p_price;
                    mysqli_query($con,"UPDATE stock SET p_quantity='$new_quantity', p_total_price='$newTotalPrice' WHERE p_code='$p_code'");
                    echo'
                        <script>
                            alert("product stocked!");
                            location.href="view_stock.php";
                        </script>
                    ';
                }
                else{
                    mysqli_query($con,"INSERT INTO stock VALUES('$p_code', '$p_name', '$p_quantity', '$p_price', '$total_price', NOW())");
                    echo'
                    <script>
                        alert("product stocked!");
                        location.href="view_stock.php";
                    </script>
                ';
                }
                mysqli_query($con,"INSERT INTO stock_in VALUES('$p_code', '$p_name', '$p_quantity', '$p_price', '$total_price', NOW())");
                echo'
                <script>
                    alert("product stocked!");
                    location.href="view_stock.php";
                </script>
            ';
        }
        else{
            echo'
                <script>
                    alert("All fields are required!");
                </script>
            ';
        }
        }
    ?>
    </form>
        </div>
    </div>
<?php
    include("./includes/pages/site/footer.php");
?>