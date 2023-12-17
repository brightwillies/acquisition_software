<template>
    <div>
        <div class="page-content">
            <div class="container-fluid">

            

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">DEPARTMENTS :</h4>
                            <div class="page-title-right">
                            </div>

                        </div>
                    </div>

                   
                 </div>
                
                 <div class="row" v-show="isLoading">
                    <div class="col-lg-12">
                        <Vue3Lottie :animationData="AstronautJSON" :height="500" :width="500" />

                    </div>
                 </div>

                <div class="row"  v-show="!isLoading">       
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-sm-4">

                                    </div>
                                    <div class="col-sm-8">
                                        <div class="text-sm-end">
                                            <button @click="showNewModal" type="button"
                                                class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-plus me-1"></i> Add New {{ item_name }}</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>


                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                             <th>Name</th>                                     
                                            <th>Current Head</th>
                                     
                                            <th>View </th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="singleItem in tableData" :key="singleItem.id">
                                            <td>{{ singleItem.name }}</td>
                                            <td>{{ singleItem.head }}</td>
                                               <td>
                                                <!-- Button trigger modal -->
                                                <button @click="showRecordDetailsModal(singleItem)" type="button"
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
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">


                        <h5 class="modal-title" id="exampleModalLabel"> <span v-show="!editmode"> Adding</span> <span
                                v-show="editmode"> Updating</span> {{
                                    item_name
                                }} Information</h5>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form @submit.prevent="editmode ? updateRecord() : saveRecord()">
                        <div class="modal-body">
                            <!-- <form> -->
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input v-model="form.name" type="text" class="form-control" id="recipient-name">
                            </div>

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Description:</label>
                                <input v-model="form.description" type="text" class="form-control" id="recipient-name">
                            </div>                     
                            <!-- </form> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                Operation</button>
                            <button  v-if="!isSaving" type="submit" class="btn btn-primary">Save {{ item_name }}</button>

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
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">{{ item_name }} Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                        <h4>Are you sure you want to delete {{ selectedItem.name }} ?</h4>
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
        return { toast , AstronautJSON }
        

      
    },
    components: {

    },
 
    data() {
        return {

            isLoading: false,

            isSaving : false,

            item_api: "/api/admin/v1/department",
            item_name: "Department",
            value: 0,
            webAvatar: null,

            selectedItem: "",
            required: true,
            editmode: false,
            tableData: [],
            recentData: [],
            regions: [],
            form: new Form({
                name: "",
                mask: "",
                status: "1",
    
            }),
        };
    },
    mounted() {
        this.getRecords();

    },

    methods: {


        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },


        initDatatable() {
            setTimeout(() => {
                $("#datatable").DataTable({
                    dom: 'ftp',
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


        getRecordDetails() {

       
            let mask = this.$route.params.id;
            axios.get(this.item_api + "/" + mask).then(({ data }) => {
                this.webAvatar = data.data.web_icon;
                this.mobileAvatar = data.data.mobile_icon;
                this.bannerAvatar = data.data.banner_image;
                this.form.fill(data.data);
                this.editmode = true;
            });
        },
        saveRecord() {
            this.isSaving = true;
            var vm = this;
            let formData = new FormData();
            formData.append("name", this.form.name);
              this.$axios
                .post(this.item_api, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        this.isSaving = false;
                        if (response) {
                            const res = response.data;

                            if (res.code === 200) {
                                this.successToastReloadPage(res.message);
                            } else {
                            }
                        }
                    },
                    function (error) {
                        this.isSaving = false;
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
            this.loading = true;
            var vm = this;
            let formData = new FormData();
            formData.append("name", this.form.name);
            this.$axios
                .post(this.item_api + "/" + this.form.mask, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(
                    (response) => {
                        this.loading = false;
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


