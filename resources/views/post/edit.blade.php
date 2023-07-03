 <x-front-layout>
     <section id="content">
         @include('post.partials._postmodalimage')

         <div class="mb-3">
             <a href="{{ route('post.show', $post->id) }}"><button class="btn btn-primary">Back</button></a>
         </div>

         <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
             @csrf
             @method('put')

             <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

             <div class="row col-md-12">
                 <div class="col-md-9">

                     <div class="form-group">
                         <label for="">Post Title</label>
                         <input type="text" name="title" id="title" class="form-control"
                             value="{{ $post->title }}" required>
                         @error('title')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label for="">Post Body</label>
                         <textarea id="editor" name="body" id="body" cols="" rows="" class="form-control" required>{{ $post->body }}</textarea>
                         @error('body')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror
                     </div>

                     <div class="form-group">
                         <label for="">Post Image</label><br>
                         <button class="btn btn-secondary mb-3 addPostImage" type="button" rn="0">Add</button>
                         <div class="addedPostImages mb-3"></div>
                         @if ($post->image && is_array($post->image))
                             <div class="postImages">
                                 @foreach ($post->image as $key => $pimg)
                                     @if ($pimg)
                                         <div class="postImg" id="{{ $key }}">
                                             <span class="text-danger" imageRowId="{{ $key }}"
                                                 imageName="{{ $pimg }}" id="deleteImg"><i
                                                     class="fas fa-trash text-danger" aria-hidden="true"></i></span>
                                             <img class="postImage" src="{{ asset('storage/' . $pimg) }}">
                                         </div>
                                     @endif
                                 @endforeach
                             </div>
                         @endif
                     </div>
                 </div>

                 <div class="col-md-3">
                     @include('post.partials._postsettingedit')
                 </div>
             </div>

             <div class="form-group">
                 <button class="btn btn-secondary btn-block" type="submit">Update</button>
             </div>
         </form>
     </section>


     @push('css')
         <link rel="stylesheet" href="{{ asset('css/post/edit.css') }}">
     @endpush

     @push('scripts')
         <script src="{{ asset('js/post.js') }}"></script>

         <script>
             $(document).ready(function() {
                 $(document).on('click', '#deleteImg', function() {
                     var con = confirm('Are you sure you want to delete?');
                     var imageRowId = $(this).attr('imageRowId');
                     var imageName = $(this).attr('imageName');

                     if (con === false) {
                         return false;
                     } else if (con === true) {
                         $.ajax({
                             url: "{{ route('delete-post-image', $post->id) }}",
                             method: 'post',
                             dataType: 'json',
                             data: {
                                 _method: 'delete',
                                 _token: "{{ csrf_token() }}",
                                 'imageName': imageName
                             },
                             beforeSend: function() {
                                // $('div#' + imageRowId).remove();
                             },
                             success: function(res) {
                                 if (res.status === true) {
                                     alert(res.msg);
                                     $('div#' + imageRowId).remove();
                                 } else {
                                     alert(res.msg);
                                 }
                             }
                         })
                     }
                 });
             });
         </script>
     @endpush
 </x-front-layout>
