  </body>
  <!-- bootstrap js bundle -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <!-- fontawesome -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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