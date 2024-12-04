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
                <form action="{{route('category.update', $data->category_id)}}" method="post">
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
                        <textarea name="description" id="inputDesc" cols="30" rows="5" class="form-control" placeholder="Enter Category description">{{old('title', $data->description)}}</textarea>
                        @error('description')
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
@endsection
