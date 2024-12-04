@extends('admin.layout.master')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trending Post List</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
            <thead>
                <tr>
                  <th>Post ID</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>View</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($data as $item)
                  <tr>
                      <td>{{$item->post_id}}</td>
                      <td>{{$item->title}}</td>
                      <td>
                        <img src="{{asset('postimage/'.$item->image)}}" alt="" width="50px">
                    </td>
                    <td>
                        {{$item->view_count}}
                    </td>
                      <td>
                        <a href="{{route('trends.details', $item->post_id)}}" class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-circle-info"></i></a>
                      </td>
                    </tr>
                  @endforeach

              </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
