<div class="modal-header">
     <h5 class="modal-title" id="exampleModalLabel">Add new page</h5>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
     </button>
</div>
<div class="modal-body">
     <form action="{{ route('custom.page.add') }}" class="ajax-form" method="post">
          @csrf
          <div class="form-group">
               <label>Position</label>
               <input type="number" class="form-control" name="position" min="1">
          </div>
          <div class="form-group">
               <label>Name</label>
               <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group">
               <label>Footer Widget</label>
               <select name="footer_widget_id" class="form-control">
                    @foreach( $footer_widgets as $footer_widget )
                    <option value="{{ $footer_widget->id }}">{{ $footer_widget->widget }}</option>
                    @endforeach
               </select>
          </div>
          <div class="form-group">
               <label>Type</label>
               <select name="type" class="form-control type-onchange" id="">
                    <option value="Page">Page</option>
                    <option value="Link">Link</option>
               </select>
          </div>
          <div class="form-group content" id="">
               <label>Content</label>
               <textarea class="form-control" id="div_editor1" name="content">
                                                                      </textarea>
          </div>
          <div class="form-group link" id="">
               <label>Link</label>
               <input type="text" class="form-control" name="link">
          </div>

          <div class="form-group">
               <button type="submit" class="btn btn-primary">Add</button>
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
     var editor1 = new RichTextEditor("#div_editor1");
</script>



<script>
     $(document).on('change', '.type-onchange', function() {
          let value = $('.type-onchange option:selected').val()

          if (value == "Page") {
               $(".link").hide();
               $(".content").show();
          } else {
               $(".link").show();
               $(".content").hide();
          }
     });
</script>