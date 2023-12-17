<template>
    <div>
        <div class="page-content">
            <div class="container-fluid">



                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">SERMONS :</h4>
                            <div class="page-title-right">
                              
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row" v-show="isLoading">
                    <div class="col-lg-12">
                        <Vue3Lottie :animationData="AstronautJSON" :height="400" :width="400" />

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
                                            <button @click="showNewModal" type="button"
                                                class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2"><i
                                                    class="mdi mdi-plus me-1"></i> Add New {{ item_name }}</button>
                                        </div>
                                    </div><!-- end col-->
                                </div>


                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Title</th>                                         
                                            <th>Thumbnail</th>                                         
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Added On</th>
                                            <th>View </th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr v-for="singleItem in tableData" :key="singleItem.id">
                                            <td>{{ singleItem.title }}</td>

                                            <td>
                                                <div class="table-image">
                                                    <img :src="singleItem.thumbnail
                                                    "  width="50" height="50" class="rounded-circle" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <span v-if="singleItem.status === 1"
                                                    class="badge badge-pill badge-soft-success font-size-12"> {{
                                                        singleItem.status_name }}</span>

                                                <span v-if="singleItem.status === 0"
                                                    class="badge badge-pill badge-soft-danger font-size-12">{{
                                                        singleItem.status_name }}</span>
                                            </td>
                            
                                            <td>{{ singleItem.date }}</td>
                                            <td>{{ singleItem.added_on }}</td>
                                            <td>
                                                <router-link
                                                :to="{
                                                  name: 'viewGallery',
                                                  params: { id: singleItem.mask },
                                                }"
                                              >
                                                <!-- Button trigger modal -->
                                                <button  type="button"
                                                    class="btn btn-primary btn-sm btn-rounded">
                                                    View Details
                                                </button>

                                                </router-link>
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

                    <form @submit.prevent="editmode ? updateRecord() : saveRecord()">
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="recipient-name" class="col-form-label">Service Title:</label>
                                    <input v-model="form.title" type="text" class="form-control" id="recipient-name">
                                </div>

                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Preacher:</label>
                                    <v-select v-model="form.preacher_id" :options="preachersData" placeholder="Select Preacher"
                                        label="fullname" :reduce="fullname => fullname.id"></v-select>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Message Category:</label>
                                    <v-select v-model="form.category_id" :options="messageCategoriesData" placeholder="Select Preacher"
                                        label="name" :reduce="name => name.id"></v-select>
                                </div>

                                <div class="mb-4">
                                    <label for="recipient-name" class="col-form-label">Service Status:</label>
                          
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
    
                                       
                                            <div class="form-check mb-3">
                                                <input  v-model="form.status" value="1" class="form-check-input" type="radio" name="formRadios" id="formRadios1" checked="">
                                                <label class="form-check-label" for="formRadios1">
                                                    Show
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="form-check mb-3">
                                                <input  v-model="form.status" value="0" class="form-check-input" type="radio" name="formRadios" id="formRadios1" checked="">
                                                <label class="form-check-label" for="formRadios1">
                                                    Hide
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="recipient-name" class="col-form-label">Service Date:</label>
                          
                                    <VueDatePicker v-model="form.date" :enable-time-picker="false"  model-type="yyyy-MM-dd"></VueDatePicker>
                                 
                                </div>

                                <div class="mb-2">
                                    <label for="recipient-name" class="col-form-label">Link:</label>
                                    <input v-model="form.link" type="text" class="form-control" id="recipient-name">
                                </div>

    
    
                            </div>
                            <div class="col-lg-6">
                                
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Video Preview:</label>
    
                                    <div style="height: 300px; width: 100%; background-color:#151821;">
                                        <VueYtframe :video-url="form.link"
                                            :player-vars="{ autoplay: 1, listType: 'user_uploads' }" />
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                       

                            <!-- <div class="mb-3">
                            <video-embed :src="form.link"></video-embed>
                        </div> -->
                         

                         
                        

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
        return { toast, AstronautJSON }



    },
    components: {

    },

    data() {
        return {

            isLoading: false,

            isSaving: false,

            item_api: "/api/admin/v1/gallery",
                 item_name: "Gallery",


           
            value: 0,
            webAvatar: null,

            selectedItem: "",
            required: true,
            editmode: false,
          
            tableData: [],
            preachersData: [],
            messageCategoriesData: [],

            form: new Form({
                title: "",
                link: "",
                mask: "",
                category_id:"",
                preacher_id:"",
                status: "1",
                date: "",
           

            }),
        };
    },
    mounted() {
        this.getRecords();
      

    },

    methods: {



        onReady() {
            this.$refs.youtube.playVideo()
        },

        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

         showRemovePreviewImageModal(image) {
      this.selected_image = image;
      $("#exampleModalCenter").modal('show');
    },
    RemovePreviewImage(id) {
      // return;
      var vm = this;

      axios
        .delete(
          "/api/v1/admin/galleries/image/" + this.selected_image.id,

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
                vm.$toasted.show(element);
              });
              // alert(error.response.status);
            }
          }
        );
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
            formData.append("title", this.form.title);
            formData.append("link", this.form.link);         
            formData.append("status", this.form.status);
            formData.append("date", this.form.date);
            formData.append("preacher_id", this.form.preacher_id);
            formData.append("category_id", this.form.category_id);

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
            formData.append("title", this.form.title);
            formData.append("link", this.form.link);         
            formData.append("status", this.form.status);
            formData.append("date", this.form.date);
            formData.append("preacher_id", this.form.preacher_id);
            formData.append("category_id", this.form.category_id);
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


        getPreachers() {
            this.$axios
                .get(this.precher_api)
                .then(({ data }) => {
                    this.preachersData = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        getMessageCategory() {
            this.$axios
                .get(this.message_category_api)
                .then(({ data }) => {
                    this.messageCategoriesData = data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
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


