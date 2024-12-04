@extends('admin.layout.master')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>

        <div class="card-tools">
          <form class="input-group input-group-sm" style="width: 150px;" action="{{route('adminlist')}}" method="get">
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
              <th>Admin ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Name</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->gender}}</td>
                @if (Auth::user()->id != $item->id)
                <td>
                    <a href="{{route('adminlist.delete', $item->id)}}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                  </td>
                @endif
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
