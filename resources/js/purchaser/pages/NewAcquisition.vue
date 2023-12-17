<template>
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Add New Acquisition</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- <h4 class="card-title">ACQUISITION  INFORMATION</h4> -->
                            <p class="card-title-desc">Fill all information below</p>

                            <form @submit.prevent="editmode ? null : saveRecord()">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Title </label>
                                            <input v-model="form.title" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>

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
                                            <textarea v-model="form.items" class="form-control" id="productdesc" rows="5"
                                                placeholder=""></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="productdesc">Purpose of Purchase </label>
                                            <textarea v-model="form.purpose" class="form-control" id="productdesc" rows="5"
                                                placeholder=""></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="productname">Place of Use</label>
                                            <input id="productname" v-model="form.place_of_use" name="productname"
                                                type="text" class="form-control">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <div class="mb-3">
                                            <label for="manufacturername">Receiving Person / Company </label>
                                            <input v-model="form.receiving_company_name" id="manufacturername"
                                                name="manufacturername" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Telephone Number</label>
                                            <input v-model="form.receiving_company_telephone" id="manufacturerbrand"
                                                name="manufacturerbrand" type="text" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="manufacturerbrand">Receipient Email</label>
                                            <input v-model="form.receiving_company_email" id="manufacturerbrand"
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
                                            <input type="file" id="files" style="display:none;" ref="files" name="files"
                                                multiple accept=".*" v-on:change="handleFilesUpload()" />
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

                                <div class="d-flex flex-wrap gap-2">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                                        Changes
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>



                </div>
            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->
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

            files: [],
            isLoading: false,
            isSaving: false,
            item_name: "Quote Request",
            item_api: "/api/purchaser/v1/acquisition",
            imageAvatar: null,
            selectedItem: "",
            required: true,
            editmode: false,
            tableData: [],
            departments: [],
            form: new Form({
                title:"",
                items: "",
                purpose: "",
                deparment_id:"",
                receiving_company_name: "",
                receiving_company_telephone: "",
                receiving_company_email: "",
                place_of_use: "",
                method_of_payment: "Cheque",
                why_cash_cheque: "",
                momo_number: "",
            }),
        };
    },
    mounted() {
        this.getDepartments();


    },

    methods: {

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


        modalClose() {
            $("#newRecordModal").modal("hide");
        },
        DeleteModalClose() {
            $("#deleteRecordModal").modal("hide");
        },

        saveRecord() {
            var vm = this;
            vm.isSaving = true;
            let formData = new FormData();
            formData.append("items", this.form.items);
            formData.append("title", this.form.title);
            formData.append("department_id", this.form.department_id);
            formData.append("purpose", this.form.purpose);
            formData.append("receiving_company_name", this.form.receiving_company_name);
            formData.append("receiving_company_telephone", this.form.receiving_company_telephone);
            formData.append("receiving_company_email", this.form.receiving_company_email);
            formData.append("place_of_use", this.form.place_of_use);
            formData.append("method_of_payment", this.form.method_of_payment);
            formData.append("why_cash_cheque", this.form.why_cash_cheque);
            formData.append("momo_number", this.form.momo_number);
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];
                formData.append("files[" + i + "]", file);
            }
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




    },
};
</script>

<style></style>


