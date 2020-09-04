<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                <i class='fas fa-home fa-lg fa-fw'></i>
                </div>
                <div class="sidebar-brand-text mx-3">ADMIN AREA</div>
            </a>
            <hr class="sidebar-divider my-0">
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>

            <li class="nav-item <?php echo  $page_name == 'item' ||  $page_name == 'itemHighlight'  ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="fas fa-fw fa-store"></i>
                    <span>Store</span>
                </a>
                <div id="collapseBootstrap" class="collapse <?php echo  $page_name == 'item' || $page_name == 'itemHighlight' ? 'show' : '' ?>" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu</h6>
                        <a class="collapse-item <?php echo  $page_name == 'item' ? 'active' : '' ?>" href="<?php echo base_url().'staff/item'; ?>">List Item</a>
                        <a class="collapse-item <?php echo  $page_name == 'itemHighlight' ? 'active' : '' ?>" href="<?php echo base_url().'staff/itemHighlight'; ?>">Highlight Homepage</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php echo  $page_name == 'order' || $page_name == 'orderAnother'  ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap2" aria-expanded="true" aria-controls="collapseBootstrap2">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                    <span>Order</span>
                </a>
                <div id="collapseBootstrap2" class="collapse <?php echo  $page_name == 'order' || $page_name == 'orderAnother' ? 'show' : '' ?>" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu</h6>
                        <a class="collapse-item <?php echo  $page_name == 'order' ? 'active' : '' ?>" href="<?php echo base_url().'staff/order'; ?>">Orderan Kopi</a>
                        <a class="collapse-item <?php echo  $page_name == 'orderAnother' ? 'active' : '' ?>" href="<?php echo base_url().'staff/orderAnother'; ?>">Orderan Non Kopi</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php echo  $page_name == 'artikel' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/artikel'; ?>">
                    <i class="fas fa-fw fa-newspaper"></i>
                    <span>Article</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'gallery' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/gallery'; ?>">
                    <i class="fas fa-fw fa-file-image"></i>
                    <span>Gallery</span>
                </a>
            </li>
            
            <li class="nav-item <?php echo  $page_name == 'workshop' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/workshop'; ?>">
                    <i class="fas fa-fw fa-truck"></i>
                    <span>Workshop</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'contact' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/contact'; ?>">
                    <i class="fas fa-fw fa-phone"></i>
                    <span>Contact Us</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'slideshow' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/slideshow'; ?>">
                    <i class="fas fa-fw fa-slideshare"></i>
                    <span>Slideshow Homepage</span>
                </a>
            </li>


            <li class="nav-item <?php echo  $page_name == 'background' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/background'; ?>">
                    <i class="fas fa-fw fa-universal-access"></i>
                    <span>Background</span>
                </a>
            </li>

            
            <li class="nav-item <?php echo  $page_name == 'user' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/user'; ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'email' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/email'; ?>">
                    <i class="fas fa-fw fa-mail-bulk"></i>
                    <span>Email</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'testimoni' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/testimoni'; ?>">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Testimoni</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'logo' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/logo'; ?>">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Logo</span>
                </a>
            </li>

            <li class="nav-item <?php echo  $page_name == 'sosmed' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'staff/sosmed'; ?>">
                    <i class="fas fa-fw fa-info"></i>
                    <span>Akun Sosial Media</span>
                </a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item <?php echo  $page_name == 'user' ? 'active' : '' ?>">
                <a class="nav-link" href="<?php echo base_url().'utama'; ?>" target="black">
                    <i class="fas fa-fw fa-caret-left"></i>
                    <span>Go to website</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        
<!-- Sidebar -->


<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">