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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="icon" href="<?= site_url()?>assets/images/school_logo.png">
    <title>Registrar - Lagonoy High School</title>
  </head>
  <?php 
    $uri = service('uri');
    $page = $uri->getSegment(2);
    $segment = $uri->getSegment(3);
    $modal_open = 'modal-open';
    $backdrop = '<div class="modal-backdrop fade show"></div>';
    $page_wrapper = 'style="overflow: hidden; padding-right: 0px" data-bs-overflow="hidden" data-bs-padding-right="0px"';
    $is_in_crs_mgt_page = ($page == 'crs_mgt' && $segment == 'edit_course' || $segment == 'update_course');
    $is_in_crs_sched_page = ($page == 'crs_schedule' && $segment == 'edit_schedule' || $segment == 'update_schedule');
  ?>

  <body class="bg-light <?= ($is_in_crs_mgt_page || $is_in_crs_sched_page) ? $modal_open : '' ?>" <?= ($is_in_crs_mgt_page || $is_in_crs_sched_page) ? $page_wrapper : '' ?>>
  <?= ($is_in_crs_mgt_page || $is_in_crs_sched_page) ? $backdrop : '' ?>
  
