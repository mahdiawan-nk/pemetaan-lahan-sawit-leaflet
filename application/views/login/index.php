<!DOCTYPE html>
<html lang="en">

<head>

	<title><?=$title;?></title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="<?=base_url();?>assets/images/logo.png" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?=base_url();?>assets/template/dist/assets/css/style.css">
	
	


</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="<?=base_url();?>assets/images/logo.png" alt="" height="auto" width="50%">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="mb-3 f-w-800">SELAMAT DATANG</h4>
						<h4 class="mb-3 f-w-800">PKS PT MITRA BUMI</h4>
						<p>SP.V Desa Bukit Sembilan</p>
						<hr>
						<?= $this->session->flashdata('message'); ?>
						<form action="<?php echo site_url('welcome/login_aksi');?>"method="POST">
							<div class="form-group mb-3">
								<input type="email" name="email" class="form-control" id="Email" placeholder="Email address">
							</div>
							<div class="form-group mb-4">
								<input type="password" name="password" class="form-control" id="Password" placeholder="Password">
							</div>
							
							<button type="submit" class="btn btn-block btn-primary mb-4">Login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="<?=base_url();?>assets/template/dist/assets/js/vendor-all.min.js"></script>
<script src="<?=base_url();?>assets/template/dist/assets/js/plugins/bootstrap.min.js"></script>

<!-- <script src="<?=base_url();?>assets/template/dist/assets/js/pcoded.min.js"></script> -->



</body>

</html>
