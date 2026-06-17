<?php include 'admin/db_connect.php' ?>
<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

/* Cart Item Card */

.list-group-item{
    border:none;
    border-radius:20px;
    margin-bottom:20px;
    padding:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
    transition:.3s;
}

.list-group-item:hover{
    transform:translateY(-5px);
}

/* Product Image */

.img-field{
    width:160px;
    height:160px;
    overflow:hidden;
    border-radius:15px;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
}

.img-field img{
    width:100%;
    height:100%;
    object-fit:cover;
}


/* ===========================
   QUANTITY INPUT FIX
=========================== */

.qty-input{

    width:70px !important;

    height:42px !important;

    text-align:center !important;

    background:#ffffff !important;

    color:#000000 !important;

    font-size:18px !important;

    font-weight:700 !important;

    border:2px solid #d4af37 !important;

}

.qty-input:focus{

    background:#ffffff !important;

    color:#000000 !important;

}

.qty-input::placeholder{
    color:#000 !important;
}

/* ===========================
   CHECKOUT MODAL FIX
=========================== */

#uni_modal .modal-content{

    background:#ffffff !important;

    color:#222 !important;

}

#uni_modal .modal-header{

    background:#d4af37 !important;

    color:#ffffff !important;

}

#uni_modal .modal-title{

    color:#ffffff !important;

    font-weight:700;
}

#uni_modal label{

    color:#222 !important;

    font-weight:600;
}

#uni_modal p{

    color:#444 !important;
}

#uni_modal textarea{

    background:#ffffff !important;

    color:#222 !important;

    border:2px solid #d4af37 !important;
}

#uni_modal input{

    background:#ffffff !important;

    color:#222 !important;
}

/* SAVE BUTTON */

#uni_modal .btn-primary{

    background:#d4af37 !important;

    border:none !important;

}

/* CANCEL BUTTON */

#uni_modal .btn-secondary{

    background:#6c757d !important;

    border:none !important;

}

/* Product Details */

.detail-field{
    flex:1;
    padding-left:20px;
}

.detail-field p{
    margin-bottom:10px;
    color:#555;
    font-size:15px;
}

.detail-field p b{
    color:#222;
}

/* Quantity Section */

.qty-input{
    width:70px;
    text-align:center;
    font-weight:600;
    border-radius:8px;
}

.btn-minus,
.btn-plus{
    background:var(--gold);
    border:none;
    color:#fff;
}

.btn-minus:hover,
.btn-plus:hover{
    background:var(--gold-dark);
}

/* Amount */

.amount-field{
    min-width:150px;
    display:flex;
    align-items:center;
    justify-content:center;
}

.amount{
    font-size:22px;
    color:var(--gold);
    font-weight:700;
}

/* Delete */

.rem_item{
    border-radius:50%;
}

/* Summary Card */

.card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.card-header{
    background:var(--gold) !important;
    color:#fff !important;
    font-size:18px;
    font-weight:600;
}

.card-body{
    padding:25px;
}

#tamount{
    color:var(--gold);
    font-size:32px;
    font-weight:700;
}

/* Checkout Button */

#checkout{
    background:var(--gold);
    border:none;
    color:#fff;
    border-radius:50px;
    height:55px;
    font-size:18px;
    font-weight:600;
    transition:.3s;
}

#checkout:hover{
    background:var(--gold-dark);
}

/* Empty Cart */

.empty-cart{
    background:#fff;
    padding:40px;
    border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.empty-cart h4{
    color:#888;
}

/* Remove Number Arrows */

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button{
    -webkit-appearance:none;
    margin:0;
}

/* Mobile */

@media(max-width:768px){

    .d-flex.w-100{
        flex-direction:column;
    }

    .img-field{
        width:100%;
        height:250px;
        margin-bottom:15px;
    }

    .detail-field{
        padding-left:0;
    }

    .amount-field{
        justify-content:flex-start;
        margin-top:15px;
    }

    .amount{
        font-size:24px;
    }
}

</style>

<div class="col-lg-12">	
    <?php 
    $qry = $conn->query("SELECT c.*,p.item_code,p.name as pname FROM cart c inner join products p on p.id = c.product_id where c.user_id ={$_SESSION['login_id']}");
    $total = 0;
    ?>
    <div class="row">
    <div class="col-md-8">
    	<?php if($qry->num_rows > 0): ?>
    		<ul class="list-group">
    			<?php 
    			while($row= $qry->fetch_array()):
    				$total += $row['qty']*$row['price'];
    				$size = $conn->query("SELECT * FROM sizes where id = {$row['size_id']}");
    				$size = $size->num_rows>0 ? $size->fetch_array()['size'] : 'N/A';
    				$colour = $conn->query("SELECT * FROM colours where id = {$row['colour_id']}");
    				$colour = $colour->num_rows>0 ? $colour->fetch_array()['color'] : 'N/A';
    				$img = array();
					if(isset($row['item_code']) && !empty($row['item_code'])):
			            if(is_dir('assets/uploads/products/'.$row['item_code'])):
			                $_fs = scandir('assets/uploads/products/'.$row['item_code']);
			              foreach($_fs as $k => $v):
				                if(is_file('assets/uploads/products/'.$row['item_code'].'/'.$v) && !in_array($v,array('.','..'))):
				                	$img[] = 'assets/uploads/products/'.$row['item_code'].'/'.$v;
								endif;
							endforeach;
						endif;
					endif;
    			?>
    			<li class="list-group-item" data-id="<?php echo $row['id'] ?>" data-price="<?php echo $row['price'] ?>">
    				<div class="d-flex w-100">
    					<div class="img-field mr-4 img-thumbnail rounded">
    						<img src="<?php echo isset($img[0]) ? $img[0] : '' ?>"  alt="" class="img-fluid rounded">
    					</div>
    					<div class="detail-field">
    						<p>Product Name: <b><?php echo $row['pname'] ?></b></p>
    						<p>Price: <b><?php echo number_format($row['price'],2) ?></b></p>
    						<p>Size: <b><?php echo $size ?></b></p>
    						<p>Color: <b><?php echo $colour ?></b></p>
    						<div class="d-flex col-sm-5">
					            <span class="btn btn-sm btn-info btn-flat btn-minus"><b><i class="fa fa-minus"></i></b></span>
					            <input type="number" name="qty" id="" class="form-control form-control-sm qty-input" value="<?php echo $row['qty'] ?>">
					            <span class="btn btn-sm btn-info btn-flat btn-plus"><b><i class="fa fa-plus"></i></b></span>
					        </div>
    					</div>
    					<div class="amount-field">
    						<b class="amount"><?php echo number_format($row['qty']*$row['price'],2) ?></b>
    					</div>
    				<span class="float-right"><button class="btn btn-sm btn-outline-danger rem_item" type="button"  data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button></span>
    				</div>
    			</li>
    		<?php endwhile; ?>
    		</ul>
    	<?php else: ?>
    		<center><b>No Item</b></center>
    	<?php endif; ?>
    </div>
    <div class="col-md-4">

    <?php if($qry->num_rows > 0): ?>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <b>Total Amount</b>
        </div>

        <div class="card-body">
            <h4 class="text-right">
                <b id="tamount">
                    <?php echo number_format($total,2) ?>
                </b>
            </h4>
        </div>
    </div>

    <button class="btn btn-block btn-primary"
            id="checkout"
            type="button">

        <i class="fa fa-credit-card"></i>
        Checkout

    </button>

    <?php else: ?>

    <div class="card shadow-sm border-0">
        <div class="card-body text-center py-5">

            <i class="fa fa-shopping-cart fa-4x text-muted mb-3"></i>

            <h4 class="text-muted">
                Your Cart is Empty
            </h4>

            <p class="text-secondary">
                Add products to continue shopping.
            </p>

            <a href="index.php"
               class="btn btn-warning">

                <i class="fa fa-store"></i>
                Continue Shopping

            </a>

        </div>
    </div>

    <?php endif; ?>

</div>
</div>
</div>
<script>
	$('.btn-minus').click(function(){
		start_load()
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
            var input = $(this).siblings('input')
            var id = $(this).closest('li').attr('data-id')
            $.ajax({
            	url:'admin/ajax.php?action=update_cart',
            	method:'POST',
            	data:{id:id,qty:qty},
            	success:function(resp){
            		if(resp == 1){
                		input.val(qty).trigger('change')
                		calc()
            			end_load()
            		}
            	}
            })
     })
     $('.btn-plus').click(function(){
		start_load()
        var qty = $(this).siblings('input').val()
            qty = parseInt(qty) + 1;
        var input = $(this).siblings('input')
        var id = $(this).closest('li').attr('data-id')
        $.ajax({
        	url:'admin/ajax.php?action=update_cart',
        	method:'POST',
        	data:{id:id,qty:qty},
        	success:function(resp){
        		if(resp == 1){
            		input.val(qty).trigger('change')
            		calc()
        			end_load()
        		}
        	}
        })
     })
     function calc(){
     	$('.qty-input').each(function(){
     		var li = $(this).closest('li')
     		var price = li.attr('data-price')
     		var qty = $(this).val()
     		var amount = parseFloat(qty) * parseFloat(price);
     		li.find('.amount').text(parseFloat(amount).toLocaleString('en-US',{style:"decimal",maximumFractionDigits:2,minimumFractionDigits:2}))
     	})
     	var total = 0;
     	$('.amount').each(function(){
     		var amount = $(this).text()
     			amount = amount.replace(/,/g,'');
     			total += parseFloat(amount)
     	})
     	$('#tamount').text(parseFloat(total).toLocaleString('en-US',{style:"decimal",maximumFractionDigits:2,minimumFractionDigits:2}))
     	load_cart()
     }
     $('.rem_item').click(function(){
     	_conf("Are you sure to remove this item from cart?","delete_cart",[$(this).attr('data-id')])
     })
     function delete_cart($id){
     	start_load()
     	$.ajax({
        	url:'admin/ajax.php?action=delete_cart',
        	method:'POST',
        	data:{id:$id},
        	success:function(resp){
        		if(resp == 1){
            		alert_toast("Item removed from cart","success");
        			setTimeout(function(){ location.reload() },750)
        		}
        	}
        })
     }
     $('#checkout').click(function(){
     	uni_modal('Chechkout',"manage_order.php");
     })
</script>
