<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Tentang Kami</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- 404 Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 50vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h1 class="display-4"><?= $sejarah->title ?></h1>
                <p class="mb-4"><?= $sejarah->content ?></p>
            </div>
            <div class="col-lg-12">
                <h1 class="display-4"><?= $visi->title ?></h1>
                <p class="mb-4"><?= $visi->content ?></p>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->