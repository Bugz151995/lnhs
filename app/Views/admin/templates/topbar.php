<header class="topbar toggled bg-white position-fixed top-0">
  <div class="d-flex justify-content-end align-items-center h-100">
    <div id="topbar-item">
      <div id="topbar-icon" class="rounded-circle d-flex align-items-center justify-content-center mx-3">
        <div class="btn-group">
          <button class="position-relative btn btn-sm bg-transparent" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell fa-lg fa"></i>
            <span class="badge bg-danger position-absolute bottom-50 start-50 rounded-pill">
              <?php 
                $s = $notif_s['total'];
                $r = $notif_r['total'];
                $total = $s + $r;
                if ($total > 99) {
                  echo "99+";
                }else echo $total;
              ?>
            </span>
          </button>
          <ul class="dropdown-menu">
            <?php foreach ($ns_content as $key => $ns) :?>
              <li><a class="dropdown-item small" href="<?= site_url()?>a/request"><span class="badge bg-success me-2">New</span><?= $ns->firstname ?><span class="fst-italic">(student)</span></a></li>
            <?php endforeach ?>
            <?php foreach ($nr_content as $key => $nr) :?>
              <li><a class="dropdown-item small" href="<?= site_url()?>a/r_request"><span class="badge bg-success me-2">New</span><?= $nr->firstname ?><span class="fst-italic">(registrar)</span></a></li>
            <?php endforeach ?>
            <li><hr class="dropdown-divider"></li>
            <li class="text-center"><a class="dropdown-item" href="<?= site_url()?>a/request">See More...</a></li>
          </ul>
      </div>
      </div>      
    </div>
    <div id="topbar-item" class="border-start border-primary d-flex align-items-center px-2">
      <div id="topbar-icon" class="rounded-circle d-flex align-items-center justify-content-center">
        <i class="far fa-chalkboard-teacher fa-lg fa"></i>
      </div>
      <span class="ps-2 h6 align-middle m-0 fw-bold" style="color: #5E2BFF">Admin</span>
    </div>
  </div>
</header>