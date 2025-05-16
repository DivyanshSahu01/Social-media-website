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
                        <h1 class="mb-0" v-if="!mailSent">Sign Up</h1>
                        <form class="mt-4" @submit.prevent="signIn()">
                            <span v-if="!mailSent">
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail1">Your Full Name</label>
                                    <input type="text" class="form-control mb-0" id="exampleInputEmail1" placeholder="Your Full Name" v-model="formData.name">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputEmail2">Email address</label>
                                    <input type="email" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter email" v-model="formData.email">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Password" v-model="formData.password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control mb-0" id="exampleInputPassword1" placeholder="Confirm Password" v-model="formData.password_confirmation">
                                </div>
                            </span>
                            <span v-if="mailSent">
                                <img src="../assets/images/login/mail.png" width="80"  alt="">
                                <h1 class="mt-3 mb-0">Success !</h1>
                                <p>A email has been send to @{{formData.email}}. Please enter the otp to complete the sign up process.</p>
                                <div class="form-group">
                                    <label class="form-label" for="exampleInputPassword1">OTP</label>
                                    <input type="text" class="form-control mb-0" maxlength="6" id="exampleInputPassword1" placeholder="OTP" v-model="formData.OTP">
                                </div>
                            </span>
                            <div class="d-inline-block w-100">
                                <div class="form-check d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="form-check-input" id="customCheck1">
                                    <label class="form-check-label" for="customCheck1">I accept <a href="#">Terms and Conditions</a></label>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Sign Up</button>
                            </div>
                            <div class="sign-info">
                                <span class="dark-color d-inline-block line-height-2">Already Have Account ? <a href="/">Log In</a></span>
                                <ul class="iq-social-media">
                                    <li><a href="/auth/google"><i class="ri-google-line"></i></a></li>
                                </ul>
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
                    formData: {},
                    mailSent: false
                }
            },
            methods: 
            {
                async sendMail()
                {
                    axios.post('api/mail/register', this.formData).then(response => {
                        this.mailSent = true;
                    });
                },
                signIn() 
                {
                    if(this.mailSent)
                        this.register();
                    else
                        this.sendMail();
                },
                async register() 
                {
                    axios.post('register', this.formData).then(response => {
                        window.location.href = response.data.redirect;
                    });
                }
            }
        });

        app.mount('#app');
    </script>
@endsection