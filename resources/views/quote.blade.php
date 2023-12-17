<!doctype html>
<html class="no-js" lang="zxx">
<head>
@include('includes.head')
</head>

<body>
   <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->
   <!-- Preloader start -->
   <div class="preloader">
      <img src="assets/img/logo/preloader-icon.gif" alt="preloader-icon">
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
                     <h3 class="page-title mb-25">quote</h3>
                     <div class="breadcrumb-menu">
                        <nav aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                           <ul class="trail-items">
                              <li class="trail-item trail-begin"><a href="index.html"><span>Home</span></a></li>
                              <li class="trail-item trail-end"><span>quote</span></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- page title area end -->

      <!-- quote area start -->
      <div class="order__form-details pt-120 pb-90">
         <div class="container">
            <div class="row">
               <div class="col-xxl-3 col-xl-3 col-lg-12">
                  <div class="quote-tab mb-30">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                              <span class="order__form-button">
                              <i class="fas fa-box"></i>
                              <span>Request A Quote</span>
                              </span>
                           </button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                              <span class="order__form-button">
                                 <i class="fas fa-map-marker-alt"></i>
                                 <span>Track and Trace</span>
                              </span>
                           </button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">
                              <span class="order__form-button">
                                 <i class="fas fa-truck"></i>
                                 <span>Custom Order</span>
                              </span>
                           </button>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-xxl-9 col-xl-8 col-lg-12">
                  <div class="quote-features mb-30">
                     <div class="tab-content">
                     <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="product-action">
                           <form action="#">
                              <div class="product__data">
                                 <label>Personal Data</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Name">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Email">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Phone">
                                    </div>
                                 </div>
                              </div>
                              <div class="product__data">
                                 <label>Shipment Data</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                          <select name="freight" id="freight2">
                                             <option value="1">Freight Type
                                             </option>
                                             <option value="2">Freight Type
                                             </option>
                                             <option value="3">Freight Type
                                             </option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="City of Departure">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Delivery City">
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                          <select name="Incoterms" id="Incoterms">
                                             <option value="1">Incoterms</option>
                                             <option value="2">Incoterms</option>
                                             <option value="3">Incoterms</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="row product__weight">
                                          <div class="col-6">
                                             <input type="text" placeholder="Weight">
                                          </div>
                                          <div class="col-6">
                                             <input type="text" placeholder="Height">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="row product__area">
                                          <div class="col-6">
                                             <input type="text" placeholder="Width">
                                          </div>
                                          <div class="col-6">
                                             <input type="text" placeholder="Length">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="product__check mb-20">
                                 <div class="check-item">
                                    <label class="sign-check" for="Fragile"><span>Fragile</span></label>
                                    <input class="e-check-input" type="checkbox" id="Fragile">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Delivery"><span>xpress Delivery</span></label>
                                    <input class="e-check-input" type="checkbox" id="Delivery">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Insurance"><span>Insurance</span></label>
                                    <input class="e-check-input" type="checkbox" id="Insurance">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Packaging"><span>Packaging</span></label>
                                    <input class="e-check-input" type="checkbox" id="Packaging">
                                 </div>
                              </div>
                              <button class="fill-btn justify-content-center w-100 request-quote shutter-btn" type="submit">Request for A Quote</button>
                           </form>
                        </div>
                     </div>
                     <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="#">
                           <div class="product__data">
                              <label for="id">Your Order ID</label>
                              <input type="text" id="id" placeholder="Your ID">
                              <label>Your Message</label>
                              <textarea name="message" id="message" cols="30" rows="10" placeholder="Write Message..." spellcheck="false"></textarea>
                              <button type="submit" class="fill-btn justify-content-center w-100">Send
                              Query</button>
                           </div>
                        </form>
                     </div>
                     <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                        <div class="product-action">
                           <form action="#">
                              <div class="product__data">
                                 <label>Personal Data</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Name">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Email">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Phone">
                                    </div>
                                 </div>
                              </div>
                              <div class="product__data">
                                 <label>Shipment Data</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                          <select name="freight" id="freight">
                                             <option value="1">Freight Type
                                             </option>
                                             <option value="2">Freight Type
                                             </option>
                                             <option value="3">Freight Type
                                             </option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="City of Departure">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" placeholder="Delivery City">
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                          <select name="Incoterms" id="Incoterms2">
                                             <option value="1">Incoterms</option>
                                             <option value="2">Incoterms</option>
                                             <option value="3">Incoterms</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="row product__weight">
                                          <div class="col-6">
                                             <input type="text" placeholder="Weight">
                                          </div>
                                          <div class="col-6">
                                             <input type="text" placeholder="Height">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <div class="row product__area">
                                          <div class="col-6">
                                             <input type="text" placeholder="Width">
                                          </div>
                                          <div class="col-6">
                                             <input type="text" placeholder="Length">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="product__check mb-20">
                                 <div class="check-item">
                                    <label class="sign-check" for="Fragile2"><span>Fragile</span></label>
                                    <input class="e-check-input" type="checkbox" id="Fragile2">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Delivery2"><span>xpress Delivery</span></label>
                                    <input class="e-check-input" type="checkbox" id="Delivery2">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Insurance2"><span>Insurance</span></label>
                                    <input class="e-check-input" type="checkbox" id="Insurance2">
                                 </div>
                                 <div class="check-item">
                                    <label class="sign-check" for="Packaging2"><span>Packaging</span></label>
                                    <input class="e-check-input" type="checkbox" id="Packaging2">
                                 </div>
                              </div>
                              <button class="fill-btn justify-content-center w-100 request-quote shutter-btn" type="submit">Request for A Quote</button>
                           </form>
                        </div>
                     </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- quote area end -->

   </main>
   <!-- footer area start  -->

   @include('includes.footer')
</body>
</html>