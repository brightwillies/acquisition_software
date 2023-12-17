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
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                   
                      
                     </ul>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-12">
                     <div class="row">
                     <div class="form-group">
            <label>Location/City/Address</label>
            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
        </div>
        <div class="form-group" id="latitudeArea">
            <label>Latitude</label>
            <input type="text" id="latitude" name="latitude" class="form-control">
        </div>
        <div class="form-group" id="longtitudeArea">
            <label>Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control">
        </div>
                     </div>
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
                                       <input type="text" name="name" placeholder="Name">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text"  name="email" placeholder="Email">
                                    </div>
                                    <div class="col-lg-4">
                                       <input type="text" name="telephone_number" placeholder="Phone">
                                    </div>
                                 </div>
                              </div>
                              <div class="product__data">
                                 <label>Pick up Location</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                    
                                          <select  class="nice-select regionSelect" name="freight" id="pick_up_region">
                                          <option value="0" disabled>Select Region</option>
                                          @foreach($regions as $singleRegion)
                                             <option value="{{$singleRegion->id}}">{{$singleRegion->name}}
                                             </option>
                                          @endforeach
                                          
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pr-select"> 
                                    
                                          <select class="nice-select"  name="freight" id="pick_up_city">
                                          <option value="0" disabled selected>Select City / Area</option>
                                          </select>
                                       </div>
                                    </div>
                                  
                                    <div class="col-lg-4">
                                       <input type="text" name="address" placeholder="Address">
                                    </div>

                                    <div class="col-lg-12">
                                    <input id="autocomplete" placeholder="Enter your address" type="text"></input>

                                    </div>
                                 
                                    <div class="col-lg-4">
                                    <input type="file" id="imageInput" accept="image/*">
                                    <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; display: none;">
  
                                    </div>
                                    <div class="col-lg-4">
                                       <div class=" product__weight">
                                         
                                             <input type="text" placeholder="Weight">
                                       
                                       </div>
                                    </div>
                                  
                                 </div>
                              </div>
                           
                              <div class="product__data">
                                 <label>Destination</label>
                                 <div class="row">
                                    <div class="col-lg-4">
                                       <div class="pr-select">
                                    
                                          <select  class="nice-select regionSelect" name="freight" id="pick_up_region">
                                          <option value="0" disabled>Select Region</option>
                                          @foreach($regions as $singleRegion)
                                             <option value="{{$singleRegion->id}}">{{$singleRegion->name}}
                                             </option>
                                          @endforeach
                                          
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="pr-select"> 
                                    
                                          <select class="nice-select"  name="freight" id="pick_up_city">
                                          <option value="0" disabled selected>Select City / Area</option>
                                          </select>
                                       </div>
                                    </div>
                                  
                                    <div class="col-lg-4">
                                       <input type="text" name="address" placeholder="Address">
                                    </div>
                                 
                  
                                  
                                 </div>
                              </div>
                           
                              <button class="fill-btn justify-content-center w-100 request-quote shutter-btn" type="submit">Place Order</button>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- <script type="text/javascript"  src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}" > </script> -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAP_KEY')}}&libraries=places" ></script>
 
    
<script>
    $(document).ready(function () {
        $("#latitudeArea").addClass("d-none");
        $("#longtitudeArea").addClass("d-none");
    });
</script>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place);
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());
            $("#latitudeArea").removeClass("d-none");
            $("#longtitudeArea").removeClass("d-none");
        });
    }
</script>
    <script>



     

// image preview
   const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function(event) {
      const selectedImage = event.target.files[0];
      
      if (selectedImage) {
        imagePreview.style.display = 'block';
        const reader = new FileReader();

        reader.onload = function(event) {
          imagePreview.src = event.target.result;
        };

        reader.readAsDataURL(selectedImage);
      } else {
        imagePreview.style.display = 'none';
        imagePreview.src = '#';
      }
    });



$(document).ready(function() {
   $("#pick_up_region").on("change", function() {
var regionId = $(this).val(); // Get the selected region's value
   $.ajax({
    url: '/api/get-cities/' + regionId,
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        // Clear existing options from pick_up_city select element
        $("#pick_up_city").empty();

        var cities = data.cities;
        var pickUpCitySelect = document.getElementById("pick_up_city");

         let out = "";
        out += ` <option  value="" disabled selected hidden>Select Pick Up City</option> `;
     for(let city of cities){
       out += `<option  ' value="${city.id}">${city.name}</otion>`;
         }
                pickUpCitySelect.innerHTML = out;
    },
    error: function(error) {
        console.error("Error fetching cities:", error);
    }
});
});
});


</script>



</body>
</html>