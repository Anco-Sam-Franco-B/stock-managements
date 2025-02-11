<?php
    session_start();
    if(empty($_SESSION['admin_info'])){
        header("Location: index.php");
    }
    include("./includes/configs/config.php");
    $page_title="View Stock Reports | Stock Management System";
    include("./includes/pages/site/header.php");
?>

    <div class="tables">
        <div class="table-header">
        <h1> <i class="fas fa-list-ul icon-table"></i> View Stock Out Reports</h1>
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
            $stock_view=mysqli_query($con,"SELECT * FROM stock WHERE p_price ORDER BY p_total_price ASC");
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
        <?php
    include("./includes/pages/site/footer.php");
?>