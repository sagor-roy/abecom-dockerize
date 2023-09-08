

window.onload = () => {
    console.clear();
}








$(document).ready(function(){
    $(document).on('click','[data-toggle="modal"]', function(e){
        var target_modal_element = $(e.currentTarget).data('content');
        var target_modal = $(e.currentTarget).data('target');

        var modal = $(target_modal);
        var modalBody = $(target_modal + ' .modal-content');
    
        console.clear();
        
        modalBody.load(target_modal_element);
    })
})



$(document).ready(function(){
    jQuery('select[name="category_id"]').on('change', function(){
        var cat_id = jQuery(this).val()
        
        if( cat_id ){
            //sub cat
            $.ajax({
                url : 'category_dependent/'+ cat_id,
                type : "GET",
                dataType : "JSON",
                success : function(data){
                    $('select[name="sub_cat_id"]').empty();
                    $.each(data, function(key, value){
                   
                        $('select[name="sub_cat_id"]').append('<option value="'+value.id+'"  id="menu_price" >'+value.name +'</option>');
                    })
                }
            })
        }
    })
})




//tab filter
$(document).ready(function(){
    $(".tab-panel ul li").click(function(){
        let id = $(this).attr('id')
        if( id != 'all' ){
            $(".tab-content").addClass("hide-tab")
            $("." + id).removeClass("hide-tab")

            $(".tab-panel ul li").css({
                'border-bottom' : 'none'
            })
            $(this).css({
                'border-bottom' : '1px solid #5867dd'
            })
        }
    })
})




