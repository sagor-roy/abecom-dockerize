function showOffer(){
    $("#offer-list").css({
        'display': 'block'
    })
}
function hideOffer(){
     $("#offer-list").hide()
}

$(document).ready(function(){



   //ongoing offer
   $(".ongoing-offer .offer_filter ul li").click(function(){
       $(".loader").show()
       let $this = $(this)
       let id = $this.attr('data-id');

       $.ajax({
           type: "GET",
           url: "/home/offer/filter/"+id,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response){
               $(".loader").hide()
               $this.closest(".offer_filter").closest(".row").closest(".ongoing-offer").find(".offer-product-row .col-md-2").remove();

               $this.closest(".offer_filter").closest(".row").closest(".ongoing-offer").find(".offer-product-row").append(`
                   <div class="col-md-2 col-6 offer-countdown-block">
                       <a href='${response.url}' class='offer_single'>
                       <h2 class="text-center mt-3">${response.name}</h2 >
                       <p style="text-align: center; color:#000000; font-weight: bold">${response.content}</p>

                       <a class="banner-button" href="${response.url}">Offer Now</a>
                       <div class="offer-countdown">
                           <p class="text-center">Hurry up! Offer ends in :</p>
                               <ul>
                                   <li>
                                       <span class="day">${response.day[0]}</span>
                                       <p>D</p>
                                   </li>
                                   <li>
                                       <span class="hour">${response.hour[0]}</span>
                                       <p>H</p>
                                   </li>
                                   <li>
                                       <span class="minute">${response.minute[0]}</span>
                                       <p>M</p>
                                   </li>
                                   <li>
                                       <span class="second">60</span>
                                       <p>S</p>
                                   </li>
                               </ul>
                           </div>
                       </a>
                   </div>
               `);

               $.each(response.products, (key, value) => {
                   $this.closest(".offer_filter").closest(".row").closest(".ongoing-offer").find(".offer-product-row").append(`

                       <div class="col-md-2 col-6" style="padding: 0">
                           <div class="product-box">
                               <a href="${value.product_detail}">
                                   <img src="${value.image}"
                                       class="img-fluid" alt="">
                               </a>

                               <!-- discount start -->
                               <div class="product-discount">
                                    <p>- ${response.discount}</p>
                               </div>
                               <!-- discount end -->

                               <a href="${value.product_detail}" class="product_name">${value.name}</a>
                               <div class="row">
                                <div class="col-md-6 col-6">
                                           <p class="regular_price" style="text-align: left">
                                               ৳ ${value.price}
                                           </p>
                                   </div>
                                   <div class="col-md-6 col-6">
                                           <p class="offer_price" style="text-align: right">
                                               ৳ ${value.offer_price}
                                           </p>
                                   </div>
                               </div>

                               <!-- product info start -->
                               <div class="product-info">
                               <div class="row">
                                   <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                       <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                           <i class="fas fa-heart"></i>
                                       </p>
                                   </div>
                                   <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                       <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                           <i class="fas fa-balance-scale"></i>
                                       </p>
                                   </div>
                                   <div class="col-md-4 col-4">
                                       <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                           <a href="${value.product_detail}">
                                               <i class="fas fa-shopping-cart"></i>
                                           </a>
                                       </p>
                                   </div>
                               </div>
                               </div>
                               <!-- product info end -->



                           </div>
                       </div>
                   `);
               })

           },
           error: function(response){
               $(".loader").hide()
           }
       })
   })

   //product type wise filter start
   $(".type-wise-filter-product .top-row ul li").click(function(){
       $(".loader").show()
       let $this = $(this);
       let id = $this.attr('id')
       $.ajax({
           type: "GET",
           url: "/home/producttype/filter/"+id,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response){
               $(".loader").hide()
               if( response.products ){
                   $this.closest(".top-row").closest(".type-wise-filter-product").find(".type-wise-row .col-md-2").remove()
                   $.each(response.products, (key, value) => {
                       $this.closest(".top-row").closest(".type-wise-filter-product").find(".type-wise-row").append(`
                       <div class="col-md-2 col-6" style="padding: 0">
                           <div class="product-box">
                               <a href="${value.product_detail}">
                                   <img src="${value.image}"
                                       class="img-fluid" alt="">
                               </a>
                               <a>${value.name}</a>
                               <div class="row">
                                   <div class="col-md-12">

                                           <p class="offer_price" style="text-align: left">
                                               ${value.price}
                                           </p>
                                   </div>
                               </div>


                               <!-- product info start -->
                               <div class="product-info">
                               <div class="row">
                                           <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                   <i class="fas fa-heart"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                   <i class="fas fa-balance-scale"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4">
                                               <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                   <a href="${value.product_detail}">
                                                       <i class="fas fa-shopping-cart"></i>
                                                   </a>
                                               </p>
                                           </div>
                                       </div>
                               </div>
                               <!-- product info end -->

                           </div>
                       </div>
                       `);
                   })
               }

               if( response.error ){
                   swal("Error",`${response.error}`,'error')
               }

           },
           error: function(response){
               $(".loader").hide()
           }
       })
   })
})


//show all category start
// $(document).ready(function(){
//     $(".show_all_category").click(function(){
//         $(".topbar_all_category_list").show()
//     })
//     $(document).click(function(divclose){
//         if( $(divclose.target).closest(".show_all_category").length == 0 ){
//             $(".topbar_all_category_list").hide()
//         }
//     })
// })


$(document).ready(function(){
     $(".banner ul li").click(function(){
           let showSubCat = $(this).attr('id')

           if( showSubCat != 'all' ){
                 $(this).toggleClass('click-cat')
                 $( "." + showSubCat ).slideToggle();
           }
     })

     $(".ongoing-offer .middle ul li").click(function(){

           let showOffer = $(this).attr('id')

           if( showOffer != 'all' ){
                 $(".ongoing-offer ul li").removeClass('active-offers')
                 $(this).addClass("active-offers")
           }
     })


     //mobile nav start
     $(".mobile-nav .fa-bars").click(function(){
         $(".mobile-nav .fa-times").show()
         $(".mobile-nav .fa-bars").hide()

         $(".slide-nav").css({
             "transform" : "translateX(0)"
         })

         $('html,body').css({
             "overflow" : "hidden"
         })
     })

     $(".mobile-nav .fa-times").click(function(){
       $(".mobile-nav .fa-times").hide()
       $(".mobile-nav .fa-bars").show()
       $(".slide-nav").css({
           "transform" : "translateX(-100%)"
       })
       $('html,body').css({
           "overflow" : "auto"
       })
   })


     //window scroll
     $(window).scroll(function(){
         if( $(window).scrollTop() > 2 ){
             $("#topbar").css({
                 "position" : "fixed",
                 "width" : "100%",
                 "background" : "white",
                 "box-shadow": "0 0 10px -1px rgb(0 0 0 / 50%)",
                 "top" : "0"
             })
         }else{
           $("#topbar").css({
               "position" : "unset",
               "width" : "100%",
               "background" : "white",
               "box-shadow": "unset",
           })
         }
     })


     //category hide/show
     $(".banner .left p").click(function(){
       $(".banner .left ul").slideToggle();
     })

     //category filter hide/show
     $(".cat-left .title").click(function(){
         $(".category-filter-block").slideToggle();
     })


     //product detail
     $(".product-detail-carousel .item img").click(function(){
         let $this = $(this)
         $this.attr('src')
         if( $(".main-img img").remove() ){
           $(".main-img").append(`
           <img src="${$this.attr('src')}" class="img-fluid product-1" id="block__pic" onmouseover="a('block__pic')" alt="">
           `)

         }
         let smallProduct = $(this).attr('id')

         if( smallProduct != 'all' ){
           $(".product-detail-carousel .item img").removeClass('active-product')
           $this.addClass('active-product')

         }
     })



     $(window).scroll(function(){
         if( $(window).scrollTop() > 10 ){
             $(".go-to-top").fadeIn();
         }else{
           $(".go-to-top").fadeOut();
         }
     })

     //product info
     $(".product-detail-list ul .all-list").click(function(){
       let productInfoList = $(this).attr('id')

       if( productInfoList != 'all' ){
           $(".product-detail-list ul li").removeClass('active-info')
           $(this).addClass('active-info')
           $(".product-list-row").addClass("hide-detail")
           $("." + productInfoList ).removeClass('hide-detail')
       }
     })

     //type wise filter product
     $(".type-wise-filter-product .top-row  ul .select-type").click(function(){
         let typeProduct = $(this).attr('id')
         if( typeProduct != 'all' ){
           $(".type-wise-filter-product .top-row  ul li").removeClass('active-offer')
               $(this).addClass('active-offer')
         }
     })

     //profile info filtering
     $(".my-profile .left .info ul .profile-sort").click(function(){
         let profileInfoSort = $(this).attr('id')
         if( profileInfoSort != 'all' ){
             $(".my-profile .profile-info").addClass('hide-profile-info')
             $("." + profileInfoSort ).removeClass('hide-profile-info')

             $(".my-profile .left .info ul .profile-sort").css({
                 'background' : 'transparent'
             })
             $(this).css({
                 'background' : 'white'
             })
         }
     })

     $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

     $(".ajax-form").submit(function(e){
       e.preventDefault()
       $(".loader").show();

       let $this = $(this);
       let formData = new FormData(this);

       $this.find(".has-danger").removeClass('has-error');
       $this.find(".has-danger .form-control").css({
           'border': "none"
       });

       $this.find(".form-errors").remove();
       $this.find(".make-auth p").remove();

       $.ajax({
           type: $this.attr('method'),
           url: $this.attr('action'),
           data: formData,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response){
               $(".loader").hide();

               if(response.login_url){
                   $(".make-auth").append('<p>Registration successfully done. Redirecting please wait...</p>')
                   return window.location.href = response.login_url
               }

               if( response.invalid_customer ){
                   swal("","Your account is deactiveted","error")
               }

               if(response.profile_url){
                   $(".make-auth").append('<p>Login successfully done. Redirecting please wait...</p>')
                   return window.location.href = response.profile_url
               }
               if( response.invalid_login ){
                   $(".make-auth").append(`<p style="color: red!important; text-align: center!important; width: unset!important;">${response.invalid_login}</p>`)
               }
               if( response.profile_url ){
                   $(".make-auth").append('<p>Login successfully done. Redirecting please wait...</p>')
                   return window.location.href = response.login_url + '/'
               }

               if( response.invalid_review_product ){
                   swal("Error",`${response.invalid_review_product}`,"error")
               }
               if( response.review ){
                   swal("",`${response.review}`,"success")
               }

               if( response.already_subscribe ){
                   swal("Dear",`${response.already_subscribe}`,"warning")
               }

               if( response.subscribe ){
                   swal("Thank You",`${response.subscribe}`,"success")
               }

               if( response.error ){
                   swal("Sorry",`${response.error}`,"error")
               }

               if( response.order_track ){
                   return window.location.href = response.order_track
               }

               if( response.success ){
                   swal("",`${response.success}`,"success")
               }
           },
           error: function(response){
               $(".loader").hide();


               data = response.responseJSON

               if( data.subscribe_errors ){
                   swal("Subscribe Failed",`${data.subscribe_errors}`,"error")
               }

               $.each(data.errors, (key, value) => {

                   $("[name^="+key+"]").parent().addClass('has-error')
                   $("[name^="+key+"]").parent().append('<small class="danger text-muted form-errors">'+value[0]+'</small>');
               })

               $.each(data.error, (key, value) => {
                   $("[name^="+key+"]").parent().append('<small class="danger text-muted form-errors" style="color: white!important; width: 100%;position: absolute; top: 100%">'+value[0]+'</small>');
               })

           }
       })
   })

});



$(".order-track").click(function(){
   $(".order-track-block").show()
})
$(document).click(function(divclose){
   if( $(divclose.target).closest(".order-track").length == 0 ){
       $(".order-track-block").hide()
   }
})


//compare product carousel
$('.compare-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:2
       },
       1000:{
           items:5
       }
   }
})

//certificate carousel
$('.certificate-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
             items:3
         },
         600:{
             items:4
         },
         1200:{
            items:7
        },
        1400:{
            items:8
        },
   }
})


//banner carousel
$('.banner-carousel').owlCarousel({
   loop:true,
   nav:false,
   dots:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:1
       },
       1000:{
           items:1
       }
   }
})

$('.offer-banner-carousel').owlCarousel({
   loop:true,
   nav:false,
   dots:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:1
       },
       1000:{
           items:1
       }
   }
})



//type wise carousel
$('.type-wise-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:2
       },
       600:{
           items:2
       },
       1000:{
           items:6
       }
   }
})


//two banner carousel
$('.small-banner-carousel').owlCarousel({
   loop:true,
   nav:false,
   dots:false,
   autoplay:false,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:1
       },
       1000:{
           items:1
       }
   }
})

//related product carousel
$('.related-product-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:2
       },
       600:{
           items:2
       },
       1000:{
           items:6
       }
   }
})


//offer banner carousel
$('.offer-banner-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:1
       },
       600:{
           items:1
       },
       1000:{
           items:1
       }
   }
})




//product detail carousel
$('.product-detail-carousel').owlCarousel({
   loop:false,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
           items:3
       },
       600:{
           items:3
       },
       1000:{
           items:4
       }
   }
})


//on going offer carousel
$('.client-carousel').owlCarousel({
   loop:true,
   nav:false,
   autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
   responsive:{
       0:{
             items:4
         },
         600:{
             items:4
         },
         1200:{
            items:7
        },
        1400:{
            items:10
        },
   }
})

//on going offer carousel
$('.ongoing-carousel').owlCarousel({
     loop:true,
     nav:false,
     autoplay:true,
   autoplayTimeout:3000,
   autoplayHoverPause:false,
     responsive:{
         0:{
             items:2
         },
         600:{
             items:2
         },
         1000:{
             items:6
         }
     }
 })

//category carousel
$('.category-carousel').owlCarousel({
     loop:true,
     nav:false,
     autoplay:true,
   autoplayTimeout:2000,
   autoplayHoverPause:false,
     responsive:{
         0:{
             items:5
         },
         600:{
             items:5
         },
         1200:{
            items:7
        },
        1400:{
            items:10
        },

     }
})
$('.offer-carousel').owlCarousel({
    loop:false,
    nav:false,
    autoplay:false,
    autoplayTimeout:2000,
    autoplayHoverPause:false,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:2
        },
        1000:{
            items:8
        }
    }
})



//wishlist product start
function addToWishlist(id){
   $(".loader").show()
   if( id > 0 ){
       $.ajax({
           type: "GET",
           url: "/addToWishlist/" + id,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response){
               $(".loader").hide()
               if( response.login_first ){
                   swal("","Please login first","error")
               }
               if( response.wishlist_added_already ){
                   swal("","Product already added in your wishlist","warning")
               }
               if( response.wishlist_added ){
                   swal("","Product added to the wishlist. Visit your profile wishlist option","success")
               }

           },
           error: function(response){
               $(".loader").hide()
           }
       })
   }
   else{
       $(".loader").hide()
       swal("","Something went wrong. Please try again later.","error")
   }
}
//wishlist product end


//compare product start
function addToCompare(id){
   $(".loader").show()
   if( id > 0 ){
       let compare_id = id
       axios.post('/addToCompare', {compare_id}).then(res => {
           $(".loader").hide()
           display_compare(res.data)

           if( res.data.compare_already_added ){
               swal("","Product already added to the compare list","warning")
           }
           else{
               swal("","Product added to the compare list","success")
           }

       })
   }else{
       $(".loader").hide()
       swal("","Something went wrong. Please try again later","error")
   }
}
//compare product end


$( window ).load(function() {
   $(".compare_length").hide()
   $.ajax({
       type: "GET",
       url: "/getCompare",
       contentType: false,
       processData: false,
       cache: false,
       success: function(response){
           display_compare(response)

           $(".compare-product-row .col-md-12").remove()

           if( response.length == 0 ){
               $(".compare_length").hide()
               $(".compare-product-row").hide();
               $(".no-compare-product").show()

           }else{
                $(".compare_length").css("display","grid")
               $(".no-compare-product").hide()
               $(".compare-product-row").show();

           }

           $.each(response, (key, data) => {
               $.each(data, (index, value) => {
                   $(".compare-product-row").append(`
                       <div class="col-md-4 compare-product-col" >
                           <div class="product-box row" style="width:93%">
                               <!-- compare left part start -->
                               <div class="col-md-12 compare-product-col-left">
                                   <a href="${value.url}">
                                       <img src="${value.image}"
                                           class="img-fluid" alt="">
                                   </a>
                                   <!-- product info start -->
                                   <div class="product-info" style="width:93%">
                                       <div class="row">
                                           <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                   <i class="fas fa-heart"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                   <i class="fas fa-balance-scale"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4">
                                               <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                   <a href="${value.url}">
                                                       <i class="fas fa-shopping-cart"></i>
                                                   </a>
                                               </p>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- product info end -->

                                   <!-- product delete row start -->
                                   <div class="delete-compare" style="width:93%">
                                       <button onclick="removeCompare(${key})">Delete Product</button>
                                   </div>
                                   <!-- product delete row end -->
                               </div>
                               <!-- compare left part end -->

                               <!-- compare right part start -->
                               <div class="col-md-11 compare-product-col-right">
                                   <p>${value.name}</p>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <p class="offer_price" style="text-align: left">
                                               ${value.price} TK
                                           </p>
                                       </div>
                                       <div class="col-md-12">
                                           ${value.specification}
                                       </div>
                                   </div>

                               </div>
                               <!-- compare right part end -->




                           </div>
                       </div>
                   `);

                })
           })

       },
       error: function(response){
       }
   })
});

function removeCompare(key){
   $(".loader").show()
   let compare_id = key
   axios.get(`/deleteCompare/${compare_id}`,).then( res => {
       $(".loader").hide()
      if( res.data ){
       display_compare(res.data)
       swal("","Product removed from the compare list","success")

       $(".compare-product-row .col-md-12").remove()
       $(".compare-product-col-right").remove()
       $(".compare-product-col").remove()
       $(".product-box").remove()


           $.each(res.data, (key, data) => {
               $.each(data, (index, value) => {
                $(".compare-product-row").append(`
                       <div class="col-md-4 compare-product-col" >
                           <div class="product-box row" style="width:93%">
                               <!-- compare left part start -->
                               <div class="col-md-12 compare-product-col-left">
                                   <a href="${value.url}">
                                       <img src="${value.image}"
                                           class="img-fluid" alt="">
                                   </a>
                                   <!-- product info start -->
                                   <div class="product-info" style="width:93%">
                                       <div class="row">
                                           <div class="col-md-4 col-4" style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToWishlist(${value.id})" data-toggle="tooltip" data-placement="bottom"  title="Wishlist">
                                                   <i class="fas fa-heart"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4"  style="border-right: 1px solid #f3f1f1;">
                                               <p onclick="addToCompare(${value.id})"  data-toggle="tooltip" data-placement="bottom"  title="Compare">
                                                   <i class="fas fa-balance-scale"></i>
                                               </p>
                                           </div>
                                           <div class="col-md-4 col-4">
                                               <p data-toggle="tooltip" data-placement="bottom"  title="Cart">
                                                   <a href="${value.url}">
                                                       <i class="fas fa-shopping-cart"></i>
                                                   </a>
                                               </p>
                                           </div>
                                       </div>
                                   </div>
                                   <!-- product info end -->

                                   <!-- product delete row start -->
                                   <div class="delete-compare" style="width:93%">
                                       <button onclick="removeCompare(${key})">Delete Product</button>
                                   </div>
                                   <!-- product delete row end -->
                               </div>
                               <!-- compare left part end -->

                               <!-- compare right part start -->
                               <div class="col-md-11 compare-product-col-right">
                                   <p>${value.name}</p>
                                   <div class="row">
                                       <div class="col-md-12">
                                           <p class="offer_price" style="text-align: left">
                                               ${value.price} TK
                                           </p>
                                       </div>
                                       <div class="col-md-12">
                                           ${value.specification}
                                       </div>
                                   </div>

                               </div>
                               <!-- compare right part end -->
                           </div>
                       </div>
                   `);
               })
           })
      }
      else{
       $(".loader").hide()
       display_compare(res.data)
       swal("","Product remove from the compare list","success")
       $(".no-compare-product").show()
       $(".compare-product-row .col-md-12").remove()
       $(".compare-product-col").remove()
      }
   })
}

function display_compare(item){
   $("#compare_length").html(item.length)
   if( item.length == 0 ){
       $(".compare_length").hide()

   }else{
       $(".compare_length").css("display","grid")

   }
}










//add to cart start
function addToCart(id){

   let varient = $('#product-varient').find(":selected").val();

   $(".loader").show()

   if( varient ){
       var product_varient = varient
   }else{
       var product_varient = 0
   }
   let quantity = $("#quantity").val();
   let product_id = id
   if( product_varient < 0 ){
       $(".loader").hide()
       swal("","Error in product varient","error")
   }
   else if( quantity && product_id ){
       $.ajax({
           type: "GET",
           url: "/addToCart/"+product_varient+"/quantity/"+quantity+"/product/"+product_id+"/",
           contentType: false,
           processData: false,
           cache: false,
           success: function(response) {
               $(".loader").hide()

               if( response.cartError ){
                   swal("",`${response.cartError}`,"error")
               }
               if( response.stock_not_available ){
                   swal("","Stock unavailable","warning")
               }
               if( response.cart_added ){
                   cartLoad()
                   swal("","Product added to the cart","success")
               }

           },
           error: function(response) {
               $(".loader").hide()

           }
       })
   }
   else{
       $(".loader").hide()
       swal("","Something went wrong","error")
   }
}





//window loader
$(window).load(function(){
//    console.clear()
   cartLoad()

})


function cartLoad(){
   $.ajax({
       type: "GET",
       url: "/getcart",
       contentType: false,
       processData: false,
       cache: false,
       success: function(response) {
           if( response.cart ){
               $("#cartLength").html(response.cart.length)

               if( response.cart.length > 0 ){
                   $(".cartLength").css("display","grid")
                   $("#cart-empty").hide()
                   $(".cart-page-loading").hide()
                   $("#guest-checkout").show();
                   $(".checkout-block").show();

                   var sub_total = 0;

                   var total = 0;
                   var shipping_charge = 0
                   $("#checkout-page-cart-show .cart-item").remove()
                   $(".loader").hide()
                   $.each(response.cart, (key, value) => {
                       $("#checkout-page-cart-show").append(`
                           <div class="row cart-item">
                               <!-- image part start -->
                               <div class="col-md-2 col-3 left">
                                   <a href="${value.url}">
                                           <img src="${value.image}" class="img-fluid" alt="">
                                   </a>
                               </div>
                               <!-- image part end -->

                               <!-- product detail start -->
                               <div class="col-md-10 col-9 right">
                                   <p>Name : ${value.name}</p>
                                   <p>Unit Price : ${value.unit_price} BDT</p>
                                   ${value.varient_name ?
                                       `<p>Color : ${value.varient_name}</p>`
                                   : ''}
                                   <div class="update-cart">
                                           <button onclick="cartMinus(${value.id}, ${value.quantity}, ${value.varient})" type="button">-</button>
                                           <span>${value.quantity}</span>
                                           <button onclick="cartPlus(${value.id},${value.quantity},${value.varient})" type="button">+</button>
                                           <button type="button" class="cartRemovebutton" onclick="removeCart(${value.id}, ${value.varient})" data-toggle="tooltip" data-placement="bottom" title="Remove">
                                           <i class="fas fa-times"></i>
                                           </button>
                                           <button class="cartRemovebutton" type="button" data-toggle="tooltip" data-placement="bottom" title="Wishlist" onclick="addToWishlist(${value.id})">
                                                   <i class="fas fa-heart"></i>
                                           </button>
                                           <button class="cartRemovebutton" type="button" data-toggle="tooltip" data-placement="bottom" title="Compare" onclick="addToCompare(${value.id})">
                                                   <i class="fas fa-balance-scale"></i>
                                           </button>
                                   </div>

                               </div>
                               <!-- product detail end -->
                           </div>
                       `)

                       sub_total = sub_total + ( value.quantity*value.unit_price )

                       $("#sub_total span").html(sub_total)

                       if( shipping_charge < value.delivery_charge ){
                           shipping_charge = value.delivery_charge
                       }


                   })
                   if( response.balance >= sub_total ){
                       total =  0
                   }else{
                       total = (sub_total - response.balance) + parseInt(shipping_charge)
                   }
                   $(".total_price").attr('data-total',parseInt(total))

                   $(".shipping_charge").html(shipping_charge + ' BDT')

                   $(".total_price span").html(parseInt(total) + " BDT")
               }
               else{
                   $(".cartLength").css("display","none")
                   $(".cart-page-loading").hide()
                   $("#cart-empty").show()
                   $("#guest-checkout").hide();
                   $(".checkout-block").hide();
               }
           }else{
               $(".cart-page-loading").hide()
               $("#cart-empty").show()
               $("#guest-checkout").hide();
               $(".checkout-block").hide();
           }


       },
       error: function(response) {

       }
   })
}


function cartPlus(product_id,quantity,varient){

   let id = product_id
   $(".loader").show()

   if( id < 1 ){
       swal("","Invalid product","error")
   }
   else{
       $.ajax({
           type: "GET",
           url: "/addToCart/plus/"+id+"/quantity/"+quantity+"/varient/"+varient,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response) {

               if( response.stock_not_available ){
                   $(".loader").hide()
                   swal("","Stock unavailable","warning")
               } else if( response.cartError ){
                    $(".loader").hide()
                    swal("",`${response.cartError}`,"error")
                } else{
                   $("#coupon_code").val('')
                   cartLoad()
               }

           },
           error: function(response) {
               $(".loader").hide()
           }
       })
   }

}

function cartMinus(product_id, quantity, varient){

   let id = product_id
   $(".loader").show()
   if( id < 1 ){
       swal("","Invalid product","error")
   }
   else if( quantity > 1 ){
       $.ajax({
           type: "GET",
           url: "/addToCart/minus/"+id+"/varient/"+varient,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response) {
               $("#coupon_code").val('')
               cartLoad()
           },
           error: function(response) {
               $(".loader").hide()
           }
       })
   }
   else{
       $(".loader").hide()
       swal("","Minimum order quantity one","error")
   }

}


//remove cart start
function removeCart(product_id, varient){
   $(".loader").show()
   let id = product_id
   if( id > 0 ){
       $.ajax({
           type: "GET",
           url: "/addToCart/remove/"+id+"/varient/"+varient,
           contentType: false,
           processData: false,
           cache: false,
           success: function(response) {
               $(".loader").hide()
               $("#checkout-page-cart-show .cart-item").remove()
               cartLoad()
           },
           error: function(response) {
               $(".loader").hide()
           }
       })
   }else{
       $(".loader").hide()
       swal("","Invalid product","error")
   }
}





//dropdown footer
$(".footer-right-item h2").click(function(){
    let $this = $(this)
        $this.closest("div").find("ul").slideToggle()

})























