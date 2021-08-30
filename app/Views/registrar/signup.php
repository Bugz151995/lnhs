<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            
						<form class="bg-light px-4 pb-4">
              <div class="form-group row mt-3">
                <div class="col-sm-4 mt-1">
                  <label for="firstName" class="form-label"><span class="text-danger">*</span> First name</label>
                  <input type="text" class="form-control" id="firstName">
                </div>
                <div class="col-sm-4 mt-1">
                  <label for="middleName" class="form-label"><span class="text-danger">*</span> Middle name</label>
                  <input id="middleName" class="form-control">
                </div>
                <div class="col-sm-4 mt-1">
                  <label for="surname" class="form-label"><span class="text-danger">*</span> Surname</label>
                  <input type="text" class="form-control" id="surname">
                </div>
              </div>
              
              <div class="form-group row mt-3">
                <div class="col-sm-4">
                  <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
                  <input type="email" class="form-control" id="email">
                </div>
                <div class="col-sm-4">
                  <label for="contactNumber" class="form-label">Contact Number</label>
                  <input type="number" id="contactNumber" class="form-control">
                </div>
                <div class="col-sm-4">
                  <label for="username" class="form-label"><span class="text-danger">*</span> User-name</label>
                  <input type="text" class="form-control" id="username">
                </div>
              </div>
							
              <div class="form-group row mt-3">
                <div class="col-sm-6">
                  <label for="password" class="form-label"><span class="text-danger">*</span> Password</label>
                  <input type="password" class="form-control" id="password">
                </div>
                <div class="col-sm-6">
                  <label for="passconf" class="form-label"><span class="text-danger">*</span> Repeat Password</label>
                  <input type="password" class="form-control" id="passconf">
                </div>
              </div>
							
							<div class="d-flex justify-content-between mt-3">
                <a href="<?= site_url()?>r/auth/signin">Already have Account? Sign-in</a>
								<button type="submit" class="btn btn-primary">Sign up</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    
    
		<!-- bootstrap bundle script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  </body>
</html>
