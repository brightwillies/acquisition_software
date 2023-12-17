
<template>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>Sign in to continue to Skote.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="/bassets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="/purchaser-login" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/bassets/images/logo-light.svg" alt="" class="rounded-circle"
                                                height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="/purchaser-login" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/bassets/images/logo.svg" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" @submit.prevent="adminLogin">

                                    <div class="mb-3">
                                        <label for="username" class="form-label">User email</label>
                                        <input type="text" class="form-control" v-model="email" id="username"
                                            placeholder="Enter username">

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" v-model="password"
                                                placeholder="Enter password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>



                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>

                                    <div class="mt-4 text-center">

                                    </div>

                                    <div class="mt-4 text-center">
                                        <a href="" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your
                                            password?</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { required, email } from "vuelidate/lib/validators";
import store  from './../store.js';
export default {
    data() {
        return {
            email: "devbrightwillies@gmail.com",
            password: "Wealth@2022!!..",
            submitted: false
        };
    },
    computed: {
       
    },
    created() {


    },
    validations: {
        email: { required, email },
        password: { required }
    },
    methods: {

        adminLogin() {
          
            var vm = this;
            let formData = new FormData();
            formData.append("email", this.email);
            formData.append("password", this.password);
            this.$axios
                .post("/api/purchaser/v1/auth/login", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(

                    (response) => {
                        if (response) {
                
                            const res = response.data;
                            console.log(res);
                            if (res.code == 200) {
                                var userData = res.data;

                                localStorage.setItem("acidms_platform_purchaser", userData.user.mask);
                                localStorage.setItem("acidms_platform_purchaser_firstname", userData.user.first_name);
                                localStorage.setItem("acidms_platform_purchaser_pass", userData.token);
                                // axios.defaults.headers.common["Authorization"] =
                                //     "Bearer " + userData.token;
                                store.commit("loginUser");
                                 this.successToastRedirect(res.message, "/purchaser-dashboard");
                                // this.successToastRedirect(res.message, "/superadmin-dashboard");
                            } else {
                                vm.$toasted.show(res.message);
                            }
                        }
                    },
                    function (error) {
                        if (error.response) {

                            if (error.response.status != 400) {
                                console.log(error.response.data.message);
                                vm.errorToastNoReload(error.response.data.message);
                                // vm.$toasted.show(error.response.data.message);
                            }
                            else {
                                error.response.data.errors.forEach((element) => {
                                    vm.$toasted.show(element);
                                });
                            }
                        }
                    }
                );

        }


    }
};
</script>

<style scoped></style>