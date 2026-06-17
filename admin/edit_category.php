<?php

include 'db_connect.php';

$id = '';

$name = '';

$description = '';

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $qry = $conn->query(
        "SELECT * FROM categories WHERE id = $id"
    );

    if($qry->num_rows > 0){

        $row = $qry->fetch_assoc();

        $name = $row['name'];
        $description = $row['description'];

    }

}
?>

<div class="container-fluid">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-warning">

            <h4 class="text-white mb-0">

                <i class="fas fa-edit"></i>

                Edit Category

            </h4>

        </div>

        <div class="card-body">

            <form id="manage-category">

                <input type="hidden"
                       name="id"
                       value="<?php echo $id ?>">

                <div class="form-group">

                    <label>

                        Category Name

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="<?php echo $name ?>"
                           required>

                </div>

                <div class="form-group">

                    <label>

                        Description

                    </label>

                    <textarea name="description"
                              rows="8"
                              class="form-control summernote"><?php echo $description ?></textarea>

                </div>

                <div class="text-center mt-4">

                    <button type="submit"
                            class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update Category

                    </button>

                    <a href="index.php?page=category_list"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left"></i>

                        Back

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

.card{
    border-radius:15px;
}

.card-header{
    border-radius:15px 15px 0 0 !important;
}

.form-control{
    background:#fff !important;
    color:#000 !important;
    border:1px solid #ced4da;
}

.form-control:focus{
    color:#000 !important;
    background:#fff !important;
}

label{
    font-weight:600;
    color:#212529 !important;
}

.note-editor{
    background:#fff !important;
}

.note-editable{
    background:#fff !important;
    color:#000 !important;
    min-height:180px;
}

.note-editable p,
.note-editable span,
.note-editable div{
    color:#000 !important;
}

.btn-warning{
    color:#fff;
}

</style>

<script>

$('#manage-category').submit(function(e){

    e.preventDefault();

    start_load();

    $.ajax({

        url:'ajax.php?action=save_category',

        data:new FormData(this),

        cache:false,

        contentType:false,

        processData:false,

        method:'POST',

        success:function(resp){

            if(resp == 1){

                alert_toast(
                    'Category updated successfully',
                    'success'
                );

                setTimeout(function(){

                    location.href =
                    'index.php?page=category_list';

                },1500);

            }

        }

    });

});

</script>