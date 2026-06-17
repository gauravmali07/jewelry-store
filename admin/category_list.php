<?php include 'db_connect.php'; ?>

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h2 class="font-weight-bold text-dark">
                Category List
            </h2>

        </div>

        <div class="col-md-6 text-right">

            <a href="./index.php?page=new_category"
               class="btn btn-gold">

                <i class="fa fa-plus"></i>
                Add New Category

            </a>

        </div>

    </div>

    <div class="card shadow border-0">

        <div class="card-header bg-white">

            <h4 class="mb-0 text-dark font-weight-bold">
                Category Management
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered"
                       id="categoryTable">

                    <thead>

                        <tr>

                            <th width="8%">#</th>
                            <th width="25%">Category Name</th>
                            <th width="47%">Description</th>
                            <th width="20%">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    $i = 1;

                    $qry = $conn->query("
                        SELECT *
                        FROM categories
                        ORDER BY date_created DESC
                    ");

                    while($row = $qry->fetch_assoc()):

                    ?>

                        <tr>

                            <td class="text-center">

                                <?php echo $i++; ?>

                            </td>

                            <td>

                                <strong>
                                    <?php echo ucwords($row['name']); ?>
                                </strong>

                            </td>

                            <td>

                                <?php
                                echo substr(
                                    strip_tags(
                                        html_entity_decode(
                                            $row['description']
                                        )
                                    ),
                                    0,
                                    120
                                );
                                ?>

                            </td>

                            <td class="text-center">

                                <a href="./index.php?page=edit_category&id=<?php echo $row['id']; ?>"
                                   class="btn btn-warning btn-sm mr-1">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button type="button"
                                        class="btn btn-danger btn-sm delete_category"
                                        data-id="<?php echo $row['id']; ?>">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<style>

:root{
    --gold:#d4af37;
}

body{
    background:#f4f6f9;
}

.card{
    border-radius:15px;
}

.card-header{
    border-bottom:2px solid var(--gold);
}

.btn-gold{
    background:var(--gold);
    color:#fff;
    border:none;
    font-weight:600;
    padding:10px 20px;
    border-radius:30px;
}

.btn-gold:hover{
    background:#b89322;
    color:#fff;
}

.table{
    background:#fff;
}

.table thead{
    background:linear-gradient(
        to right,
        #d4af37,
        #c6b37d
    );
    color:#fff;
}

.table td,
.table th{
    vertical-align:middle;
    color:#212529 !important;
}

.dataTables_filter input{
    border:1px solid #ccc;
    border-radius:8px;
    padding:5px 10px;
    color:#000 !important;
}

.dataTables_length select{
    color:#000 !important;
}

.dataTables_info,
.dataTables_paginate{
    color:#000 !important;
}

.btn-warning{
    background:#d4af37;
    border:none;
    color:#fff;
}

.btn-warning:hover{
    background:#b89322;
}

</style>

<script>

$(document).ready(function(){

    $('#categoryTable').DataTable();

    $('.delete_category').click(function(){

        _conf(
            "Are you sure you want to delete this category?",
            "delete_category",
            [$(this).attr('data-id')]
        );

    });

});

function delete_category(id){

    start_load();

    $.ajax({

        url:'ajax.php?action=delete_category',

        method:'POST',

        data:{id:id},

        success:function(resp){

            if(resp == 1){

                alert_toast(
                    "Category deleted successfully",
                    "success"
                );

                setTimeout(function(){

                    location.reload();

                },1000);

            }

        }

    });

}

</script>