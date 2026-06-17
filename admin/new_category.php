<div class="container-fluid">

    <div class="card shadow-lg border-0">

        <div class="card-header bg-gold text-white">

            <h4 class="mb-0">
                <i class="fas fa-tags"></i>
                Category Management
            </h4>

        </div>

        <div class="card-body">

            <form id="manage-category">

                <input type="hidden"
                       name="id"
                       value="<?php echo isset($id) ? $id : '' ?>">

                <div class="form-group">

                    <label class="font-weight-bold text-dark">

                        Category Name

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control custom-input"
                           placeholder="Enter Category Name"
                           value="<?php echo isset($name) ? $name : '' ?>"
                           required>

                </div>

                <div class="form-group">

                    <label class="font-weight-bold text-dark">

                        Description

                    </label>

                    <textarea name="description"
                              rows="8"
                              class="summernote form-control custom-input"><?php echo isset($description) ? $description : '' ?></textarea>

                </div>

                <div class="text-center mt-4">

                    <button type="submit"
                            class="btn btn-save">

                        <i class="fas fa-save"></i>
                        Save Category

                    </button>

                    <a href="index.php?page=category_list"
                       class="btn btn-cancel">

                        <i class="fas fa-times"></i>
                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
    --dark:#1f2937;
}

/* Card */

.card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.bg-gold{
    background:var(--gold);
    color:#fff;
}

/* Labels */

label{
    color:#222 !important;
    font-weight:600;
    font-size:15px;
}

/* Inputs */

.custom-input,
.form-control{
    background:#ffffff !important;
    color:#000000 !important;
    border:1px solid #ced4da !important;
    border-radius:12px;
    min-height:48px;
}

.custom-input:focus,
.form-control:focus{
    background:#ffffff !important;
    color:#000000 !important;
    border-color:var(--gold) !important;
    box-shadow:0 0 10px rgba(212,175,55,.25) !important;
}

/* Placeholder */

.form-control::placeholder{
    color:#6c757d !important;
}

/* Summernote Fix */

.note-editor{
    border:1px solid #ced4da !important;
    border-radius:12px !important;
}

.note-toolbar{
    background:#f8f9fa !important;
}

.note-editing-area{
    background:#ffffff !important;
}

.note-editor .note-editable{
    background:#ffffff !important;
    color:#000000 !important;
    min-height:250px !important;
}

.note-editor .note-editable p,
.note-editor .note-editable span,
.note-editor .note-editable div,
.note-editor .note-editable li{
    color:#000000 !important;
}

/* Buttons */

.btn-save{
    background:var(--gold);
    color:#fff;
    border:none;
    padding:12px 30px;
    border-radius:30px;
    font-weight:600;
}

.btn-save:hover{
    background:var(--gold-dark);
    color:#fff;
}

.btn-cancel{
    background:#6c757d;
    color:#fff;
    border:none;
    padding:12px 30px;
    border-radius:30px;
    margin-left:10px;
}

.btn-cancel:hover{
    background:#545b62;
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
                    'Category saved successfully',
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