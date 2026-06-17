<?php
include 'admin/db_connect.php';

$product = $conn->query("
SELECT p.*,c.name as cname,c.description as cdesc
FROM products p
LEFT JOIN categories c ON c.id = p.category_id
WHERE p.item_code = '{$_GET['c']}'
")->fetch_assoc();

foreach($product as $k => $v){
    $$k = $v;
}

$images = [];

$folder = "assets/uploads/products/".$item_code;

if(is_dir($folder)){
    foreach(scandir($folder) as $file){
        if(!in_array($file,['.','..'])){
            $images[] = $folder.'/'.$file;
        }
    }
}
?>

<style>

:root{
    --gold:#d4af37;
    --dark:#1f2937;
}

.product-wrapper{
    background:#fff;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.main-image{
    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:15px;
    border:1px solid #ddd;
}

.thumb{
    width:80px;
    height:80px;
    object-fit:cover;
    cursor:pointer;
    border:2px solid transparent;
    border-radius:10px;
}

.thumb.active{
    border-color:var(--gold);
}

.product-title{
    font-size:34px;
    font-weight:700;
    color:#222;
}

.product-category{
    color:#666;
    margin-bottom:20px;
}

.price-box{
    background:var(--gold);
    color:#fff;
    padding:15px;
    border-radius:10px;
    margin:20px 0;
}

.price-box h2{
    margin:0;
    color:#fff;
}

.custom-select,
#qty{
    color:#000;
    background:#fff;
}

.qty-box{
    display:flex;
    align-items:center;
    gap:10px;
     color:#222;
     background:#ffffff;
}

.qty-btn{
    width:45px;
    height:45px;
}

.cart-btn{
    background:var(--gold);
    border:none;
    color:#fff;
    padding:12px 30px;
    border-radius:30px;
    font-weight:600;
}

.cart-btn:hover{
    background:#b89322;
}


/* Quantity Input Fix */

#qty{

    width:80px !important;

    height:45px !important;

    text-align:center !important;

    background:#ffffff !important;

    color:#000000 !important;

    font-size:18px !important;

    font-weight:700 !important;

    border:2px solid #d4af37 !important;

}

/* Placeholder */

#qty::placeholder{
    color:#000 !important;
}

/* Bootstrap Override */

.form-control{
    color:#000 !important;
}

/* Quantity Box */

.qty-box{
    display:flex;
    align-items:center;
    gap:10px;
}

/* Buttons */

.qty-btn{
    width:50px;
    height:50px;
    border-radius:50%;
    background:#d4af37 !important;
    border:none !important;
    color:#fff !important;
    font-size:20px;
    font-weight:bold;
}

/* DROPDOWN FIX */

.product-dropdown{

    background:#ffffff !important;

    color:#000000 !important;

    border:2px solid #d4af37 !important;

    height:50px !important;

    font-weight:600 !important;
}

.product-dropdown option{

    background:#ffffff !important;

    color:#000000 !important;

}

/* FORCE ALL SELECTS */

select,
select option{

    color:#000 !important;

    background:#fff !important;

}

/* Fix AdminLTE */

.custom-select,
.custom-select option{

    color:#000 !important;

    background:#fff !important;

}


.description-card{
    margin-top:40px;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
}

.nav-tabs .nav-link.active{
    background:var(--gold);
    color:#fff;
    border:none;
}

</style>

<div class="container mt-4">

    <div class="product-wrapper">

        <div class="row">

            <div class="col-md-6">

                <img src="<?php echo $images[0] ?? ''; ?>"
                     id="mainImg"
                     class="main-image">

                <div class="d-flex mt-3 flex-wrap">

                    <?php foreach($images as $k=>$img): ?>

                    <img src="<?php echo $img; ?>"
                         class="thumb mr-2 mb-2 <?php echo $k==0?'active':''; ?>"
                         onclick="changeImage(this)">

                    <?php endforeach; ?>

                </div>

            </div>

            <div class="col-md-6">

                <h1 class="product-title">
                    <?php echo ucwords($name); ?>
                </h1>

                <p class="product-category">
                    Category :
                    <strong><?php echo $cname; ?></strong>
                </p>

                <div class="price-box">
                    <h2>
                        ₹ <?php echo number_format($price,2); ?>
                    </h2>
                </div>

                <div class="form-group">

                    <label>Size</label>

                   
<select id="size_id" class="form-control product-dropdown">


                        <?php
                        $sizes = $conn->query("
                        SELECT * FROM sizes
                        WHERE product_id = $id
                        ");

                        while($s=$sizes->fetch_assoc()):
                        ?>

                        <option value="<?php echo $s['id']; ?>">
                            <?php echo $s['size']; ?>
                        </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="form-group">

                    <label>Color</label>

                    
<select id="colour_id" class="form-control product-dropdown">



                        <?php
                        $colors = $conn->query("
                        SELECT * FROM colours
                        WHERE product_id = $id
                        ");

                        while($c=$colors->fetch_assoc()):
                        ?>

                        <option value="<?php echo $c['id']; ?>">
                            <?php echo $c['color']; ?>
                        </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <div class="qty-box mt-4">

                    <button class="btn btn-primary qty-btn"
                            id="minus">
                        -
                    </button>

                    <input type="number"
                           id="qty"
                           value="1"
                           min="1"
                           class="form-control"
                           style="width:80px">

                    <button class="btn btn-primary qty-btn"
                            id="plus">
                        +
                    </button>

                </div>

                <button class="cart-btn mt-4"
                        id="add_to_cart">

                    <i class="fa fa-shopping-cart"></i>
                    Add To Cart

                </button>

            </div>

        </div>

    </div>

    <div class="description-card">

        <ul class="nav nav-tabs">

            <li class="nav-item">

                <a class="nav-link active"
                   data-toggle="tab"
                   href="#desc">

                    Product Description

                </a>

            </li>

            <li class="nav-item">

                <a class="nav-link"
                   data-toggle="tab"
                   href="#catdesc">

                    Category Description

                </a>

            </li>

        </ul>

        <div class="tab-content mt-3">

            <div class="tab-pane fade show active"
                 id="desc">

                <?php echo html_entity_decode($description); ?>

            </div>

            <div class="tab-pane fade"
                 id="catdesc">

                <?php echo html_entity_decode($cdesc); ?>

            </div>

        </div>

    </div>

</div>

<script>

function changeImage(el){

    $('#mainImg').attr('src',$(el).attr('src'));

    $('.thumb').removeClass('active');

    $(el).addClass('active');

}

$('#plus').click(function(e){

    e.preventDefault();

    $('#qty').val(
        parseInt($('#qty').val()) + 1
    );

});

$('#minus').click(function(e){

    e.preventDefault();

    let qty = parseInt($('#qty').val());

    if(qty > 1){
        $('#qty').val(qty - 1);
    }

});

$('#add_to_cart').click(function(){

    $.ajax({

        url:'admin/ajax.php?action=add_to_cart',

        method:'POST',

        data:{
            product_id:'<?php echo $id; ?>',
            price:'<?php echo $price; ?>',
            qty:$('#qty').val(),
            size_id:$('#size_id').val(),
            colour_id:$('#colour_id').val()
        },

        success:function(resp){

            if(resp == 1){

                alert_toast(
                    'Added to cart successfully',
                    'success'
                );

                load_cart();

            }

        }

    });

});

</script>
