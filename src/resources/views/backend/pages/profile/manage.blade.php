@extends('backend.template.layout')

@section('body-content')
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      
      <!-- title row start -->
      <div class="row">
            
            <div class="col-md-12">
                  <!--begin:: Widgets/Application Sales-->
                  <div class="kt-portlet kt-portlet--height-fluid">
                        
                        <div class="kt-portlet__head">
                              <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">
                                          Profile Page
                                    </h3>
                              </div>
                        </div>

                        <div class="kt-portlet__body">
                              <div class="tab-content">

                                    <div class="row product-section">
                                          <!-- left part start -->
                                          <div class="col-md-3">
                                                <div class="left">
                                                      <ul>
                                                            <li class="product-step active-product" id="product-1">
                                                                  Admin Information
                                                            </li>
                                                            <li class="product-step" id="product-2">Edit Info</li>
                                                            <li class="product-step" id="product-3">Change password</li>
                                                      </ul>
                                                </div>
                                          </div>
                                          <!-- left part end -->

                                          <!-- right part start -->
                                          <div class="col-md-9">
                                                
                                                <!-- information start -->
                                                <div class="row product-step-filter product-1">
                                                      <div class="col-md-12">
                                                            <div class="form-group">
                                                                  <label><b>Name: </b></label>
                                                                  <p>{{ auth('web')->user()->name }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                  <label><b>Email: </b></label>
                                                                  <p>{{ auth('web')->user()->email }}</p>
                                                            </div>
                                                      </div>
                                                </div>
                                                <!-- information end -->

                                                <!-- edit information start -->
                                                <div class="row product-step-filter product-2 hide-product">
                                                      <div class="col-md-12"> 
                                                            <form action="{{ route('profile.edit', auth('web')->user()->id) }}" class="ajax-form" method="post">
                                                                  @csrf
                                                                  <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="name" value="{{ auth('web')->user()->name }}">
                                                                  </div>
                                                                  <div class="form-group">
                                                                        <label>Email address</label>
                                                                        <input type="email" class="form-control" name="email" value="{{ auth('web')->user()->email }}">
                                                                  </div>
                                                                  <div class="form-group">
                                                                        <button type="submit" class="btn btn-outline-dark">Edit</button>
                                                                  </div>
                                                            </form>
                                                      </div>
                                                </div>
                                                <!-- edit information start -->

                                                <!-- change password start -->
                                                <div class="row product-step-filter product-3 hide-product">
                                                      <div class="col-md-12"> 
                                                            <form action="{{ route('profile.password', auth('web')->user()->id) }}" class="ajax-form" method="post">
                                                                  @csrf
                                                                  <div class="form-group">
                                                                        <label>Old password</label>
                                                                        <input type="password" class="form-control" name="old_password" >
                                                                  </div>
                                                                  <div class="form-group">
                                                                        <label>New password</label>
                                                                        <input type="password" class="form-control" name="password" >
                                                                  </div>
                                                                  <div class="form-group">
                                                                        <label>Re-write new password</label>
                                                                        <input type="password" class="form-control" name="password_confirmation" >
                                                                  </div>
                                                                  <div class="form-group">
                                                                        <button type="submit" class="btn btn-outline-dark">Change password</button>
                                                                  </div>
                                                            </form>
                                                      </div>
                                                </div>
                                                <!-- change password start -->
                                                      
                                          </div>
                                          <!-- right part end -->
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!--end:: Widgets/Application Sales-->	
            </div>
      </div>
      <!-- title row end -->
  
</div>
<!-- end:: Content -->
@endsection



@section('per_page_js')
<script>
      
      $(document).ready(function(){
            $(".product-section ul .product-step").click(function(){
                  console.log('aaa')
                  let product = $(this).attr('id')
                  
                  if( product  != 'all' ){
                        $(".product-section ul li").removeClass('active-product')
                        $(this).addClass('active-product')
                        $(".product-section .product-step-filter").addClass('hide-product');
                        $("." + product ).removeClass('hide-product');
                  }
            })
      })
      
</script>
@endsection


