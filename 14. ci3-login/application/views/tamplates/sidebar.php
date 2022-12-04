<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user'); ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-code"></i>
    </div>
    <div class="sidebar-brand-text mx-3">CI3-LOGIN</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Query Data -->
  <?php
  $role_id = $this->session->userdata('role_id');
  $queryMenu = "SELECT `user_menu`.`id`, `menu` 
                  FROM `user_menu` JOIN `user_access_menu`  
                  ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                  WHERE `user_access_menu`.`role_id` = $role_id
                  ORDER BY `user_access_menu`.`menu_id` ASC";

  $menu = $this->db->query($queryMenu)->result_array();
  // var_dump($menu);   // [0 => ['id' => 1, 'menu'=>'Admin'], 1 => ['id'=>2, 'menu'=>'User']]
  // die;
  ?>

  <!-- Looping Menu-->
  <?php foreach ($menu as $m) : ?>
    <!-- Heading -->
    <div class="sidebar-heading">
      <?= $m['menu']; ?>
    </div>

    <!-- Siapkan Sub-Menu Sesuai Menu -->
    <?php
    $menu_id = $m['id'];
    $querySubMenu = "SELECT * 
                      FROM `user_sub_menu` 
                      WHERE  `menu_id` = $menu_id 
                      AND `is_active` = 1";

    $subMenu = $this->db->query($querySubMenu)->result_array();
    // var_dump($subMenu);
    // die;
    ?>
    <?php foreach ($subMenu as $sm) : ?>
      <li class="nav-item <?= ($title == $sm['title']) ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url($sm['url']); ?>">
          <i class="<?= $sm['icon'] ?>"></i>
          <span><?= $sm['title']; ?></span></a>
      </li>
    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

  <?php endforeach; ?>


  <!-- Nav Item - Logout -->
  <li class="nav-item">
    <a class="nav-link logout" href="<?= base_url('auth/logout'); ?>">
      <!-- fa-fw : fontawesome fix width -->
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->