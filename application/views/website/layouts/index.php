<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tea House - Tea Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/website') ?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/website') ?>/lib/owlcarousel/assets/website/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/website') ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/website') ?>/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.0/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js" integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .page-header {
            background: linear-gradient(rgba(136, 180, 78, .7), rgba(136, 180, 78, .7)), url(<?= base_url('assets/website') ?>/img/bg-lahan-sawit.jpg) center center no-repeat;
            background-size: cover;
        }

        .polygon-label {
            background-color: white;
            padding: 5px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
            color: black;
        }
    </style>
    <style>
        /* .leaflet-popup-content-wrapper,
    .leaflet-popup-tip {
        background: white;
        color: #333;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.4);
        width: 200px;
    } */

        .leaflet-popup-content {
            margin: 13px 24px 13px 20px;
            line-height: 1.3;
            font-size: 13px;
            font-size: 1.08333em;
            min-height: 1px;
            width: 200px;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <?php $this->load->view('website/layouts/navbar'); ?>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <?php $this->load->view($halaman); ?>

    <!-- Carousel End -->
    <?php $this->load->view('website/layouts/footer'); ?>




    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/website') ?>/lib/wow/wow.min.js"></script>
    <script src="<?= base_url('assets/website') ?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/website') ?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/website') ?>/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/website') ?>/js/main.js"></script>
</body>

</html>