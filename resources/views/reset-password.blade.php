@extends('includes/root')
@section('main')
    <div class="wrapper">
    <section class="sign-in-page">
        <div id="container-inside">
            <div id="circle-small"></div>
            <div id="circle-medium"></div>
            <div id="circle-large"></div>
            <div id="circle-xlarge"></div>
            <div id="circle-xxlarge"></div>
        </div>
        <div class="container p-0">
            <div class="row no-gutters">
                <div class="col-md-6 text-center pt-5">
                    <div class="sign-in-detail text-white">
                        <a class="sign-in-logo mb-5" href="#"><img src="../assets/images/logo-full.png" class="img-fluid" alt="logo"></a>
                        <div class="sign-slider overflow-hidden ">
                            <ul  class="swiper-wrapper list-inline m-0 p-0 ">
                                <li class="swiper-slide">
                                    <img src="../assets/images/login/1.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Find new friends</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </li>
                                <li class="swiper-slide">
                                    <img src="../assets/images/login/2.png" class="img-fluid mb-4" alt="logo"> 
                                    <h4 class="mb-1 text-white">Connect with the world</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </li>
                                <li class="swiper-slide">
                                    <img src="../assets/images/login/3.png" class="img-fluid mb-4" alt="logo">
                                    <h4 class="mb-1 text-white">Create new events</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-white pt-5 pt-5 pb-lg-0 pb-5">
                    <div class="sign-in-from">
                        <h1 class="mb-0">Reset Password</h1>
                        <form class="mt-4" id="resetPasswordForm" @submit.prevent="sendResetPasswordLink()" novalidate>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">New password</label>
                                <input type="password" class="form-control mb-0" v-model="resetForm.password" id="exampleInputEmail1" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Confirm password</label>
                                <input type="password" class="form-control mb-0" v-model="resetForm.confirmPassword" id="exampleInputEmail1" placeholder="Confirm password" required>
                            </div>
                            <div class="d-inline-block w-100">
                                <button type="submit" class="btn btn-primary float-right">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>   
      </div>
    
    <!-- Backend Bundle JavaScript -->
    <script src="../assets/js/libs.min.js"></script>
    <!-- slider JavaScript -->
    <script src="../assets/js/slider.js"></script>
    <!-- masonry JavaScript --> 
    <script src="../assets/js/masonry.pkgd.min.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/enchanter.js"></script>
    <!-- SweetAlert JavaScript -->
    <script src="../assets/js/sweetalert.js"></script>
    <!-- app JavaScript -->
    <script src="../assets/js/charts/weather-chart.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
    <script src="../assets/js/lottie.js"></script>
    
    <script>
        const csrf = '{{ csrf_token() }}';
        const app = Vue.createApp({
        data() {
            return {
                loginForm: {},
                resetForm: {},
                errorMsg: ''
            }
        },
        methods: 
        {
            async sendResetPasswordLink()
            {
                if(!document.getElementById('resetPasswordForm').checkValidity()) return false;

                axios.post("api/user/resetPassword", {
                    'email': "{{$_GET['email']}}",
                    'password': this.resetForm.password,
                    'password_confirmation': this.resetForm.confirmPassword,
                    'token': "{{$_GET['token']}}"
                })
                .then(response => {
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 4000);
                });
            }
        }
    });

    app.mount('#app');
    </script>
@endsection