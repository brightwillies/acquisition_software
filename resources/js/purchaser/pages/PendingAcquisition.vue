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
                                            <th>Title</th>
                                            <th>Purpose</th>
                                            <th>Requested On</th>
                                            <th>HOD Status</th>
                                            <th>Supervisor Status</th>
                                            <th>View </th>
                                            <!-- <th>Options</th> -->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="singleItem in tableData" :key="singleItem.id">
                                            <td>{{ singleItem.title }}</td>
                                            <td>{{ singleItem.purpose }}</td>
                                            <td>{{ singleItem.requested_on }}</td>

                                            <td>
                                                <span v-if="singleItem.hod_status === 'Approved'"
                                                    class="badge badge-pill badge-soft-success font-size-12"> {{
                                                        singleItem.hod_status }}</span>

                                                <span v-if="singleItem.hod_status === 'Received'"
                                                    class="badge badge-pill badge-soft-secondary font-size-12"> {{
                                                        singleItem.hod_status }}</span>
                                                <span v-if="singleItem.hod_status === 'Update'"
                                                    class="badge badge-pill badge-soft-danger font-size-12">{{
                                                        singleItem.hod_status }}</span>
                                            </td>

                                            <td>
                                                <span v-if="singleItem.revised_status === 'Approved'"
                                                    class="badge badge-pill badge-soft-success font-size-12"> {{
                                                        singleItem.revised_status }}</span>

                                                <span v-if="singleItem.revised_status === 'Received'"
                                                    class="badge badge-pill badge-soft-secondary font-size-12"> {{
                                                        singleItem.revised_status }}</span>
                                                <span v-if="singleItem.revised_status === 'Update'"
                                                    class="badge badge-pill badge-soft-danger font-size-12">{{
                                                        singleItem.revised_status }}</span>
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
                                                    <a   v-if="singleItem.hod_status === 'Update'" href="javascript:void(0);" @click="launchEditModal(singleItem)"
                                                        class="text-success"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <!-- <a href="javascript:void(0);" @click="showDeleteModal(singleItem)"
                                                        class="text-danger"><i class="mdi mdi-delete font-size-18"></i></a> -->
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
                                v-show="editmode"> Viewing</span> {{
                                    item_name
                                }} Information</h5>



                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                        <div class="modal-body">
                            <!-- <form> -->

                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label class="col-form-label">Select Department</label>
                                            <div class="col-md-8">
                                              <v-select
                                                id="sort_by_location"
                                                v-model="form.department_id"
                                                :options="departments"
                                                placeholder="Select Department"
                                                label="name"
                                                :reduce="(name) => name.id"
                                              ></v-select>
                                            </div>
                                          </div>

                                        <div class="mb-3">
                                            <label for="productdesc">Items To Acquire </label>
                                            <textarea readonly v-model="form.items" class="form-control" id="productdesc" rows="5"
                                                placeholder=""></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdesc">Purpose of Purchase </label>
                                            <textarea readonly v-model="form.purpose" class="form-control" id="productdesc" rows="5"
                                                placeholder=""></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productname">Place of Use</label>
                                            <input  readonly id="productname" v-model="form.place_of_use" name="productname"
                                                type="text" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label for="manufacturername">Receiving Person / Company </label>
                                            <input  readonly  v-model="form.receiving_company_name" id="manufacturername"
                                                name="manufacturername" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Telephone Number</label>
                                            <input  readonly v-model="form.receiving_company_telephone" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Email</label>
                                            <input  readonly v-model="form.receiving_company_email" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>


                                        <div class="mb-3">
                                            <label class="col-md-4 col-form-label">Method of Payment</label>
                                            <div class="col-md-12">
                                                <select v-model="form.method_of_payment" class="form-select">
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Momo">Momo</option>
                                                    <option value="Cash Cheque">Cash Cheque</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mb-3" v-if="form.method_of_payment == 'Momo'">
                                            <label for="manufacturerbrand">Momo Number </label>
                                            <input id="manufacturerbrand" v-model="form.momo_number"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>

                                        <div class="mb-3" v-if="form.method_of_payment == 'Cash Cheque'">
                                            <label for="manufacturerbrand">Why Cash Cheque </label>
                                            <input id="manufacturerbrand" v-model="form.why_cash_cheque"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>


                                        <div class="form-group">
                                            <button type="button" class="btn btn-secondary" @click.prevent="addFiles()">Add
                                                Files</button>
                                        </div>



                                        <div class="form-group">
                                            <strong>List of uploaded files</strong>
                                            <div
                                              v-for="(file, key ) in  savedFiles"
                                              :key="key"
                                            >{{key+1}}. {{file.file_title}}</div>
                                          </div>

                                        <div class="form-group">
                                            <div v-for="(file, key) in files" :key="key" class="file-listing"
                                                style="margin-bottom:10px;">
                                                {{ file.name }}

                                                <i v-on:click="removeFile(key)" class="fas fa-fw fa-trash"></i>

                                            </div>
                                        </div>


                                    </div>
                                </div>




                            <!-- </form> -->
                        </div>
                        <div class="modal-footer">


                        </div>

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

            savedFiles: [],
            isLoading: false,
            isSaving: false,

            deliverymen_api: "/api/admin/v1/orders",

            item_name: "Pending Request",

            item_api: "/api/purchaser/v1/acquisition/pending-request",
            departments: [],
            imageAvatar: null,

            selectedItem: "",
            required: true,
            editmode: false,
            tableData: [],


            form: new Form({
                items: "",
                purpose: "",
                receiving_company_name: "",
                receiving_company_telephone: "",
                receiving_company_email: "",
                place_of_use: "",
                method_of_payment: "Cheque",
                why_cash_cheque: "",
                momo_number: "",
                department_id:"",

            }),
        };
    },
    mounted() {
        this.getRecords();
        this.getDepartments();

    },

    methods: {

        getDepartments() {
     this.$axios
        .get("/api/purchaser/v1/department")
        .then(({ data }) => {
          this.departments = data.data;
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
            this.savedFiles =record.files;
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


