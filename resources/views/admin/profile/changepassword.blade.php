@extends('admin.layout.master')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{route('profile.changepassword')}}" method="post">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-3 col-form-label">Old Password</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputName" placeholder="Old Password" name="oldpassword">
                    @error('oldpassword')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                  @session('wrongpassword')
                      <small class="text-danger">Incorrect old password</small>
                  @endsession
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail" class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputEmail" placeholder="New Password" name="newpassword">
                      @error('newpassword')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPhone" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="inputPhone" placeholder="Confirm Password" name="newpassword_confirmation">
                      @error('newpassword_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-10 col-sm-2">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
                  </div>
                </div>
              </form>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
