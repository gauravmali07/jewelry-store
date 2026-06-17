<?php include 'db_connect.php'; ?>

<?php

$qry = $conn->query("
    SELECT o.*,p.item_code,p.name as pname
    FROM order_items o
    INNER JOIN products p
    ON p.id = o.product_id
    WHERE o.order_id = {$_GET['id']}
");

$total = 0;

?>

<style>

:root{
    --gold:#d4af37;
}

.order-container{
    padding:10px;
}

.product-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:15px;
    margin-bottom:15px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.product-body{
    display:flex;
    align-items:center;
    padding:15px;
}

.product-image{
    width:120px;
    height:120px;
    flex-shrink:0;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #ddd;
    background:#fff;
}

.product-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.product-details{
    flex:1;
    padding-left:20px;
}

.product-details p{
    margin:6px 0;
    color:#212529 !important;
    font-size:15px;
}

.product-details strong{
    color:#000 !important;
}

.amount-box{
    text-align:right;
    min-width:150px;
}

.amount-label{
    color:#666;
    font-size:14px;
}

.amount{
    font-size:22px;
    font-weight:700;
    color:var(--gold);
}

.summary-card{
    background:#fff;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.summary-header{
    background:var(--gold);
    color:#fff;
    padding:15px;
    font-weight:700;
    text-align:center;
}

.summary-body{
    padding:25px;
}

.summary-total{
    font-size:28px;
    font-weight:700;
    color:#000;
    text-align:center;
}

.empty-msg{
    text-align:center;
    font-size:18px;
    color:#666;
    padding:30px;
}

.modal-close{
    margin-top:15px;
    text-align:right;
}

@media(max-width:768px){

    .product-body{
        flex-direction:column;
        text-align:center;
    }

    .product-details{
        padding-left:0;
        padding-top:15px;
    }

    .amount-box{
        text-align:center;
        margin-top:15px;
    }

}

</style>

<div class="container-fluid order-container">

    <div class="row">

        <div class="col-md-8">

            <?php if($qry->num_rows > 0): ?>

                <?php while($row = $qry->fetch_assoc()): ?>

                    <?php

                    $total += $row['qty'] * $row['price'];

                    $size = $conn->query("SELECT * FROM sizes WHERE id = {$row['size_id']}");
                    $size = $size->num_rows ? $size->fetch_assoc()['size'] : 'N/A';

                    $colour = $conn->query("SELECT * FROM colours WHERE id = {$row['colour_id']}");
                    $colour = $colour->num_rows ? $colour->fetch_assoc()['color'] : 'N/A';

                    $img = '';

                    if(is_dir('../assets/uploads/products/'.$row['item_code'])){

                        $files = scandir('../assets/uploads/products/'.$row['item_code']);

                        foreach($files as $f){

                            if(!in_array($f,['.','..'])){

                                $img = '../assets/uploads/products/'.$row['item_code'].'/'.$f;
                                break;
                            }
                        }
                    }

                    ?>

                    <div class="product-card">

                        <div class="product-body">

                            <div class="product-image">

                                <img src="<?php echo $img ?>" alt="Product">

                            </div>

                            <div class="product-details">

                                <p>
                                    <strong>Product:</strong>
                                    <?php echo $row['pname']; ?>
                                </p>

                                <p>
                                    <strong>Price:</strong>
                                    ₹<?php echo number_format($row['price'],2); ?>
                                </p>

                                <p>
                                    <strong>Size:</strong>
                                    <?php echo $size; ?>
                                </p>

                                <p>
                                    <strong>Color:</strong>
                                    <?php echo $colour; ?>
                                </p>

                                <p>
                                    <strong>Quantity:</strong>
                                    <?php echo $row['qty']; ?>
                                </p>

                            </div>

                            <div class="amount-box">

                                <div class="amount-label">
                                    Item Total
                                </div>

                                <div class="amount">

                                    ₹<?php echo number_format($row['qty'] * $row['price'],2); ?>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-msg">

                    No Order Items Found

                </div>

            <?php endif; ?>

        </div>

        <div class="col-md-4">

            <div class="summary-card">

                <div class="summary-header">

                    Order Summary

                </div>

                <div class="summary-body">

                    <div class="summary-total">

                        ₹<?php echo number_format($total,2); ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="modal-close">

        <button class="btn btn-secondary"
                data-dismiss="modal">

            Close

        </button>

    </div>

</div>
