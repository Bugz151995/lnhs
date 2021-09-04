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
  <body>
    <!-- MAIN CONTENT -->
		<div  class="d-flex align-items-center my-3 ">
			<div class="container col-sm-12">
				<div class="row shadow-lg" style="border-radius: 1rem">
					<!-- school logo -->
					<div class="col-12 text-center d-none d-sm-block py-5" style=" background-image: url('<?= site_url()?>assets/images/lagonoybg.jpg'); background-size: cover">
						<img class="" src="<?= site_url()?>assets/images/school_logo.png" height="150" alt="School Logo">
						<label class="h3 bg-light text-dark rounded p-2 ">
							Lagonoy Senior High School Online Enrollment System
						</label>
					</div>
						
					<!-- form -->
					<div class="col-12 col-sm-12 p-3 bg-light">
						<h4 class="text-center bg-light shadow-sm rounded p-3">Registrar Sign-up</h4>
            
						<?= form_open('r/auth/signup/submit') ?>
              <div class="form-group row mt-3">
                <div class="col-sm-4 mt-1">
                  <label for="firstName" class="form-label"><span class="text-danger">*</span> First Name</label>
                  <input type="text" name="fname" class="form-control" id="firstName" placeholder="First Name here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('fname') : '' ?></span>
                </div>
                <div class="col-sm-4 mt-1">
                  <label for="middleName" class="form-label"><span class="text-danger">*</span> Middle Name</label>
                  <input id="middleName" name="mname" class="form-control" placeholder="Middle Name here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('mname') : '' ?></span>
                </div>
                <div class="col-sm-4 mt-1">
                  <label for="surname" class="form-label"><span class="text-danger">*</span> Last Name</label>
                  <input type="text" name="lname" class="form-control" id="surname" placeholder="Last Name here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('lname') : '' ?></span>
                </div>
              </div>
              
              <div class="form-group row mt-3">
                <div class="col-sm-4">
                  <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                  <input type="email" name="em" class="form-control" id="email" placeholder="Email here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('em') : '' ?></span>
                </div>
                <div class="col-sm-4">
                  <label for="contactNumber" class="form-label">Contact Number</label>
                  <input type="text" name="cn" id="contactNumber" class="form-control" placeholder="Contact Number here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('cn') : '' ?></span>
                </div>
              </div>

							<hr>
              <div class="form-group row mt-3">
                <div class="col-sm-4">
                  <label for="username" class="form-label"><span class="text-danger">*</span> Username</label>
                  <input type="text" name="uname" class="form-control" id="username" placeholder="Username here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('uname') : '' ?></span>
                </div>
                <div class="col-sm-4">
                  <label for="password" class="form-label"><span class="text-danger">*</span> Password</label>
                  <input type="password" name="ps" class="form-control" id="password" placeholder="Password here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('ps') : '' ?></span>
                </div>
                <div class="col-sm-4">
                  <label for="passconf" class="form-label"><span class="text-danger">*</span> Repeat Password</label>
                  <input type="password" name="psc" class="form-control" id="passconf" placeholder="Password Confirmation here...">
                  <span class="text-danger fst-italic"><?= (isset($validation)) ? $validation->getError('psc') : '' ?></span>
                </div>
              </div>
							
							<div class="d-flex justify-content-between mt-3">
                <a href="<?= site_url()?>r">Already have Account? Sign-in</a>
								<button type="submit" class="btn btn-primary">Sign up</button>
							</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
    
    
		<!-- bootstrap bundle script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
