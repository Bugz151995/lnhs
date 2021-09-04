<main class="container">
  <div class="bg-white mx-sm-5 mt-4">
    <?php
      if(isset($validation)) {
        echo $validation->listErrors();
      }
    ?>
    <?= form_open_multipart('enrollment/request')?>
      <!-- header -->
      <div class="bg-primary p-3 text-light text-center h5">Request Token</div>
      <!-- learners information -->
      <div class="row px-sm-5">
        <!-- 2x2 -->
        <div class="col-lg-12 text-center align-self-center justify-self-center">
          <img src="<?= site_url()?>assets/images/user.jpg" alt="2by2 picture" id="img_preview" style="width: 200px; height: 200px; background-color: rgba(0,0,255,.1);" class="img-fluid img-thumbnail mx-4 rounded">
          <div class="px-3 pt-2 ">
            <input type="file" name="user_img" value="<?= set_value('user_img')?>" id="user_img" class="form-control form-control-sm">
          </div>
          <p class="text-danger fst-italic">Please upload your student ID. and fill up the form to request for a unique token.</p>
        </div>
        
        <!-- learners information -->
        <div class="col-lg-12 mt-4">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 g-lg-4 g-2 px-3">
            <div class="col">
              <label for="firstname" class="form-label"><span class="text-danger">*</span> First name</label>
              <input type="text" class="form-control form-control-sm" name="firstname" value="<?= set_value('firstname')?>" id="firstname" placeholder="First Name here...">
            </div>
            <div class="col">
              <label for="middlename" class="form-label"><span class="text-danger">*</span> Middle name</label>
              <input type="text" id="middlename" name="middlename" value="<?= set_value('middlename')?>" class="form-control form-control-sm" placeholder="Middle Name here..."> 
            </div>
            <div class="col">
              <label for="lastname" class="form-label"><span class="text-danger">*</span> Last Name</label>
              <input type="text" class="form-control form-control-sm " id="lastname" name="lastname" value="<?= set_value('lastname')?>" placeholder="Last Name here...">
            </div>
            <div class="col">
              <label for="nameextension" class="form-label"><span class="text-danger">*</span> Name Extension</label>
              <input type="text" class="form-control form-control-sm " id="nameextension" name="suffix" value="<?= set_value('suffix')?>" placeholder="Name Extendsion here...">
            </div>
            <div class="col">
              <label for="contact_num" class="form-label"><span class="text-danger">*</span> Contact Number</label>
              <input type="text" class="form-control form-control-sm " id="contact_num" name="contact_num" value="<?= set_value('contact_num')?>" placeholder="Contact Number here...">
            </div>
            <div class="col">
              <label for="email" class="form-label"><span class="text-danger">*</span> Email</label>
              <input type="email" class="form-control form-control-sm " id="email" name="email" value="<?= set_value('email')?>" placeholder="Email here...">
            </div>
          </div> 
        </div>
      </div>

      <div class="gap-2 d-flex justify-content-sm-end justify-content-center mt-3 mb-3 px-sm-5 pb-3">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    <?= form_close()?>
  </div>
  <div class="d-none d-sm-block p-5 mt-5">
    &nbsp;
  </div>
</main>

<script src="<?= site_url()?>js/preview_image.js"></script>