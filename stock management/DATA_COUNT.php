<?php
        include("./includes/configs/config.php");

        //count total stock
        $stock=mysqli_query($con,"SELECT COUNT(*) as totalAll FROM stock");
        $FetchStock=mysqli_fetch_assoc($stock);
        $totalStock=$FetchStock['totalAll'];

                //count total stock in
                $stockIn=mysqli_query($con,"SELECT COUNT(*) as totalAllIn FROM stock_in");
                $FetchStockIn=mysqli_fetch_assoc($stockIn);
                $totalStockIn=$FetchStockIn['totalAllIn'];
        
        //count total stock out
        $stockOut=mysqli_query($con,"SELECT COUNT(*) as totalAllOut FROM stock_out");
        $FetchStockOut=mysqli_fetch_assoc($stockOut);
        $totalStockOut=$FetchStockOut['totalAllOut'];

        //count total amount of stock
        $stockAmount=mysqli_query($con,"SELECT SUM(p_total_price) as totalAmount FROM stock");
        $FetchStockAmount=mysqli_fetch_assoc($stockAmount);
        $totalStockAmount=$FetchStockAmount['totalAmount'];
        
?>