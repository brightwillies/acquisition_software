<template>
 
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-home-circle"></i>
                                <span key="t-dashboards">Dashboards</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/purchaser-dashboard" key="t-default">Dashboard</a></li>

                            </ul>
                        </li>


               

                        <li class="menu-title" key="t-pages">Pages</li>

                   

                    
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="bx bx-user-circle"></i>
                                <span key="t-authentication">Acquistions</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="/purchaser-dashboard/new-acquisition" key="t-login">New Acquisition</a></li>
                                <li><a href="/purchaser-dashboard/pending-acquisition" key="t-login">Pending Requests</a></li>
                                <li><a href="/purchaser-dashboard/approved-acquisition" key="t-login">Approved Requests</a></li>
                            </ul>
                        </li>                   
                
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>

</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>