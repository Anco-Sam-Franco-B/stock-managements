<?php
    session_start();
    if(empty($_SESSION['admin_info'])){
        header("Location: index.php");
    }
    include("./includes/configs/config.php");
    $page_title="Stock Out | Stock Management";
    include("./includes/pages/site/header.php");
?>
    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1> <i class="fas fa-arrow-down icon-form"></i> Export Item</h1>
            </div>
            <?php
        $getPcode=$_GET['export_pcode'];
        $selectStock=mysqli_query($con,"SELECT * FROM stock WHERE p_code='$getPcode'");
        while($rowStock=mysqli_fetch_assoc($selectStock)){
    ?>
    <form action="" method="post">
            <input type="text" name="p_code" readonly placeholder="Product Code" value="<?php echo $rowStock['p_code'] ?>">
            <input type="text" name="p_name" readonly placeholder="Product name" value="<?php echo $rowStock['p_name'] ?>">
            <input type="number" name="p_quantity" placeholder="Product quantity" value="<?php echo $rowStock['p_quantity'] ?>">
            <input type="number" name="p_price" readonly placeholder="Product Price" value="<?php echo $rowStock['p_price'] ?>">
            <div class="btn">
                <button name="export_stock">Export Stock</button>
            </div>
    </form>
    <?php
        }
        if(isset($_POST['export_stock'])){
            $p_code=$_POST['p_code'];
            $p_name=$_POST['p_name'];
            $p_quantity=$_POST['p_quantity'];
            $p_price=$_POST['p_price'];
            if($p_code && $p_name && $p_quantity && $p_price){
                $access_stock=mysqli_query($con,"SELECT * FROM stock WHERE p_code='$p_code'");
                $fetch_stock=mysqli_fetch_assoc($access_stock);
                if($fetch_stock['p_quantity']!=0 &&  $fetch_stock['p_quantity']>0 && $fetch_stock['p_quantity']>=$p_quantity){
                    $remainQuantity=$fetch_stock['p_quantity'] - $p_quantity;
                    $newTotalPrice=$remainQuantity * $p_price;
                    $exportTotalPrice=$p_quantity * $p_price;
                    mysqli_query($con,"INSERT INTO stock_out VALUES('$p_code', '$p_name', '$p_quantity', '$p_price', '$exportTotalPrice', NOW())");
                    mysqli_query($con,"UPDATE stock SET p_quantity='$remainQuantity', p_total_price='$newTotalPrice' WHERE p_code='$p_code'");
                    echo'
                    <script>
                        alert("Product stocked out!");
                        location.href="view_stock_out.php";
                    </script>
                ';
                }
                else{
                    echo'
                    <script>
                        alert("Failed the product you want to export into stock the quantity you want doesn\'t available!");
                        location.href="view_stock.php";
                    </script>
                '; 
                }
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
            </div>
        </div>
<?php
    include("./includes/pages/site/footer.php");
?>
