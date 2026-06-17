<?php
include 'db_connect.php';

$qry = $conn->query(
    "SELECT * FROM orders WHERE id = {$_GET['id']}"
)->fetch_array();

foreach($qry as $key => $value){
    $$key = $value;
}
?>

<style>

.order-card{
    padding:20px;
}

.order-title{
    font-size:22px;
    font-weight:700;
    color:#1f2937;
    margin-bottom:20px;
    text-align:center;
}

.form-label{
    font-weight:600;
    color:#1f2937;
    margin-bottom:8px;
}

.custom-select{
    height:50px !important;
    font-size:16px !important;
    color:#000 !important;
    background:#fff !important;
    border:2px solid #d4af37;
    border-radius:10px;
}

.custom-select:focus{
    border-color:#d4af37;
    box-shadow:0 0 10px rgba(212,175,55,.25);
}

.status-info{
    margin-top:10px;
    color:#6c757d;
    font-size:14px;
}

</style>

<div class="container-fluid">

    <div class="order-card">

        <h4 class="order-title">

            Update Order Status

        </h4>

        <form id="update-order">

            <input type="hidden"
                   name="id"
                   value="<?php echo $id ?>">

            <div class="form-group">

                <label class="form-label">

                    Order Status

                </label>

                <select name="status"
                        id="status"
                        class="custom-select">

                    <option value="0"
                        <?php echo ($status == 0) ? 'selected' : ''; ?>>
                        Pending
                    </option>

                    <option value="1"
                        <?php echo ($status == 1) ? 'selected' : ''; ?>>
                        Verified
                    </option>

                    <option value="2"
                        <?php echo ($status == 2) ? 'selected' : ''; ?>>
                        Shipped
                    </option>

                    <option value="3"
                        <?php echo ($status == 3) ? 'selected' : ''; ?>>
                        Delivered
                    </option>

                    <option value="4"
                        <?php echo ($status == 4) ? 'selected' : ''; ?>>
                        Cancelled
                    </option>

                </select>

                <small class="status-info">

                    Select the current status of this order.

                </small>

            </div>

        </form>

    </div>

</div>

<script>

$(document).ready(function(){

    $('#update-order').submit(function(e){

        e.preventDefault();

        start_load();

        $.ajax({

            url:'ajax.php?action=update_order',

            data:new FormData(this),

            cache:false,

            contentType:false,

            processData:false,

            method:'POST',

            success:function(resp){

                if(resp == 1){

                    alert_toast(
                        "Order status updated successfully",
                        "success"
                    );

                    setTimeout(function(){

                        location.reload();

                    },1000);

                }

            }

        });

    });

});

</script>
