<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
		<link rel="stylesheet" href="<?= site_url()?>css/main.css">
    <title>Sign-in</title>
  </head>
  <body class="img-fluid  bg-image">
    
    <!-- MAIN CONTENT -->
		<div style="height: 100vh" class="d-flex align-items-center">
			<div class="container col-sm-8">
				<div class="row shadow" style="border-radius: 1rem">
					<!-- school logo -->
					<div class="col-4 text-center d-none d-sm-block py-5" style="background-image: url(<?= site_url()?>assets/images/background.png); background-size: cover">
						<img class="" src="<?= site_url()?>assets/images/school_logo.png" height="150" alt="School Logo">
						<label class="mb-5 p-1 rounded" style="background: #fff">
							Lagonoy Senior High School Online Enrollment System
						</label>
					</div>

					<!-- form -->
					<div class="col-12 col-sm-8">
						<?= form_open('r/auth/signin') ?>
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link active" aria-current="page" href="<?= site_url()?>r">Registrar</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= site_url()?>a">Admin</a>
								</li>
							</ul>

							<div class="form-group mt-4">
								<label for="username" class="form-label">Username</label>
								<input type="text" name="un" class="form-control" id="username" placeholder="User Name" required autofocus>
							</div>

							<div class="form-group mt-3">
								<label for="password" class="form-label">Password</label>
								<input type="password" name="ps" class="form-control" id="password" placeholder="Password" required>
							</div>
							
							<div class="form-group mt-3 d-flex justify-content-between">
								<a href="<?= site_url()?>r/auth/signup" class="text-decoration-none">Don't have an Account? Sign-up</a>
								<button type="submit" class="btn btn-primary">Sign in</button>
							</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
    
    
		<!-- bootstrap bundle script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- TOAST SCRIPT -->
    <script type="text/javascript">
      window.addEventListener('DOMContentLoaded', () => {
        <?php if(session()->getFlashdata('success')){ ?>
            toastr.success("<?= session()->getFlashdata('success'); ?>");
        <?php }else if(session()->getFlashdata('error')){  ?>
            toastr.error("<?= session()->getFlashdata('error'); ?>");
        <?php }else if(session()->getFlashdata('warning')){  ?>
            toastr.warning("<?= session()->getFlashdata('warning'); ?>");
        <?php }else if(session()->getFlashdata('info')){  ?>
            toastr.info("<?= session()->getFlashdata('info'); ?>");
        <?php } ?>
      });
    </script>
    
  </body>
</html>
