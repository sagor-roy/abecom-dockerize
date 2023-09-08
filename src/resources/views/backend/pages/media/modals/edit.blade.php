<div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Social Media</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
      </button>
 </div>
 <div class="modal-body">
      <form action="{{ route('media.update', $media->id) }}" class="ajax-form" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                  <select name="icon" class="form-control" id="chosen2">
                        <option value="{{ $media->icon }}" selected>{{ $media->icon }}</option>
                        <option value="fa-behance">&#xf1b4; fa-behance</option>
                        <option value="fa-behance-square">&#xf1b5; fa-behance-square</option>
                        <option value="fa-facebook">&#xf09a; fa-facebook</option>
                        <option value="fa-facebook-f">&#xf09a; fa-facebook-f</option>
                        <option value="fa-facebook-official">&#xf230; fa-facebook-official</option>
                        <option value="fa-facebook-square">&#xf082; fa-facebook-square</option>
                        <option value='fa-linkedin'>&#xf0e1; fa-linkedin</option>
		            <option value='fa-linkedin-square'>&#xf08c; fa-linkedin-square</option>
                        <option value="fa-flickr">&#xf16e; fa-flickr</option>
                        <option value="fa-git">&#xf1d3; fa-git</option>
                        <option value="fa-git-square">&#xf1d2; fa-git-square</option>
                        <option value="fa-github">&#xf09b; fa-github</option>
                        <option value="fa-github-alt">&#xf113; fa-github-alt</option>
                        <option value="fa-github-square">&#xf092; fa-github-square</option>
                        <option value="fa-google">&#xf1a0; fa-google</option>
                        <option value="fa-google-plus">&#xf0d5; fa-google-plus</option>
                        <option value="fa-google-plus-square">&#xf0d4; fa-google-plus-square</option>
                        <option value="fa-google-wallet">&#xf1ee; fa-google-wallet</option>
                        <option value="fa-instagram">&#xf16d; fa-instagram</option>
                        <option value="fa-joomla">&#xf1aa; fa-joomla</option>
                        <option value="fa-jpy">&#xf157; fa-jpy</option>
                        <option value="fa-linkedin">&#xf0e1; fa-linkedin</option>
                        <option value="fa-linkedin-square">&#xf08c; fa-linkedin-square</option>
                        <option value="fa-paypal">&#xf1ed; fa-paypal</option>
                        <option value="fa-pinterest">&#xf0d2; fa-pinterest</option>
                        <option value="fa-pinterest-p">&#xf231; fa-pinterest-p</option>
                        <option value="fa-pinterest-square">&#xf0d3; fa-pinterest-square</option>
                        <option value='fa-twitter'>&#xf099; fa-twitter</option>
                        <option value='fa-twitter-square'>&#xf081; fa-twitter-square</option>
                        <option value='fa-youtube'>&#xf167; fa-youtube</option>
                        <option value='fa-youtube-play'>&#xf16a; fa-youtube-play</option>
                        <option value='fa-youtube-square'>&#xf166; fa-youtube-square</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Link</label>
                  <input type="text" class="form-control" name="link" value="{{ $media->link }}">
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
            </div>
      </form>
 </div>
 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 </div>

 <link rel="stylesheet" href="{{ asset('backend/dist/css/choosen.min.css') }}">
 <script src="{{ asset('backend/dist/js/choosen.min.js') }}"></script>
 <script src="{{ asset('backend/dist/js/ajax_functionality.js') }}"></script>

 <script>
       $("#chosen2").chosen()
 </script>