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
              <form class="form-horizontal" action="{{route('profile.update')}}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" placeholder="Name" name="name" value="{{old('name',$data->name) }}">
                    @error('name')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                  </div>

                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="email@example.com" name="email" value="{{old('email',$data->email) }}">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                  </div>

                </div>
                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPhone" placeholder="+959-999-999-999" name="phone" value="{{$data->phone}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="address" id="inputAddress" cols="30" rows="3" class="form-control" placeholder="No.1, 123 St., Example Township">{{$data->address}}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label" >Gender</label>
                    <div class="col-sm-10">
                      <select name="gender" id="" class="form-control" id="inputGender">
                        <option value="">Choose your gender</option>
                        <option value="male" {{$data->gender == 'male' ? 'selected' : ""}}>Male</option>
                        <option value="female" {{$data->gender == 'female' ? 'selected' : ""}}>Female</option>
                      </select>
                    </div>
                  </div>


                <div class="form-group row">
                  <div class="offset-sm-9 col-sm-3">
                    <a href="{{route('profile.changepassword')}}">Change Password</a>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-10 col-sm-2">
                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                  </div>
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
