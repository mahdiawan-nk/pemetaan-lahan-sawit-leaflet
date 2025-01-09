<div class="container-fluid bg-white sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <!-- <img class="img-fluid" src="img/logo.png" alt="Logo"> -->
                <h1 class="m-2">PT MITRA BUMI</h1>
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="<?=base_url('')?>" class="nav-item nav-link <?= ($this->uri->segment(1) == '') ? 'active' : '' ?>">Home</a>
                    <a href="<?=base_url('tentang-kami')?>" class="nav-item nav-link <?= ($this->uri->segment(1) == 'tentang-kami') ? 'active' : '' ?>">Tentang</a>
                    <a href="<?=base_url('peta-lahan')?>" class="nav-item nav-link <?= ($this->uri->segment(1) == 'peta-lahan') ? 'active' : '' ?>">Peta Lahan</a>
                    
                    <!-- <a href="contact.html" class="nav-item nav-link">Contact</a> -->
                </div>
                <!-- <div class="border-start ps-4 d-none d-lg-block">
                    <button type="button" class="btn btn-sm p-0"><i class="fa fa-search"></i></button>
                </div> -->
            </div>
        </nav>
    </div>
</div>