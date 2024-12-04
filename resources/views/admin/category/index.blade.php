@extends('admin.layout.master')
@section('content')
<div class="col-12">
    <div class="row">
        <div class="col-3">
            <form action="{{route('category.store')}}" method="post">
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
              <h3 class="card-title">Category List</h3>

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
                    <th>Category ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{$item->category_id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>
                          <a href="{{route('category.updateForm', $item->category_id)}}" class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                          <a href="{{route('category.delete', $item->category_id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
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
@endsection
