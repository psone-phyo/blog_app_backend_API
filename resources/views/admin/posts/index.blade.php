@extends('admin.layout.master')
@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-3">
            <form action="{{route('post.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="my-2">
                    <label for="inputTitle">
                        Title
                    </label>
                    <input type="text" name="title" id="inputTitle" class="form-control" placeholder="Enter Category title">
                    @error('title')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="my-2">
                    <label for="inputDesc">
                        Description
                    </label>
                    <textarea name="description" id="inputDesc" cols="30" rows="5" class="form-control" placeholder="Enter Category description"></textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="my-2">
                    <img id="preview" src="" class="w-100">
                    <input type="file" name="image" id="fileInput" class="form-control">
                    @error('image')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="my-2">
                    <select name="category" id="" class="form-control">
                        <option value="">Choose a category</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->category_id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <button class="btn btn-secondary w-50" type="submit">
                        Create
                    </button>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
        <div class="card col-9">
            <div class="card-header">
              <h3 class="card-title">Post List</h3>

              <div class="card-tools">
                  <form class="input-group input-group-sm" style="width: 150px;" action="{{route('category')}}" method="get">
                      <input type="text" name="searchKey" class="form-control float-right" placeholder="Search" value="{{request('searchKey')}}">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </form>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap text-center">
                <thead>
                  <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->post_id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                            @if ($item->image)
                            <img src="{{asset('postimage/'.$item->image)}}" width="100px">
                            @else
                            -
                            @endif
                        </td>
                        <td>{{$item->name}}</td>
                        <td>
                          <a href="{{route('post.editForm', $item->post_id)}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                          <a href="{{route('post.delete', $item->post_id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <!-- /.card -->
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
