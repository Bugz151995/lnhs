<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
		<link rel="stylesheet" href="<?= site_url()?>css/main.css">
    <link rel="icon" href="<?= site_url()?>assets/images/school_logo.png">
    <title>Admin - Lagonoy High School</title>
  </head>
  <body class="bg-light" style="min-height: 100vh;">
		<header class="bg-primary fixed-top">
			<nav class="container navbar navbar-expand-lg navbar-dark">
				<div class="container">
					<a class="navbar-brand d-flex gap-2 align-items-center" href="<?= site_url()?>">
						<img src="<?= site_url()?>assets/images/school_logo.png" alt="" width="40" class="img-fluid">
						<span class="brand-title">Lagonoy High School</span>
					</a>
					
					<div class="collapse navbar-collapse offset justify-content-end" id="navbarSupportedContent">
						<div id="topbar-item" class="border-start border-primary d-flex align-items-center px-2 text-light">
							<div id="topbar-icon" class="rounded-circle d-flex align-items-center justify-content-center">
								<i class="far fa-chalkboard-teacher fa-lg fa"></i>
							</div>
							<span class="ps-2 h6 align-middle m-0 fw-bold">Admin</span>
						</div>
					</div>
				</div>
			</nav>
		</header>

    <!-- MAIN CONTENT -->
		<main class="d-flex align-items-center h-100 position-relative py-5" style="top: 66px;">
			<div class="container col-sm-10 justify-content-center d-flex">
				<div class="row shadow w-75" style="border-radius: 1rem">
					<!-- school logo -->
					<div class="col-12 text-center d-none d-sm-block pt-5" style="background-image: url(<?= site_url()?>assets/images/631.jpg); background-size: cover">
						<img class="" src="<?= site_url()?>assets/images/school_logo.png" height="150" alt="School Logo">
						<label class="mb-5 p-1 rounded mt-3 display-6 fw-bold" style="background: #fff">
							Lagonoy Senior High School Online Enrollment System
						</label>
					</div>

					<!-- form -->
					<div class="col-12 d-flex align-items-center bg-white">
						<div class="w-100 px-3 py-4">
							<?= form_open('a/auth/signin') ?>
								<ul class="nav nav-tabs justify-content-center">
									<li class="nav-item">
										<a class="nav-link h4" aria-current="page" href="<?= site_url()?>r"><i class="fas fa-user-tie"></i> Registrar</a>
									</li>
									<li class="nav-item">
										<a class="nav-link h4 active" href="<?= site_url()?>a"><i class="fas fa-user-shield"></i> Admin</a>
									</li>
								</ul>

								<div class="d-flex flex-column gap-3 align-items-center justify-content-center">
									<div class="w-75">
										<div class="form-group mt-4 w-100">
											<label for="username" class="form-label">Username</label>
											<input type="text" name="un" class="form-control" id="username" placeholder="User Name" required autofocus>
										</div>

										<div class="form-group mt-3 w-100">
											<label for="password" class="form-label">Password</label>
											<input type="password" name="ps" class="form-control" id="password" placeholder="Password" required>
										</div>
									</div>
								</div>
								
								<div class="form-group mt-5 d-flex justify-content-end">
									<button type="submit" class="btn btn-primary">Sign in <i class="fas fa-arrow-right ms-1"></i></button>
								</div>
							<?= form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!-- bootstrap bundle script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- TOAST SCRIPT -->
    <script type="text/javascript">
      window.addEventListener('DOMContentLoaded', () => {
        <?php if(session()->getTempData('success')){ ?>
            toastr.success("<?= session()->getTempData('success'); ?>");
        <?php }else if(session()->getTempData('error')){  ?>
            toastr.error("<?= session()->getTempData('error'); ?>");
        <?php }else if(session()->getTempData('warning')){  ?>
            toastr.warning("<?= session()->getTempData('warning'); ?>");
        <?php }else if(session()->getTempData('info')){  ?>
            toastr.info("<?= session()->getTempData('info'); ?>");
        <?php } ?>
      });
    </script>
  </body>
</html>