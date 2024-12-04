@extends('admin.layout.master')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">User Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <form action="{{route('post.edit', $data->post_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2">
                        <label for="inputTitle">
                            Title
                        </label>
                        <input type="text" name="title" id="inputTitle" class="form-control" placeholder="Enter Category title" value="{{old('title', $data->title)}}">
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="inputDesc">
                            Description
                        </label>
                        <textarea name="description" id="inputDesc" cols="30" rows="5" class="form-control" placeholder="Enter Category description">{{old('description', $data->description)}}</textarea>
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="my-2">
                        <img src="" id="preview" class="w-100">
                        <input type="file" name="image" id="fileInput" class="form-control">
                        @error('image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="my-2">
                        <select name="category" id="" class="form-control">
                            <option value="" disabled>Choose a category</option>
                            @foreach ($categories as $item)
                            <option value="{{ $item->category_id }}" {{$item->category_id == $data->category_id ? 'selected' : ''}}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end align-items-center">
                        <button class="btn btn-secondary w-50" type="submit">
                            Update
                        </button>
                    </div>

                </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the selected file
    const preview = document.getElementById('preview'); // Get the preview image element

    if (file) {
        const reader = new FileReader(); // Create a FileReader instance

        reader.onload = function(e) {
            preview.src = e.target.result; // Set the preview src to the file's content
        };

        reader.readAsDataURL(file); // Read the file as a data URL
    }
});

  </script>
@endsection
