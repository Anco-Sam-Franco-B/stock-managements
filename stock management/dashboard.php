<?php
    session_start();
    if(empty($_SESSION['admin_info'])){
        header("Location: index.php");
    }
    include("./includes/configs/config.php");
    $page_title="Dashboard";
    include("./includes/pages/site/header.php");
    include("DATA_COUNT.php");
?>

<div class="box-card-warp">

    <div class="card">
        <div class="card-header">
            <h2>Total Stock In</h2>
            <i class="fas fa-arrow-up icon-dashboard"></i>
        </div>
        <div class="card-body">
            <b><?php echo number_format($totalStockIn) ?> PGs</b>
            <i class="fas fa-box icon-dashboard"></i>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Total Stock Out</h2>
            <i class="fas fa-external-link-alt icon-dashboard"></i>
        </div>
        <div class="card-body">
            <b><?php echo number_format($totalStockOut) ?> PGs</b>
            <i class="fas fa-box icon-dashboard"></i>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Total Stock</h2>
            <i class="fas fa-warehouse icon-dashboard"></i>
        </div>
        <div class="card-body">
            <b><?php echo number_format($totalStock) ?> PGs</b>
            <i class="fas fa-box icon-dashboard"></i>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Total Amount</h2>
            <i class="fas fa-money-bill icon-dashboard"></i>
        </div>
        <div class="card-body">
            <b><?php echo number_format($totalStockAmount) ?> Rwf</b>
            <i class="fas fa-wallet icon-dashboard"></i>
        </div>
    </div>
</div>

<br>

<div class="tables">
        <div class="table-header">
        <h1> <i class="fas fa-clock icon-table"></i> Recents Stock</h1>
        </div>
        <div class="table">
        <table>
        <tr>
            <th>Icon</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Total Price</th>
            <th>Stocked Date</th>
            <th>Option</th>
        </tr>
        <?php
            $stock_view=mysqli_query($con,"SELECT * FROM stock WHERE p_price ORDER BY p_total_price ASC LIMIT 3");
            while($rowStock=mysqli_fetch_assoc($stock_view)){
        ?>
        <tr>
                <td><i class="fas fab fa-box icon-td"></td>
                <td><?php echo $rowStock['p_code'] ?></td>
                <td><?php echo $rowStock['p_name'] ?></td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_quantity']) ?> PGs</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_price']) ?> Rwf</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_total_price']) ?> Rwf</td>
                <td style="text-align: center"><?php echo $rowStock['create_at'] ?></td>
                <td style="text-align: center">
                <a href="update.php?update_pcode=<?php echo $rowStock['p_code'] ?>" class="edit"> <i class="fas fab fa-edit"></i> </a>
                <a href="export.php?export_pcode=<?php echo $rowStock['p_code'] ?>" class="export"> <i class="fas fa-external-link-alt"></i> </a>
                <a href="delete.php?delete_p_code=<?php echo $rowStock['p_code'] ?>" class="delete"> <i class="fas fa-trash"></i> </a>
                </td>
        </tr>
        <?php
            }
        ?>
    </table> 

        </div>
        </div>

<br>
<div class="tables">
        <div class="table-header">
        <h1> <i class="fas fa-clock icon-table"></i> Recents Stock In</h1>
        </div>
        <div class="table">
        <table>
        <tr>
            <th>Icon</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Total Price</th>
            <th>Stocked Date</th>
            <th>Option</th>
        </tr>
        <?php
            $stock_view=mysqli_query($con,"SELECT * FROM stock_in  WHERE p_price ORDER BY p_total_price ASC LIMIT 3");
            while($rowStock=mysqli_fetch_assoc($stock_view)){
        ?>
        <tr>
                <td><i class="fas fab fa-box icon-td"></i> </td>
                <td><?php echo $rowStock['p_code'] ?></td>
                <td><?php echo $rowStock['p_name'] ?></td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_quantity']) ?> PGs</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_price']) ?> Rwf</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_total_price']) ?> Rwf</td>
                <td style="text-align: center"><?php echo $rowStock['create_at'] ?></td>
                <td style="text-align: center"> <a href="delete.php?delete_p=<?php echo $rowStock['p_code'] ?>" class="delete"> <i class="fas fa-trash"></i> </a></td> 
                </td>
        </tr>
        <?php
            }
        ?>
    </table>
        </div>
    </div>
    <br>

    <div class="tables">
        <div class="table-header">
        <h1> <i class="fas fa-clock icon-table"></i> Recents Stock Out</h1>
        </div>
        <div class="table">
        <table>
        <tr>
            <th>Icon</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Total Price</th>
            <th>Stocked Date</th>
            <th>Option</th>
        </tr>
        <?php
            $stock_view=mysqli_query($con,"SELECT * FROM stock_out  WHERE p_price ORDER BY p_total_price ASC LIMIT 3");
            while($rowStock=mysqli_fetch_assoc($stock_view)){
        ?>
        <tr>
                <td><i class="fas fab fa-box icon-td"></td>
                <td><?php echo $rowStock['p_code'] ?></td>
                <td><?php echo $rowStock['p_name'] ?></td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_quantity']) ?> PGs</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_price']) ?> Rwf</td>
                <td style="text-align: right"><?php echo number_format($rowStock['p_total_price']) ?> Rwf</td>
                <td style="text-align: center"><?php echo $rowStock['create_at'] ?></td>
                <td style="text-align: center"> <a href="delete.php?delete_ep=<?php echo $rowStock['p_code'] ?>" class="delete"> <i class="fas fa-trash"></i></a></td> 
                </td>
        </tr>
        <?php
            }
        ?>
    </table>

        </div>
    </div>
<?php
    include("./includes/pages/site/footer.php");
?>
