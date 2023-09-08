$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".ajax-form").submit(function (e) {
        e.preventDefault()
        $(".loader").show()

        $(".validinfo").hide()
        $(".spinner-border").show();
        $(".product-add-btn").hide();

        let $this = $(this);
        let formData = new FormData(this);

        $this.find(".has-danger").removeClass('has-error');
        $this.find(".form-errors").remove();

        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                console.clear();
                $(".loader").hide()
                $(".spinner-border").hide()
                $(".product-add-btn").show();

                if (response.product_url) {
                    swal("", "Product Added Successfully. Redirecting Please Wait", "success")
                    return window.location.href = response.product_url
                }

                if (response.mail_send) {
                    swal("", "Mail Send", "success")
                }

                if (response.warning) {
                    swal("", `${response.warning}`, "warning");
                }

                if (response.success) {
                    swal("", `${response.success}`, "success");
                }

                if (response.error) {
                    swal("", `${response.error}`, "error");
                }

                if (response.attr_set_val_exist) {
                    swal("", "Set value already added", "warning")
                }

                if (response.attribute_missing) {
                    swal("", "Please fill up product attribute", "warning")
                }

                if (response.password_update) {
                    swal("", "Password reseted", "success")
                }

                if (response.image_size_big) {
                    swal("", "Max file size 50KB", "error");
                }

                if (response.profile_update) {
                    swal("", "Profile updated. Redirecting please wait...", "success");
                    return window.location.href = response.profile_update
                }

                if (response.location_reload) {
                    swal("",`${response.location_reload}`, `${response.status}`);
                    location.reload();
                }

                if (response.password_not_match) {
                    swal("", "Password didn't match", "error");
                }

                if (response.offer_exist) {
                    swal("", "Active offer already exist in this category", "error");
                }

                if (response.create) {
                    swal("", "Added Successfully", "success");
                } 
                if (response.update) {
                    swal("", "Updated Successfully", "success");
                } 
                if (response.delete) {
                    swal("", "Deleted Successfully", "success");
                }
                if (response.error) {
                    swal("Alert!!", `${response.error}`, "error")
                }

                setTimeout(function () {
                    $("#datatable").DataTable().ajax.reload();
                    $("#datatable2").DataTable().ajax.reload();
                    $(".datatable").DataTable().ajax.reload();
                }, 1000)


            },
            error: function (response) {
                // console.clear();
                $(".loader").hide()
                $(".validinfo").show()
                $(".spinner-border").hide()
                $(".product-add-btn").show();


                let data = JSON.parse(response.responseText);

                if (data.error) {
                    swal(`${data.error}`, "", "error")
                }


                if (data.errors) {
                    $.each(data.errors, (key, value) => {
                        $("[name^=" + key + "]").parent().addClass('has-error')
                        $("[name^=" + key + "]").parent().append('<small class="danger text-muted form-errors">' + value[0] + '</small>');
                    })
                }

                if (data.cat_attr_failed) {
                    swal("", "Please set attribute value", "error")
                }
                if (data.product_varient_required) {
                    swal("", "Please set attribute value", "error")
                }

                if (data.cat_errors) {
                    $.each(data.cat_errors, (key, value) => {
                        swal("", "Please fill up required fields", "error")
                        $("[name^=" + key + "]").parent().addClass('has-error')
                        $("[name^=" + key + "]").parent().append('<small class="danger text-muted form-errors">' + value[0] + '</small>');
                    })
                }


            }
        })
    })
})
