<!doctype html>
<html class="no-js" lang="zxx">
   <head>
      @include('includes.head')
   </head>
   <body>
      <div class="preloader">
         <img src="/assets/img/logo/preloader-icon.gif" alt="preloader-icon">
      </div>
      <!-- Preloader end -->
      <!-- header area start  -->
      @include('includes.header')
      <!-- Add your site or application content here -->
      <main>
         <!-- page title area  -->
         <section class="page-title-area breadcrumb-spacing" data-background="assets/img/breadcrumb/breadcrumb-bg.png">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-9">
                     <div class="page-title-wrapper text-center">
                        <h3 class="page-title mb-25">Register</h3>
                        <div class="breadcrumb-menu">
                           <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                              <ul class="trail-items">
                                 <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                                 <li class="trail-item trail-end"><span>Register</span></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="login__area pt-110 pb-110">
            <div class="container">
               <div class="login__inner p-relative z-index-1">
                  <div class="row justify-content-center">
                     <div class="col-xl-6 col-lg-8 col-md-10">
                        <div class="login__wrapper">
                           <div class="login__top mb-30 text-center">
                              <h3 class="login__title"> Register Now!</h3>
                              <p>You can signup here</p>
                           </div>
                           <div class="login__form">
                              <form>
                                 <div class="login__input-wrapper">
                                    <div class="login__input-item">
                                       <div class="login__input">
                                          <input name="name" type="text" placeholder="Enter your name" id="name" required="" value="">
                                          <span>
                                             <svg width="17" height="19" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 9C11.2091 9 13 7.20914 13 5C13 2.79086 11.2091 1 9 1C6.79086 1 5 2.79086 5 5C5 7.20914 6.79086 9 9 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.5 17.6C15.5 14.504 12.3626 12 8.5 12C4.63737 12 1.5 14.504 1.5 17.6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="login__input-item">
                                       <div class="login__input">
                                          <input name="email" type="email" placeholder="Enter your email" id="email" required="" value="">
                                          <span>
                                             <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.5 12.9H4.5C2.4 12.9 1 11.85 1 9.4V4.5C1 2.05 2.4 1 4.5 1H11.5C13.6 1 15 2.05 15 4.5V9.4C15 11.85 13.6 12.9 11.5 12.9Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M11.5 4.85059L9.309 6.60059C8.588 7.17459 7.405 7.17459 6.684 6.60059L4.5 4.85059" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="login__input-item">
                                       <div class="login__input-item-inner p-relative">
                                          <div class="login__input">
                                             <input name="password" type="password" placeholder="Password" id="password" required="" value="">
                                             <span>
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M4.20312 7.4V5.8C4.20312 3.152 5.00312 1 9.00312 1C13.0031 1 13.8031 3.152 13.8031 5.8V7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path d="M9 14.2C10.1046 14.2 11 13.3045 11 12.2C11 11.0954 10.1046 10.2 9 10.2C7.89543 10.2 7 11.0954 7 12.2C7 13.3045 7.89543 14.2 9 14.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path d="M13 17H5C1.8 17 1 16.2 1 13V11.4C1 8.20002 1.8 7.40002 5 7.40002H13C16.2 7.40002 17 8.20002 17 11.4V13C17 16.2 16.2 17 13 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                             </span>
                                          </div>
                                          <span class="login-input-eye">
                                             <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.4028 7.1025L6.60781 10.8975C6.12031 10.41 5.82031 9.7425 5.82031 9C5.82031 7.515 7.02031 6.315 8.50531 6.315C9.24781 6.315 9.91531 6.615 10.4028 7.1025Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12.86 4.32748C11.5475 3.33748 10.0475 2.79749 8.495 2.79749C5.8475 2.79749 3.38 4.35748 1.6625 7.05748C0.9875 8.11498 0.9875 9.89248 1.6625 10.95C2.255 11.88 2.945 12.6825 3.695 13.3275" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M5.82031 14.6475C6.67531 15.0075 7.58281 15.2025 8.50531 15.2025C11.1528 15.2025 13.6203 13.6425 15.3378 10.9425C16.0128 9.88504 16.0128 8.10754 15.3378 7.05004C15.0903 6.66004 14.8203 6.29254 14.5428 5.94754" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M11.1306 9.52505C10.9356 10.5826 10.0731 11.4451 9.01562 11.6401" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M6.6025 10.8975L1 16.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16.0009 1.5L10.3984 7.1025" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                          </span>
                                       </div>
                                    </div>
                                    <div class="login__input-item">
                                       <div class="login__input-item-inner p-relative">
                                          <div class="login__input">
                                             <input name="passwordConfirmation" type="password" placeholder="Confirm Password" id="passwordConfirmation" required="" value="">
                                             <span>
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M4.20312 7.4V5.8C4.20312 3.152 5.00312 1 9.00312 1C13.0031 1 13.8031 3.152 13.8031 5.8V7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path d="M9 14.2C10.1046 14.2 11 13.3045 11 12.2C11 11.0954 10.1046 10.2 9 10.2C7.89543 10.2 7 11.0954 7 12.2C7 13.3045 7.89543 14.2 9 14.2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                   <path d="M13 17H5C1.8 17 1 16.2 1 13V11.4C1 8.20002 1.8 7.40002 5 7.40002H13C16.2 7.40002 17 8.20002 17 11.4V13C17 16.2 16.2 17 13 17Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                             </span>
                                          </div>
                                          <span class="login-input-eye">
                                             <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.4028 7.1025L6.60781 10.8975C6.12031 10.41 5.82031 9.7425 5.82031 9C5.82031 7.515 7.02031 6.315 8.50531 6.315C9.24781 6.315 9.91531 6.615 10.4028 7.1025Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12.86 4.32748C11.5475 3.33748 10.0475 2.79749 8.495 2.79749C5.8475 2.79749 3.38 4.35748 1.6625 7.05748C0.9875 8.11498 0.9875 9.89248 1.6625 10.95C2.255 11.88 2.945 12.6825 3.695 13.3275" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M5.82031 14.6475C6.67531 15.0075 7.58281 15.2025 8.50531 15.2025C11.1528 15.2025 13.6203 13.6425 15.3378 10.9425C16.0128 9.88504 16.0128 8.10754 15.3378 7.05004C15.0903 6.66004 14.8203 6.29254 14.5428 5.94754" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M11.1306 9.52505C10.9356 10.5826 10.0731 11.4451 9.01562 11.6401" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M6.6025 10.8975L1 16.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M16.0009 1.5L10.3984 7.1025" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="login__option mb-25 d-sm-flex justify-content-between">
                                    <div class="login__remember"><input type="checkbox" id="tp-remember"><label for="tp-remember">Remember me</label></div>
                                 </div>
                                 <div class="login__btn text-center"><button type="submit" class="fill-btn clip-btn">Sign Up</button></div>
                              </form>
                              <div class="login__register-now">
                                 <p>Already have an account? <a href="/login">Log in</a></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- contact area end -->
      </main>
      <!-- footer area start  -->
      @include('includes.footer')
</html>