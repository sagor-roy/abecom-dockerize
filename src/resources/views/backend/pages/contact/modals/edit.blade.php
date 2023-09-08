<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Contact Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    <div class="row product-section">
        <!-- left part start -->
        <div class="col-md-3">
            <div class="left">
                <ul>
                    <li class="product-step active-product" id="product-1">Logo</li>
                    <li class="product-step" id="product-2">Fav Icon</li>
                    <li class="product-step" id="product-3">Contact Info</li>
                    <li class="product-step" id="product-4">Map & Store Info</li>
                    <li class="product-step" id="product-5">Titles</li>
                    <li class="product-step" id="product-6">Product Details</li>
                </ul>
            </div>
        </div>
        <!-- left part end -->

        <!-- right part start -->
        <div class="col-md-9">
            <form action="{{ route('contact.update', $contact->id) }}" method="post" class="ajax-form"
                enctype="multipart/form-data">
                @csrf
                <div class="row product-step-filter product-1">
                    <div class="col-md-12">
                        <label>Logo ( Max 50 Kb, Width: 1073px, Height : 164px
                            ) </label> <br>
                        @if( $contact->logo )
                        <img src="{{ asset('images/logo/'. $contact->logo) }}" id="image_preview_container"
                            class="default-thhumbnail" width="100px" alt="">
                        @else
                        <p class="badge badge-danger">No Image Found</p>
                        @endif
                        <br><br>
                        <input type="file" class="form-control-file" name="logo" id="image">
                    </div>
                    <div class="col-md-12" style="margin-top: 15px">
                        <label>Footer Logo ( Max 50 Kb, Width: 240px, Height : 145px
                            ) </label> <br>
                        @if( $contact->footer_logo )
                            <img src="{{ asset('images/logo/'. $contact->footer_logo) }}" id="image_preview_container2"
                                 class="default-thhumbnail" width="100px" alt="">
                        @else
                            <p class="badge badge-danger">No Image Found</p>
                        @endif
                        <br><br>
                        <input type="file" class="form-control-file" name="footer_logo" id="image2">
                    </div>
                </div>

                <div class="row product-step-filter product-2 hide-product">
                    <div class="col-md-12">
                        <label>Image ( Max 50 Kb, Width: 263px, Height : 164px
                            ) </label> <br>
                        @if( $contact->fav )
                        <img src="{{ asset('images/logo/'. $contact->fav) }}" id="image_preview_container2"
                            class="default-thhumbnail" width="100px" alt="">
                        @else
                        <p class="badge badge-danger">No Image Found</p>
                        @endif
                        <br><br>
                        <input type="file" class="form-control-file" name="fav" id="image2">
                    </div>
                </div>

                <div class="row product-step-filter product-3 hide-product">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $contact->email }}">
                        </div>
                        <div class="form-group">
                            <label>Hotline</label>
                            <input type="text" class="form-control" name="hotline" value="{{ $contact->hotline }}">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $contact->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" id="div_editor1" rows="3"
                                class="form-control">{{ $contact->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Opening Time</label>
                            <input type="time" class="form-control" name="open_time" value="{{ $contact->open_time }}">
                        </div>
                        <div class="form-group">
                            <label>Closing Time</label>
                            <input type="time" class="form-control" name="close_time"
                                value="{{ $contact->close_time }}">
                        </div>
                    </div>
                </div>

                <div class="row product-step-filter product-4 hide-product">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Map</label>
                            <input type="text" class="form-control" name="map" value="{{ $contact->map }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Store Info</label>
                            <textarea class="form-control" id="div_editor2" name="store_info">
                              {{ $contact->store_info }}
                              </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label>About Page Image ( Max 50 Kb, Width: 1000px, Height : 600px
                            ) </label> <br>
                        @if( $contact->about_us_image )
                        <img src="{{ asset('images/about_us_image/'. $contact->about_us_image) }}" id="image_preview_container"
                            class="default-thhumbnail" width="100px" alt="">
                        @else
                        <p class="badge badge-danger">No Image Found</p>
                        @endif
                        <br><br>
                        <input type="file" class="form-control-file" name="about_us_image" id="image">
                    </div>
                </div>

                <div class="row product-step-filter product-5 hide-product">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Offer Title</label>
                            <input type="text" class="form-control" name="offer_title"
                                value="{{ $contact->offer_title }}">
                        </div>
                        <div class="form-group">
                            <label>Footer Title</label>
                            <input type="text" readonly class="form-control" value="{{ $contact->footer_title }}">
                        </div>
                    </div>
                </div>

                <div class="row product-step-filter product-6 hide-product">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Details Title</label>
                                <input type="text" class="form-control" name="product_details_title" value="{{ $contact->product_details_title }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Product Details List</label>
                                <textarea class="form-control" id="div_editor3" name="product_details_list">
                                {{ $contact->product_details_list }}
                              </textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-outline-dark">Update Information</button>
                    </div>
                </div>

            </form>
        </div>
        <!-- right part end -->
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
<script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>
<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

<script>
    var editor2 = new RichTextEditor("#div_editor2");
    var editor3 = new RichTextEditor("#div_editor3");

    $(document).ready(function () {
        $(".product-section ul .product-step").click(function () {
            let product = $(this).attr('id')

            if (product != 'all') {
                $(".product-section ul li").removeClass('active-product')
                $(this).addClass('active-product')
                $(".product-section .product-step-filter").addClass('hide-product');
                $("." + product).removeClass('hide-product');
            }
        })
    })

    var editor1 = new RichTextEditor("#div_editor1");
    $("#chosen").chosen()

    $('#image').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

    $('#image2').change(function () {

        let reader = new FileReader();
        reader.onload = (e) => {
            $('#image_preview_container2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

    });

</script>
