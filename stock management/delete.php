<?php
    include("./includes/configs/config.php");

    if($_GET['delete_p_code']){
    $getPCODE=$_GET['delete_p_code'];
    mysqli_query($con,"DELETE FROM stock WHERE p_code='$getPCODE'");
    header("Location: view_stock.php"); 
    }
    elseif($_GET['delete_p']){
        $getPCODES=$_GET['delete_p'];
        mysqli_query($con,"DELETE FROM stock_in WHERE p_code='$getPCODES'");
    header("Location: view_stock_in.php"); 
    }
    elseif($_GET['delete_ep']){
        $getPCODEXP=$_GET['delete_ep'];
        mysqli_query($con,"DELETE FROM stock_out WHERE p_code='$getPCODEXP'");
    header("Location: view_stock_out.php");
    }
?>