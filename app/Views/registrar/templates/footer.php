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
        <?php if(session()->getFlashdata('success')){ ?>
            toastr.success("<?= session()->getFlashdata('success'); ?>");
        <?php }else if(session()->getFlashdata('error')){  ?>
          <?php if(!isset($validation)) :?>
            toastr.error("<?= session()->getFlashdata('error'); ?>");
          <?php else :?>
            toastr.error("<?= session()->getFlashdata('error') . $validation->getError('strand')?>");
          <?php endif?>
        <?php }else if(session()->getFlashdata('warning')){  ?>
            toastr.warning("<?= session()->getFlashdata('warning'); ?>");
        <?php }else if(session()->getFlashdata('info')){  ?>
            toastr.info("<?= session()->getFlashdata('info'); ?>");
        <?php } ?>
      });
    </script>
</html>