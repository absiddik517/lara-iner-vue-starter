<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <inertia-link :href="route('admin.dashboard.index')" class="brand-link">
            <img src="../../../../storage/app/public/images/AdminLTELogo.png"  alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </inertia-link>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../../../storage/app/public/images/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <inertia-link href="#" class="d-block">{{ $page.props.user.name }}</inertia-link>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <inertia-link :href="route('admin.dashboard.index')" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </inertia-link>
                            </li>
                        </ul>
                    </li>
                    
                    <SidebarTree>
                      <template #title>
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Gates
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </template>
                      <template #links>
                        <SidebarLink 
                          :url="route('admin.gate.role.index')"
                          text="Role"
                          icon="far fa-circle"
                        />
                        <SidebarLink 
                          :url="route('gate.permission.index')"
                          text="Permission"
                          icon="far fa-circle"
                        />
                      </template>
                    </SidebarTree>
                    
                    <SidebarTree>
                      <template #title>
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          Table
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </template>
                      <template #links>
                        <SidebarLink 
                          :url="route('admin.dashboard.table')"
                          text="Users"
                          icon="far fa-circle"
                        />
                      </template>
                    </SidebarTree>
                    
                    <li class="nav-header">MISCELLANEOUS</li>
                    <li class="nav-item">
                        <inertia-link :href="route('dashboard')" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Site</p>
                        </inertia-link>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#" class="nav-link" role="button">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script setup>
  import SidebarTree from './Shared/SidebarTree.vue'
  import SidebarLink from './Shared/SidebarLink.vue'
</script>
