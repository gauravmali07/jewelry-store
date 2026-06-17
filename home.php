<?php include('admin/db_connect.php') ?>


<div class="col-lg-12" id="products">
    <div class="row">

        <!-- ================== CATEGORY SIDEBAR ================== -->
        <div class="col-md-3">
            <div class="card shadow-sm rounded">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <h4 class="mb-0">Categories</h4>
                    <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <?php  
                        $category = $conn->query("SELECT * FROM categories ORDER BY name ASC");
                        while($row = $category->fetch_assoc()):
                            $cname[$row['id']] = ucwords($row['name']);
                        ?>
                        <li class="list-group-item d-flex align-items-center">
                            <input type="checkbox" id="cat<?php echo $row['id'] ?>" 
                                   class="cat-filter mr-2" 
                                   value="<?php echo $row['id'] ?>">
                            <label for="cat<?php echo $row['id'] ?>" class="mb-0">
                                <?php echo ucwords($row['name']) ?>
                            </label>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ================== PRODUCT SECTION ================== -->
        <div class="col-md-9">

            <div class="text-center my-4">
                <h2 class="text-gradient">Welcome to Our Jewelry Webstore</h2>
            </div>

            <!-- SEARCH BAR -->
            <div class="input-group mb-4">
                <input type="text" id="filter" class="form-control form-control-lg" 
                       placeholder="Search for products...">
                <div class="input-group-append">
                    <button id="search" class="btn btn-lg btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- ================== PRODUCT GRID (4 COLUMNS) ================== -->
            <div class="product-grid">

                <?php
                $products = $conn->query("SELECT * FROM products ORDER BY RAND()");
                while($row = $products->fetch_assoc()):

                    /* ---------------- IMAGE HANDLING ---------------- */
                    $img = [];
                    $folder = 'assets/uploads/products/'.$row['item_code'];

                    if(is_dir($folder)){
                        foreach(scandir($folder) as $f){
                            if(!in_array($f, ['.', '..']) && is_file("$folder/$f")){
                                $img[] = "$folder/$f";
                            }
                        }
                    }

                    /* ---------------- CLEAN & SHORT DESCRIPTION ---------------- */
                    $desc = strip_tags(html_entity_decode($row["description"]));
                    $desc = str_replace(["\n", "\r", "\t"], "", $desc);
                    $desc = strlen($desc) > 60 ? substr($desc, 0, 60) . "..." : $desc;

                ?>

                <a class="prod-item"
                   href="./index.php?page=view_product&c=<?php echo $row['item_code'] ?>"
                   target="_blank"
                   data-cat="<?php echo $row['category_id'] ?>">

                    <div class="product-card">
                        <div class="product-img">
                            <img src="<?php echo $img[0] ?? 'assets/default_product.jpg' ?>" alt="Product">
                        </div>

                        <div class="product-info">
                            <h5 class="product-title"><?php echo $row['name'] ?></h5>
                            <p class="product-category">
                                <?php echo $cname[$row['category_id']] ?? '' ?>
                            </p>
                            <p class="product-desc"><?php echo $desc ?></p>
                            <p class="product-price">₹ <?php echo number_format($row['price'],2) ?></p>
                        </div>
                    </div>

                </a>

                <?php endwhile; ?>

            </div>
        </div>
    </div>
</div>

<!-- ================== CSS (FULL CLEAN VERSION) ================== -->
<style>
    body {
        background: #f7fbff;
        font-family: Arial, sans-serif;
    }

    .text-gradient {
        background: linear-gradient(to right, #007bff, #444);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* GRID STRUCTURE */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
    }

    /* CARD DESIGN */
    .product-card {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        padding-bottom: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: 0.25s;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    /* IMAGE AREA */
    .product-img {
        height: 200px;
        background: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .product-img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    /* INFO AREA */
    .product-info {
        text-align: center;
        padding: 15px;
    }

    .product-title {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
    }

    .product-category {
        font-size: 13px;
        color: #666;
        margin-bottom: 8px;
    }

    .product-desc {
        font-size: 14px;
        color: #444;
        min-height: 40px;
    }

    .product-price {
        color: #d9534f;
        font-size: 18px;
        font-weight: bold;
        margin-top: 10px;
    }

    /* RESPONSIVENESS */
    @media (max-width: 992px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ================== JAVASCRIPT (CLEAN FILTER SYSTEM) ================== -->
<script>

    /* HOVER EFFECT */
    $('.prod-item').hover(
        function(){ $(this).find('.product-card').addClass('shadow-lg'); },
        function(){ $(this).find('.product-card').removeClass('shadow-lg'); }
    );

    /* SEARCH + CATEGORY FILTER */
    $('.cat-filter').change(function(){ filterProducts(); });
    $('#search').click(function(){ filterProducts(); });
    $('#filter').on('keyup search', function(){ filterProducts(); });

    function filterProducts() {
        let searchText = $('#filter').val().toLowerCase();
        let selectedCats = $('.cat-filter:checked').map(function(){
            return $(this).val();
        }).get();

        $('.prod-item').each(function() {
            let matchesSearch = $(this).text().toLowerCase().includes(searchText);
            let matchesCat = selectedCats.length === 0 || selectedCats.includes($(this).data('cat').toString());

            $(this).toggle(matchesSearch && matchesCat);
        });
    }

</script>