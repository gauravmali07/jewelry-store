<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include 'header.php';
?>

<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">

<style>

:root{
    --gold:#d4af37;
    --gold-dark:#b89322;
}

/* Page */

body{
    background:#f8f9fa;
}

.content-wrapper{
    background:#f8f9fa;
    min-height:100vh;
}

/* Container */

.container-md{
    max-width:1200px;
}

/* Divider */

.border-primary{
    border:0;
    height:2px;
    background:linear-gradient(
        to right,
        transparent,
        var(--gold),
        transparent
    );
}

/* Toast */

#alert_toast{
    position:fixed;
    top:20px;
    right:20px;
    z-index:99999;
    min-width:320px;
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
}

.toast-body{
    background:#fff;
    color:#333;
    font-weight:600;
}

/* Modals */

.modal-content{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.modal-header{
    background:var(--gold);
    color:#fff;
    border:none;
}

.modal-title{
    font-weight:600;
}

.modal-footer{
    border:none;
}

.modal-footer .btn-primary{
    background:var(--gold);
    border:none;
    border-radius:30px;
}

.modal-footer .btn-primary:hover{
    background:var(--gold-dark);
}

.modal-footer .btn-secondary{
    border-radius:30px;
}

/* Viewer */

#viewer_modal .modal-content{
    background:transparent;
    box-shadow:none;
}

#viewer_modal img{
    width:100%;
    border-radius:15px;
}

.btn-close{
    position:absolute;
    top:10px;
    right:10px;
    z-index:99;
    background:#fff;
    border-radius:50%;
}

/* Footer */

.main-footer{
    background:#ffffff;
    border-top:2px solid var(--gold);
    color:#555;
    padding:15px 20px;
}

.main-footer strong{
    color:#333;
}

.main-footer b{
    color:var(--gold);
}

/* Buttons */

.btn-primary{
    background:var(--gold)!important;
    border:none!important;
}

.btn-primary:hover{
    background:var(--gold-dark)!important;
}

</style>

<div class="wrapper">

    <?php include 'topbar.php'; ?>

    <div class="content-wrapper">

        <!-- Toast -->

        <div class="toast"
             id="alert_toast"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">

            <div class="toast-body"></div>

        </div>

        <div id="toastsContainerTopRight"
             class="toasts-top-right fixed">
        </div>

        <!-- Header -->

        <div class="content-header">

            <div class="container-md">

                <div class="row mb-2">

                    <div class="col-sm-12">
                    </div>

                </div>

                <hr class="border-primary">

            </div>

        </div>

        <!-- Content -->

        <section class="content">

            <div class="container-md">

                <?php
                $page = isset($_GET['page'])
                    ? $_GET['page']
                    : 'home';

                include $page.'.php';
                ?>

            </div>

        </section>

        <!-- Confirm Modal -->

        <div class="modal fade"
             id="confirm_modal"
             tabindex="-1">

            <div class="modal-dialog modal-md">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirmation
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div id="delete_content"></div>
                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-primary"
                                id="confirm">
                            Continue
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                            Close
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Universal Modal -->

        <div class="modal fade"
             id="uni_modal">

            <div class="modal-dialog modal-md">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                    </div>

                    <div class="modal-body"></div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-primary"
                                id="submit"
                                onclick="$('#uni_modal form').submit()">
                            Save
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                            Cancel
                        </button>

                    </div>

                </div>

            </div>

        </div>

        <!-- Right Modal -->

        <div class="modal fade"
             id="uni_modal_right">

            <div class="modal-dialog modal-full-height modal-md">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title"></h5>

                        <button type="button"
                                class="close"
                                data-dismiss="modal">

                            <span class="fa fa-arrow-right"></span>

                        </button>

                    </div>

                    <div class="modal-body"></div>

                </div>

            </div>

        </div>

        <!-- Image Viewer -->

        <div class="modal fade"
             id="viewer_modal">

            <div class="modal-dialog modal-md">

                <div class="modal-content">

                    <button type="button"
                            class="btn-close"
                            data-dismiss="modal">

                        <span class="fa fa-times"></span>

                    </button>

                    <img src="" alt="">

                </div>

            </div>

        </div>

    </div>

    <!-- Footer -->

    <footer class="main-footer">

    <strong>
        © <?php echo date("Y"); ?> Online Jewelry Store.
        All Rights Reserved.
    </strong>

    <div class="float-right d-none d-sm-inline-block">
        <b>Luxury Jewelry Collection</b>
    </div>

</footer>

</div>

<?php include 'footer.php'; ?>

</body>
</html>