<template>
    <div>
        
        <Header/>

        <!-- ========== Left Sidebar Start ========== -->
        <Sidebar />
        <!-- Left Sidebar End -->

        

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

         
              <router-view/>
            <!-- End Page-content -->

            <!-- Transaction Modal -->
            <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="transaction-detailModalLabel">Order Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p>
                            <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="/bassets/images/product/img-7.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                    <p class="text-muted mb-0">$ 225 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 255</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div>
                                                    <img src="/bassets/images/product/img-4.png" alt="" class="avatar-sm">
                                                </div>
                                            </th>
                                            <td>
                                                <div>
                                                    <h5 class="text-truncate font-size-14">Phone patterned cases</h5>
                                                    <p class="text-muted mb-0">$ 145 x 1</p>
                                                </div>
                                            </td>
                                            <td>$ 145</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Sub Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Shipping:</h6>
                                            </td>
                                            <td>
                                                Free
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <h6 class="m-0 text-right">Total:</h6>
                                            </td>
                                            <td>
                                                $ 400
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

            <!-- subscribeModal -->
            <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <div class="avatar-md mx-auto mb-4">
                                    <div class="avatar-title bg-light rounded-circle text-primary h1">
                                        <i class="mdi mdi-email-open"></i>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-xl-10">
                                        <h4 class="text-primary">Subscribe !</h4>
                                        <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay update.</p>

                                        <div class="input-group bg-light rounded">
                                            <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            
                                            <button class="btn btn-primary" type="button" id="button-addon2">
                                                <i class="bx bxs-paper-plane"></i>
                                            </button>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Wait !!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <h4>Are  you sure you want to logout ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button   @click="logout"   type="button" class="btn btn-danger">Yes log me out</button>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                          
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Makis Technologies
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
</template>

<script>
// import Footer from "./components/Footer"
import Sidebar from "./Components/Sidebar"
 import Header from "./components/Header"
export default {

    components : {Sidebar, Header},
    setup () {
        

        return {}
    }, 
    methods : {
        logout(e) {
			e.preventDefault();
			delete this.$axios.defaults.headers.common["Authorization"];
			localStorage.removeItem("acicms_platform_admin");
			localStorage.removeItem("acicms_platform_admin_firstname");
			localStorage.removeItem("acicms_platform_admin_pass");
			window.location.replace("/administrator-login");
		},
    }
}
</script>

<style lang="scss" scoped>

</style>