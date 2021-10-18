<header class="topbar toggled bg-white position-fixed top-0">
  <div class="d-flex justify-content-end align-items-center h-100">
    <div id="topbar-item">
      <div id="topbar-icon" class="rounded-circle d-flex align-items-center justify-content-center mx-3">
        <?php 
          $notif_total = $e_n['e'] + $g_n['g']; 
        ?>
        <div class="btn-group position-absolute">
          <button type="button" class="btn btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell fa-lg"></i>
            <span class="badge bg-danger position-absolute bottom-50 start-50 rounded-pill">
              <?= ($notif_total > 99) ? '99+' : $notif_total ?>
            </span>
          </button>
          <ul class="dropdown-menu">
            <?php foreach($notif_e as $key => $ne): ?>
            <li>
              <a class="dropdown-item small" href="<?= site_url()?>r/enrollments">
                <span class="fst-italic me-2 fw-bold">Enrollment</span><span class="badge bg-success me-2">New</span>
              </a>
            </li>
            <?php endforeach ?>
            <?php foreach($notif_g as $key => $ng): ?>
            <li>
              <a class="dropdown-item small" href="<?= site_url()?>r/esc_request">
                <span class="fst-italic me-2 fw-bold">ESC Application</span><span class="badge bg-success me-2">New</span>
              </a>
            </li>
            <?php endforeach ?>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?= site_url()?>r/enrollments">See More...</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div id="topbar-item" class="border-start border-primary d-flex align-items-center px-2">
      <div id="topbar-icon" class="rounded-circle d-flex align-items-center justify-content-center" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="far fa-chalkboard-teacher fa-lg fa"></i>
      </div>
      <span class="ps-2 h6 align-middle m-0 fw-bold" style="color: #5E2BFF">Registrar</span>
    </div>
  </div>
</header>