<?php $methodeName = service('router')->methodName() ?>
<!-- Sidebar -->
<ul 
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" 
    id="accordionSidebar"
>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <img src="/assets/img/cc-logo.png" height="40" width="40" alt="Charel Chapeaux"> -->
        </div>

        <div class="sidebar-brand-text mx-3">
            Charel Dashboard
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li 
     class="nav-item <?= $methodeName == 'home' ? 'active' : null ?>"
    >
        <a class="nav-link" href="<?= route_to('admin.home', request()->getLocale()) ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>
                Accueil
            </span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li 
     class="nav-item <?= $methodeName == 'content' ? 'active' : null ?>"
    >
        <a 
            class="nav-link collapsed" 
            href="<?= route_to('admin.content') ?>" 
        >
            <i class="fas fa-fw fa-book"></i>
            <span>Content</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Utilities Collapse Menu -->
    <li
     class="nav-item <?= $methodeName == 'items' ? 'active' : null ?>"
    >
        <a 
            class="nav-link" 
            href="<?= route_to('admin.items') ?>" 
            aria-expanded="true" 
        >
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>
                Mes Articles
            </span>
        </a>
    </li>
</ul>
<!-- End of Sidebar -->