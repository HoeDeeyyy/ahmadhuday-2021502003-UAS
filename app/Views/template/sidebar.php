
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url(); ?>/assets/dist/img/day.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIKOPER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
              <?php
                foreach ($menu as $k => $v) {
              ?>
                <li class="nav-item">
                  <a href="<?php echo $v['link']; ?>" class="nav-link <?php echo $v['aktif']; ?>">
                    <i class="<?php echo $v['icon']; ?>"></i>
                    <p>
                      <?php echo $v['title']; ?>
                    </p>
                  </a>
                </li>
              <?php
                }
              ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>