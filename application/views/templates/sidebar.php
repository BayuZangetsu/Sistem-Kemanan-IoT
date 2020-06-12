<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DIGITAL SCHOOL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- BUAT QUERY MENU  -->
    <?php
    //join database user_menu dan access_menu
    //select untuk memilih daftar menu (admin/guru)
    $status_id = $this->session->userdata('status_id');
    $queryMenu = "SELECT `menu_user`.`id`,`menu`
                    FROM `menu_user` JOIN `user_access_menu` ON `menu_user`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`status_id`=$status_id
                    ORDER BY `user_access_menu`.`menu_id` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    // var_dump($menu);
    // die;

    ?>
    <?php foreach ($menu as $m) : ?>
    <!-- Mulai Loop Menu -->
    <!-- Heading -->
    <div class="sidebar-heading">
        <?= $m['menu']; ?>
    </div>
    <!-- Keluarkan submenu -->
    <?php
        $menu_id = $m['id'];
        $querySubmenu = "SELECT * from `user_submenu` where `menu_id`=$menu_id and `is_active`=1";
        $submenu = $this->db->query($querySubmenu)->result_array();
        // var_dump($submenu);
        // die;
        ?>
    <?php foreach ($submenu as $sb) : ?>
    <!-- Item SUb Menu -->
    <?php if ($title == $sb['judul']) : ?>
    <li class="nav-item active">
        <?php else : ?>
    <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url($sb['url']) ?>">
            <i class="<?= $sb['icon']; ?>"></i>
            <span><?= $sb['judul']; ?></span></a>
    </li>
    <?php endforeach; ?>

    <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>
    <!-- Akun Saya  -->
    <?php
    if($title=="Akun Saya"){
        $active="nav-item active";
    }else $active="nav-item";
    ?>
    <li class="<?=$active;?>">
        <a href="<?=base_url('Akun');?>" class="nav-link">
            <i class="fas fa-fw fa-user"></i>
            <span>Akun Saya</span></a>
    </li>
    <!-- tombol Logout -->
    <li class="nav-item">
        <a class="nav-link" onclick="logout()">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>LOGOUT</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<!-- End of Sidebar -->
