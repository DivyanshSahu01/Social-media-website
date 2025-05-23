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
                    <div class="sign-in-from" v-if="!resetPasswordMode">
                        <h1 class="mb-0">Sign in</h1>
                        <form class="mt-4" id="loginForm" @submit.prevent="login()" novalidate>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control mb-0" id="exampleInputEmail1" placeholder="Enter email" v-model="loginForm.email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputPassword1">Password</label>
                                <a href="javascript:void(0)" @click="showResetPasswordForm()" class="float-end">Forgot password?</a>
                                <input type="password" name="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" v-model="loginForm.password" required>
                            </div>
                            <div class="d-inline-block w-100">
                                <div class="form-check d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="form-check-input" id="customCheck11">
                                    <label class="form-check-label" for="customCheck11">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Sign in</button>
                            </div>
                            <div class="sign-info">
                                <span class="dark-color d-inline-block line-height-2">Don't have an account? <a href="/sign-up">Sign up</a></span>
                                <ul class="iq-social-media">
                                    <li><a href="/auth/google"><i class="ri-google-line"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="sign-in-from" v-if="resetPasswordMode && !mailSent">
                        <h1 class="mb-0">Reset Password</h1>
                        <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>
                        <form class="mt-4" id="resetPasswordForm" @submit.prevent="sendResetPasswordLink()" novalidate>
                            <div class="form-group">
                                <label class="form-label" for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control mb-0" v-model="resetForm.email" id="exampleInputEmail1" placeholder="Enter email" required>
                            </div>
                            <div class="d-inline-block w-100">
                                <button type="submit" class="btn btn-primary float-right">Reset Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="sign-in-from" v-if="resetPasswordMode && mailSent">
                        <img src="../assets/images/login/mail.png" width="80" alt="">
                        <h1 class="mt-3 mb-0">Success !</h1>
                        <p>A email has been sent to @{{resetForm.email}}. Please check for an email from {{env('APP_NAME')}} and click on the included link to reset your password.</p>
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
                errorMsg: '',
                resetPasswordMode: false,
                mailSent: false
            }
        },
        methods: 
        {
            showResetPasswordForm(){
                this.resetPasswordMode = true;
            },
            async sendResetPasswordLink()
            {
                if(!document.getElementById('resetPasswordForm').checkValidity()) return false;

                axios.post('api/mail/resetPassword', this.resetForm)
                .then(response => {
                    this.mailSent = true;
                });
            },
            async login() 
            {
                if(!document.getElementById('loginForm').checkValidity()) return false;
                
                axios.post('/login', this.loginForm)
                .then(response => {
                    window.location.href = response.data.redirect;
                });
            }
        }
    });

    app.mount('#app');
    </script>
@endsection