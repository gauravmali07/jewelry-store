<?php
include 'admin/db_connect.php';

$total = 0;

$order_items = $conn->query("
    SELECT o.*, p.name AS pname, p.item_code
    FROM order_items o
    INNER JOIN products p ON p.id = o.product_id
    WHERE o.order_id = {$_GET['id']}
");
?>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

/* Product Card */

.order-item{
    border:none;
    border-radius:15px;
    margin-bottom:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    overflow:hidden;
}

.product-img{
    width:120px;
    height:120px;
    object-fit:cover;
    border-radius:10px;
}

.product-details p{
    margin-bottom:6px;
    color:#555;
}

.product-details b{
    color:#222;
}

/* Amount */

.product-amount{
    font-size:20px;
    font-weight:700;
    color:var(--gold);
}

/* Summary */

.summary-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.summary-header{
    background:var(--gold);
    color:#fff;
    text-align:center;
    padding:15px;
    font-size:18px;
    font-weight:700;
}

.summary-body{
    padding:25px;
    text-align:center;
}

.total-amount{
    font-size:35px;
    font-weight:700;
    color:#28a745;
}

/* Modal Footer */

#uni_modal .modal-footer{
    display:none;
}

#uni_modal .modal-footer.display{
    display:flex;
}

</style>

<div class="container-fluid">

    <div class="row">

        <!-- Products -->

        <div class="col-md-8">

            <?php if($order_items->num_rows > 0): ?>

                <?php while($row = $order_items->fetch_assoc()): ?>

                    <?php

                    $total += $row['qty'] * $row['price'];

                    $size = "N/A";
                    $color = "N/A";

                    $size_qry = $conn->query("SELECT * FROM sizes WHERE id = {$row['size_id']}");
                    if($size_qry->num_rows > 0){
                        $size = $size_qry->fetch_assoc()['size'];
                    }

                    $color_qry = $conn->query("SELECT * FROM colours WHERE id = {$row['colour_id']}");
                    if($color_qry->num_rows > 0){
                        $color = $color_qry->fetch_assoc()['color'];
                    }

                    $image = '';

                    $folder = 'assets/uploads/products/'.$row['item_code'];

                    if(is_dir($folder)){
                        $files = scandir($folder);

                        foreach($files as $file){

                            if($file != '.' && $file != '..'){

                                $image = $folder.'/'.$file;
                                break;
                            }
                        }
                    }

                    ?>

                    <div class="card order-item">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-3 text-center">

                                    <img src="<?php echo $image ?>"
                                         class="product-img">

                                </div>

                                <div class="col-md-6 product-details">

                                    <p>
                                        Product :
                                        <b><?php echo $row['pname'] ?></b>
                                    </p>

                                    <p>
                                        Price :
                                        <b>₹ <?php echo number_format($row['price'],2) ?></b>
                                    </p>

                                    <p>
                                        Size :
                                        <b><?php echo $size ?></b>
                                    </p>

                                    <p>
                                        Color :
                                        <b><?php echo $color ?></b>
                                    </p>

                                    <p>
                                        Quantity :
                                        <b><?php echo $row['qty'] ?></b>
                                    </p>

                                </div>

                                <div class="col-md-3 text-center">

                                    <div class="product-amount">

                                        ₹ <?php echo number_format($row['qty'] * $row['price'],2) ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="alert alert-warning text-center">

                    No products found.

                </div>

            <?php endif; ?>

        </div>

        <!-- Summary -->

        <div class="col-md-4">

            <div class="summary-card">

                <div class="summary-header">

                    Order Summary

                </div>

                <div class="summary-body">

                    <h6 class="text-muted">
                        Total Amount
                    </h6>

                    <div class="total-amount">

                        ₹ <?php echo number_format($total,2) ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal-footer display">

    <button type="button"
            class="btn btn-secondary"
            data-dismiss="modal">

        Close

    </button>

</div>