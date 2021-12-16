  </div> 
  </div> 
  </body>
    
  <!-- bootstrap bundle script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?= site_url()?>js/google_charts.js"></script>
    <script src="<?= site_url()?>js/toggle_sidebar.js"></script>
    <script src="<?= site_url()?>js/print.js"></script>
    
    <?php 
      $uri = service('uri');
      $page = $uri->getSegment(2);
      $segment = $uri->getSegment(3);
    ?>
    <?php if($page == 'crs_mgt') :?>
      <script src="<?= site_url()?>js/addrow.js"></script>
      <!-- setup add row functionality -->
      <script>
        setAddRow('addTable', 'a_saveBtn', 'a_rows');
        <?= ($segment !== NULL ) ? "setAddRow('editTable', 'e_saveBtn', 'e_rows');" : NULL ;?>
      </script>
    <?php endif ?>
    
    <!-- TOAST SCRIPT -->
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', () => {
        <?php if(session()->getTempData('success')) : ?>
            toastr.success("<?= session()->getTempData('success'); ?>");
        <?php endif ?>
        <?php if(session()->getTempData('error')) : ?>
            toastr.error("<?= session()->getTempData('error'); ?>");
        <?php endif ?>
        <?php if(session()->getTempData('warning')) : ?>
            toastr.warning("<?= session()->getTempData('warning'); ?>");
        <?php endif ?>
        <?php if(session()->getTempData('info')) : ?>
            toastr.info("<?= session()->getTempData('info'); ?>");
        <?php endif ?>
        <?php if(session()->getTempData('validation')) :  ?>
            <?php $validation = session()->getTempData('validation');?>
            <?php $errors = $validation->getErrors(); ?>
            <?php foreach ($errors as $key => $error) :?>
            toastr.error("<?= $error; ?>");
            <?php endforeach?>
        <?php endif ?>
      });
    </script>
</html>