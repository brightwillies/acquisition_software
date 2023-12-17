<template>
    <div>
        <div class="page-content">
            <div class="container-fluid">


                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Orders :</h4>
                            <div class="page-title-right">
                                <!-- <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                    <li class="breadcrumb-item active"></li>
                                </ol> -->
                            </div>

                        </div>
                    </div>


                </div>

                <div class="row" v-show="isLoading">
                    <div class="col-lg-12">
                        <Vue3Lottie :animationData="AstronautJSON" :height="800" :width="800" />

                    </div>
                </div>

                <div class="row" v-show="!isLoading">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4">

                                    </div>
                                    <div class="col-sm-8">
                                        <div class="text-sm-end">

                                        </div>
                                    </div><!-- end col-->
                                </div>


                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Item Description</th>
                                            <th>No of Items</th>
                                            <th>Placed On</th>
                                            <th>Status</th>
                                            <!-- <th>Profile Pic</th> -->
                                            <th>View </th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="singleItem in tableData" :key="singleItem.id">
                                            <td>{{ singleItem.customer }}</td>
                                            <td>{{ singleItem.item_description }}</td>
                                            <td>{{ singleItem.total_items }}</td>
                                            <td>{{ singleItem.placed_on }}</td>

                                            <td>
                                                <span v-if="singleItem.status === 'placed'"
                                                    class="badge badge-pill badge-soft-success font-size-12"> {{
                                                        singleItem.status }}</span>

                                                <span v-if="singleItem.status != 'placed'"
                                                    class="badge badge-pill badge-soft-danger font-size-12">{{
                                                        singleItem.status }}</span>
                                            </td>

                                            <!-- <td>
                                                <div class="table-image">
                                                    <img :src="singleItem.image"  width="50" height="50" class="rounded-circle" alt="">
                                                </div>
                                            </td> -->

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button @click="launchEditModal(singleItem)" type="button"
                                                    class="btn btn-primary btn-sm btn-rounded">
                                                    View Details
                                                </button>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-3">
                                                    <a href="javascript:void(0);" @click="launchEditModal(singleItem)"
                                                        class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="javascript:void(0);" @click="showDeleteModal(singleItem)"
                                                        class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div> <!-- container-fluid -->
        </div>

        <div class="modal fade" id="newRecordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel"> <span v-show="!editmode"> Adding</span> <span
                                v-show="editmode"> Updating</span> {{
                                    item_name
                                }} Information</h5>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="updateRecord()">
                        <div class="modal-body">
                            <!-- <form> -->
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Customer:</label>
                                        <input v-model="form.customer" type="text" class="form-control"
                                            id="recipient-name">
                                    </div>

                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Telephone Number:</label>
                                        <input v-model="form.telephone_number" type="text" class="form-control"
                                            id="recipient-name">
                                    </div>       
                                  
                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Item Description:</label>
                                        <input v-model="form.item_description" type="text" class="form-control"
                                            id="recipient-name">
                                    </div>

                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Total Items:</label>
                                        <input v-model="form.total_items" type="text" class="form-control"
                                            id="recipient-name">
                                    </div>
                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Pick up Location</label>
                                        <input v-model="form.pickup_location" type="text" class="form-control" id="recipient-name">
                                    </div>
                                           
                                </div>
                                <div class="col-lg-6">

                                   

                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Status:</label>                                                                 
                                            <select  v-model="form.status" class="form-select">                                           
                                                <option value="placed">Placed</option>
                                                <option value="assigned">Assigned</option>
                                                <option value="transit">IN Transit</option>
                                                <option value="completed">Completed</option>                                   
                                            </select>                                  
                                    </div>

                                    <div class="mb-2" v-if="form.status === 'assigned'">
                                        <label for="recipient-name" class="col-form-label">Delivery Man</label>
                                        <v-select
                                          id="sort_by_location"
                                          v-model="form.delivery_man_id"
                                          :options="deliverymen"
                                          placeholder="Select deliverymen"
                                          label="fullname"
                                          multiple
                                          :reduce="(fullname) => fullname.id"
                                        ></v-select>
                                      </div>
                                   

                                 
                                    <div class="mb-2">
                                        <label for="recipient-name" class="col-form-label">Charge:</label>
                                        <input v-model="form.total_fees" type="text" class="form-control"
                                            id="recipient-name">
                                    </div>
                                    <div class="mb-2">
                                        <label for="exampleInputPassword2" class="form-control-label">
                                            Item Image</label>
                                        <!-- <img :src="imageAvatar" height="300px" width="100%" /> -->
                                        <img :src="imageAvatar" alt="" class="img-fluid mx-auto d-block">
                                    </div>                            
                                </div>
                               
                                <div class="col-lg-12">
                                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Receiver</th>
                                                <th>Telephone Number</th>
                                                <th>Location</th>                                                                                                         
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                            <tr v-for="singleLocation in form.adressess" :key="singleLocation.id">
                                                <td>{{ singleLocation.name }}</td>
                                                <td>{{ singleLocation.telephone_number }}</td>
                                                <td>{{ singleLocation.location }}</td>                                                                       
                                            </tr>
    
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <!-- </form> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                Operation</button>
                            <button v-if="!isSaving" type="submit" class="btn btn-primary">Save {{ item_name }}</button>

                            <div v-if="isSaving" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="recordDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">{{ item_name }} Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col-lg-6">



                            </div>
                            <div class="col-lg-6"></div>
                        </div>


                        <p class="mb-2">Added On : <span class="text-primary">{{ selectedItem.added_on }}</span></p>
                        <p class="mb-4">Added By: <span class="text-primary">{{ selectedItem.creator }}</span></p>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">

                                <tbody>


                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Name:</h6>
                                        </td>
                                        <td>
                                            {{ selectedItem.name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Description:</h6>
                                        </td>
                                        <td>
                                            {{ selectedItem.description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total Users:</h6>
                                        </td>
                                        <td>
                                            {{ selectedItem.total }}
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

        <div class="modal fade" id="deleteRecordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Wait !!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to delete {{ selectedItem.first_name }} ?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button @click="deleteRecord" type="button" class="btn btn-danger">Yes Delete Record</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { useToast } from "vue-toastification";
// import DataTable from 'datatables.net-vue3';
// import DataTablesCore from 'datatables.net';

import AstronautJSON from './../../lottie/loading_records.json'
export default {



    created() {
        //  [App.vue specific] When App.vue is first loaded start the progress bar

    },
    setup() {

        const toast = useToast();
        return { toast, AstronautJSON }



    },
    components: {

    },

    data() {
        return {

            isLoading: false,
            isSaving: false,

            item_api: "/api/admin/v1/orders",

            item_name: "Order",

            deliverymen_api: "/api/admin/v1/deliveryman",

            imageAvatar: null,

            selectedItem: "",
            required: true,
            editmode: false,
            tableData: [],
           
            deliverymen: [],
            form: new Form({
                customer: "",
                telephone_number:"",
                pickup_location: "",
                item_description: "",          
                delivery_date: "",
                placed_on: "",
                total_items:"",
                delivery_man_id :"",
                mask: "",
                status: "1",       
                profile_image: "",
                profile: "",
                adressess:"",
                total_fees:""
            }),
        };
    },
    mounted() {
        this.getRecords();
        this.getDelivery();

    },

    methods: {


        getDelivery() {
            this.$axios
                .get(this.deliverymen_api)
                .then(({ data }) => {
                    this.deliverymen = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        async getFeaturedImage(e) {
            this.form.profile_image = this.$refs.webfile.files[0];
            let image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = (e) => {
                this.imageAvatar = e.target.result;
            };
        },

        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

        initDatatable() {
            setTimeout(() => {
                $("#datatable").DataTable({
                    dom: 'Bftp',
                    buttons: true,
                    pagingType: "full_numbers",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 100, "All"],
                    ],
                    order: [
                        [0, "asc"],
                        [3, "desc"],
                    ],
                    responsive: true,
                    destroy: true,
                    retrieve: true,
                    autoFill: true,
                    colReorder: true,

                    buttons: [
                        'copy', 'excel', 'pdf', 'print'
                    ]
                });
            }, 300);
        },

        getRecords() {
            this.isLoading = true;
            this.$axios
                .get(this.item_api)
                .then(({ data }) => {
                    this.tableData = data.data;
                    this.initDatatable();

                    this.isLoading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        getRoles() {
            this.$axios
                .get(this.setting_api)
                .then(({ data }) => {
                    this.rolesData = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getRecent() {


            this.$axios
                .get(this.item_api + '/recent/recent')
                .then(({ data }) => {
                    this.recentData = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


        // getRecordDetails() {


        //     let mask = this.$route.params.id;
        //     axios.get(this.item_api + "/" + mask).then(({ data }) => {
        //         this.webAvatar = data.data.web_icon;
        //         this.mobileAvatar = data.data.mobile_icon;
        //         this.bannerAvatar = data.data.banner_image;
        //         this.form.fill(data.data);
        //         this.editmode = true;
        //     });
        // },
        saveRecord() {

            var vm = this;
            vm.isSaving = true;
            let formData = new FormData();

            formData.append("first_name", this.form.first_name);
            formData.append("last_name", this.form.last_name);
            formData.append("title", this.form.title);
            formData.append("telephone_number", this.form.telephone_number);
            formData.append("email", this.form.email);
            formData.append("profile", this.form.profile);
            formData.append("status", this.form.status);
            formData.append("delivery_man_id", this.form.delivery_man_id);
            formData.append("profile_image", this.form.profile_image);
            this.$axios
                .post(this.item_api, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        vm.isSaving = false;
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            } else {
                            }
                        }
                    },
                    function (error) {
                        vm.isSaving = false;
                        if (error.response) {

                            if (error.response.status != 400) {
                                console.log(error.response.data.message);
                                // this.errorToastNoReload(error.response.data.message);
                                vm.toast.error(error.response.data.message);

                            }
                            else {
                                error.response.data.errors.forEach((element) => {
                                    vm.toast.error(element);

                                });
                            }
                        }
                    }
                );
        },

        updateRecord() {
            this.isSaving = false;
            var vm = this;
            let formData = new FormData();
          
            formData.append("delivery_man_id", this.form.delivery_man_id);
            formData.append("status", this.form.status);
            formData.append("total_fees", this.form.total_fees);
            this.$axios
                .post(this.item_api + "/" + this.form.mask, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        vm.isSaving = false;
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            }
                            else if (res.code === 422) {

                            }
                        }
                    },
                    function (error) {
                        if (error.response) {
                            vm.isSaving = false;
                            if (error.response.status != 400) {
                                console.log(error.response.data.message);
                                // vm.errorToastNoReload(error.response.data.message);
                                vm.toast.error(error.response.data.message);
                            }
                            else {
                                error.response.data.errors.forEach((element) => {
                                    vm.toast.error(element);
                                });
                            }
                        }
                    }
                );
        },
        showNewModal() {
            this.form.reset();
            this.isSaving = false;
            this.editmode = false;

            this.imageAvatar = null;
            $("#newRecordModal").modal("show");
        },
        showRecordDetailsModal(record) {
            this.selectedItem = record;
            $("#recordDetailsModal").modal("show");
        },
        showDeleteModal(record) {
            this.selectedItem = record;
            $("#deleteRecordModal").modal("show");
        },

        launchEditModal(record) {
            this.form.reset();
            this.editmode = true;
            this.form.fill(record);
            this.imageAvatar = record.image;
            $("#newRecordModal").modal("show");
        },


        deleteRecord() {
            var vm = this;
            let formData = new FormData();

            this.$axios
                .delete(this.item_api +
                    "/" + this.selectedItem.mask,
                    formData,
                    {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    }
                )
                .then(
                    (response) => {
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            } else {
                            }
                        }
                    },
                    function (error) {
                        if (error.response) {
                            console.log(error.response.data.errors);
                            error.response.data.errors.forEach((element) => {
                                vm.toast.error(element);
                            });
                            // alert(error.response.status);
                        }
                    }
                );
        },
    },
};
</script>

<style></style>


