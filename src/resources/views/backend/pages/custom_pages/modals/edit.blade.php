<div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">{{ $custom_page->name }}</h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
     </button>
</div>
<div class="modal-body">
     <form action="{{ route('custom.page.edit', encrypt($custom_page->id)) }}" class="ajax-form" method="post">
          @csrf
          <div class="form-group">
               <label>Position</label>
               <input type="number" class="form-control" name="position" min="1" value="{{ $custom_page->position }}">
          </div>
          <div class="form-group">
               <label>Name</label>
               <input type="text" class="form-control" name="name" value="{{ $custom_page->name }}">
          </div>
          <div class="form-group">
               <label>Footer Widget</label>
               <select name="footer_widget_id" class="form-control">
                    @foreach( $footer_widgets as $footer_widget )
                    <option value="{{ $footer_widget->id }}" @if( $footer_widget->id == $custom_page->footer_widget_id ) selected @endif >{{ $footer_widget->widget }}</option>
                    @endforeach
               </select>
          </div>
          <div class="form-group">
               <label>Type</label>
               <select name="type" class="form-control type-onchange" >
                    <option value="Page" @if( $custom_page->type == "Page" ) selected @endif >Page</option>
                    <option value="Link" @if( $custom_page->type == "Link" ) selected @endif >Link</option>
               </select>
          </div>
          <div class="form-group">
               <label>Status</label>
               <select name="is_active" class="form-control">
                    <option value="1" @if( $custom_page->is_active == true ) selected @endif >Active</option>
                    <option value="0" @if( $custom_page->is_active == false ) selected @endif >In active</option>
               </select>
          </div>
          <div class="form-group content"  @if( $custom_page->type == "Page" ) style="display:block" @else style="display:none" @endif>
               <label>Content</label>
               <textarea class="form-control" id="div_editor2" name="content">
                    {{ $custom_page->content }}
               </textarea>
          </div>
          <div class="form-group link" @if( $custom_page->type == "Link" ) style="display:block" @endif>
               <label>Link</label>
               <input type="text" class="form-control" name="link" value="{{ $custom_page->link }}">
          </div>

          <div class="form-group">
               <button type="submit" class="btn btn-primary">Update</button>
          </div>
     </form>
</div>
<div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>


<link rel="stylesheet" href="{{ asset('backend/rte_theme_default.css') }}" />
<script type="text/javascript" src="{{ asset('backend/rte.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/plugins/all_plugins.js') }}"></script>
<script>
     var editor1 = new RichTextEditor("#div_editor2");
</script>



<script>
     $(document).on('change','.type-onchange', function(){
          let value = $('.type-onchange option:selected').val()
          
          if( value == "Page" ){
               $(".link").hide();
               $(".content").show();
          }
          else{
               $(".link").show();
               $(".content").hide();
          }
     });
</script>