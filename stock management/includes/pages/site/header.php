<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?></title>
    <link rel="stylesheet" href="./assest/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./assest/css/ccc.css">
</head>
<body>
    <div class="container">
        <div class="nav">
            <div class="nav-header">
                <h1> <i class="fas fa-warehouse icon-logo"></i> Stock <br> Management</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                    <li><a href="stock_in.php"><i class="fas fa-arrow-up"></i>Stock in</a></li>
                    
                    <hr>
                    <label>Rerpot Management</label>
                    <li><a href="view_stock.php"><i class="fas fa-warehouse"></i>Stock Reports</a></li>
                    <li><a href="view_stock_in.php"><i class="fas fa-list"></i>Stock In Reports</a></li>
                    <li><a href="view_stock_out.php"><i class="fas fa-list"></i>Stock Out Reports</a></li>
                    <hr>
                    <label>Admin Option</label>
                    <li><a href="logout.php"> <i class="fas fa-sign-out-alt"></i>Log Out</a></li>
                </ul>
            </nav>
        </div>
        <div class="contents">
