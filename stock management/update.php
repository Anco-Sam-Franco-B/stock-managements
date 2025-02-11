<?php
    session_start();
    if(empty($_SESSION['admin_info'])){
        header("Location: index.php");
    }
    include("./includes/configs/config.php");
    $page_title="Update Item in Stock | Stock Management";
    include("./includes/pages/site/header.php");
?>
    <div class="form-box">
        <div class="form">
            <div class="form-header">
                <h1> <i class="fas fa-edit icon-form"></i> Update Item</h1>
            </div>

            <?php
        $getPcode=$_GET['update_pcode']; 
        $selectStock=mysqli_query($con,"SELECT * FROM stock WHERE p_code='$getPcode'");
        while($rowStock=mysqli_fetch_assoc($selectStock)){
    ?>
    <form action="" method="post">
            <input type="hidden" name="PCODE" placeholder="Product Code" value="<?php echo $rowStock['p_code'] ?>">
            <input type="text" name="p_code" placeholder="Product Code" value="<?php echo $rowStock['p_code'] ?>">
            <input type="text" name="p_name" placeholder="Product name" value="<?php echo $rowStock['p_name'] ?>">
            <input type="number" name="p_quantity" placeholder="Product quantity" value="<?php echo $rowStock['p_quantity'] ?>">
            <input type="number" name="p_price" placeholder="Product Price" value="<?php echo $rowStock['p_price'] ?>">
            <div class="btn">
                <button name="stock_update">Update Stock</button>
            </div>
    </form>
    <?php
        }
        if(isset($_POST['stock_update'])){
            $p_code=$_POST['p_code'];
            $PCODE=$_POST['PCODE'];
            $p_name=$_POST['p_name'];
            $p_quantity=$_POST['p_quantity'];
            $p_price=$_POST['p_price'];
            $total_price=$p_quantity * $p_price;
            if($p_code && $p_name && $p_quantity && $p_price){
                mysqli_query($con,"UPDATE stock SET p_code='$p_code', p_name='$p_name', p_quantity='$p_quantity', p_price='$p_price', p_total_price='$total_price' WHERE p_code='$PCODE'");
                echo'
                <script>
                    alert("product stock in updated!");
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