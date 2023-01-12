<template>
    <div class="">
        <div class="wrapper">
          <Toast />
          <!--
            <div class="preloader flex-column justify-content-center align-items-center">
                <img class="animation__wobble" src="../../../storage/app/public/images/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
            </div>
          -->
            <!-- Navbar -->
            <Navbar />
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <Sidebar />

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <slot name="header"></slot>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard v2</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <slot></slot>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


           <Footer />
        </div>
    </div>
</template>

<script>
import Sidebar from '@/Components/Partials/Sidebar.vue'
import Navbar from '@/Components/Partials/Navbar.vue'
import Footer from '@/Components/Partials/Footer.vue'
import Toast from '@/Common/Toast/Toast.vue'
export default {
    name: "Dashboard",
    components: {
        Footer,
        Navbar,
        Sidebar,
        Toast
    },
    mounted() {
      this.init()
      document.body.classList.remove('sidebar-open')
      document.body.classList.add('sidebar-close')
    },
    methods: {
        init() {
            let SELECTOR_LOADER = '.preloader'
            setTimeout(() =>{
                let $loader = $(SELECTOR_LOADER)
                if($loader) {
                    $loader.css('height', 0)
                    setTimeout(() =>{
                        $loader.children().hide()
                    }, 2000)
                }
            },2000)
        }
    }
}
</script>
