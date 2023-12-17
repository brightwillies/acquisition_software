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
                            <li><a href="/administrator-dashboard" key="t-default">Dashboard</a></li>

                        </ul>
                    </li>




                    <li class="menu-title" key="t-pages">Pages</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-authentication">User Management</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/administrator-dashboard/user" key="t-login">Administrators</a></li>
                            <li><a href="/administrator-dashboard/purchaser" key="t-login">Purchaser</a></li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-user-circle"></i>
                            <span key="t-authentication">Department</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="/administrator-dashboard/department" key="t-login">Departments</a></li>
                            <li><a href="/administrator-dashboard/department-head" key="t-login">Department Heads</a></li>
                        </ul>
                    </li>


                    <li class="menu-title" key="t-pages">Acquisitions</li>
                    <li><a href="/administrator-dashboard/pending-acquisition" key="t-login">Pending Acquisitions</a></li>
                    <li><a href="/administrator-dashboard/other-acquisition" key="t-login">Completed Acquisitions</a></li>




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

<style lang="scss" scoped></style>