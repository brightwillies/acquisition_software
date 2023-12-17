<template>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">REQUEST</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <form @submit.prevent="updateRecord()">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- <h4 class="card-title">ACQUISITION  INFORMATION</h4> -->
                                <p class="card-title-desc">READONLY</p>

                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label class="col-form-label">Department</label>
                                            <div class="col-md-8">
                                              <v-select readonly 
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
                                            <label for="manufacturerbrand">Title </label>
                                            <input readonly v-model="form.title" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="productdesc">Items To Acquire </label>
                                            <textarea readonly v-model="form.items" class="form-control" id="productdesc"
                                                rows="5" placeholder=""></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdesc">Purpose of Purchase </label>
                                            <textarea readonly v-model="form.purpose" class="form-control" id="productdesc"
                                                rows="5" placeholder=""></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productname">Place of Use</label>
                                            <input readonly id="productname" v-model="form.place_of_use" name="productname"
                                                type="text" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label for="manufacturername">Receiving Person / Company </label>
                                            <input readonly v-model="form.receiving_company_name" id="manufacturername"
                                                name="manufacturername" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Telephone Number</label>
                                            <input readonly v-model="form.receiving_company_telephone"
                                                id="manufacturerbrand" name="manufacturerbrand" type="text"
                                                class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Email</label>
                                            <input readonly v-model="form.receiving_company_email" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>


                                        <div class="mb-3">
                                            <label class="col-md-4 col-form-label">Method of Payment</label>
                                            <div class="col-md-12">
                                                <select disabled v-model="form.method_of_payment" class="form-select">
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Transfer">Transfer</option>
                                                    <option value="Momo">Momo</option>
                                                    <option value="Cash Cheque">Cash Cheque</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="mb-3" v-if="form.method_of_payment == 'Momo'">
                                            <label for="manufacturerbrand">Momo Number </label>
                                            <input readonly id="manufacturerbrand" v-model="form.momo_number"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>

                                        <div class="mb-3" v-if="form.method_of_payment == 'Cash Cheque'">
                                            <label for="manufacturerbrand">Why Cash Cheque </label>
                                            <input readonly id="manufacturerbrand" v-model="form.why_cash_cheque"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>



                                        <div class="form-group">
                                            <input type="file" id="files" style="display:none;" ref="files" name="files"
                                                multiple accept=".*" v-on:change="handleFilesUpload()" />
                                        </div>

                                        <!-- <div class="form-group">
                                            <strong>Attached Filess</strong>
                                            <div v-for="(file, key ) in  savedFiles" :key="key">{{ key + 1 }}. {{ file.file_title }}
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <strong>Attached Files</strong>
                                            <div v-for="(file, key) in savedFiles" :key="key"
                                                style="margin-top:10px; margin-bottom:10px;">
                                                <a :href="file.file" target="_blank" rel="noopener noreferrer">{{ key + 1
                                                }}. {{ file.file_title }}</a>
                                            </div>
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



                            </div>
                        </div>



                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <!-- <h4 class="card-title">ACQUISITION  INFORMATION</h4> -->
                                <p class="card-title-desc">Fill all information below</p>

                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label class="col-md-12 col-form-label">Status</label>
                                            <div class="col-md-12">
                                                <select v-model="form.hod_status" class="form-select">
                                                    <option value="Received">Received</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Update">Update</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="productdesc">Add Note </label>
                                            <textarea v-model="form.hod_note" class="form-control" id="productdesc" rows="2"
                                                placeholder=""></textarea>
                                        </div>
                                    </div>



                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <button style="width:200px;" type="submit"
                                        class="btn btn-primary waves-effect waves-light">Save
                                        Changes
                                    </button>
                                </div>


                            </div>
                        </div>



                    </div>
                </div>
                <!-- end row -->
            </form>

        </div> <!-- container-fluid -->
    </div>
</template>

<script>
import axios from "axios";
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

            files: [],
            savedFiles: [],
            isLoading: false,
            isSaving: false,


            item_name: "Quote Request",


            item_api: "/api/hod/v1/acquisition",


            imageAvatar: null,

            selectedItem: "",
            required: true,
            editmode: false,
            tableData: [],
            departments: [],

            form: new Form({
                title: "",
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
                mask: "",
                hod_note: "",
                hod_status: "",
                type_of_financial_document: "",
                type_of_transaction: "",
                type_of_expediture: "",
            }),
        };
    },
    mounted() {

        if (this.$route.params.id) {
            this.getRecord();
        }
        this.getDepartments();


    },

    methods: {

        getDepartments() {
     this.$axios
        .get("/api/hod/v1/department")
        .then(({ data }) => {
          this.departments = data.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },

        getRecord() {
            this.editmode = true;
            let gallery_mask = this.$route.params.id;
            axios
                .get("/api/hod/v1/acquisition/" + gallery_mask)
                .then(({ data }) => {
                    this.form.fill(data.data);
                    this.savedFiles = data.data.files;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        addFiles() {
            this.$refs.files.click();
        },

        handleFilesUpload() {
            let uploadedFiles = this.$refs.files.files;

            /*
                Adds the uploaded file to the files array
              */
            for (var i = 0; i < uploadedFiles.length; i++) {
                this.files.push(uploadedFiles[i]);
            }
        },




        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

        updateRecord() {
            this.isSaving = false;
            var vm = this;
            let formData = new FormData();

            formData.append("hod_status", this.form.hod_status);
            formData.append("hod_note", this.form.hod_note);
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




    },
};
</script>

<style></style>


