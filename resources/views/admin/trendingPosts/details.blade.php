@extends('admin.layout.master')

@section('content')
<div>
    <div>
        <a href="{{url()->previous()}}" class=""><i class="fa-solid fa-arrow-left"></i>Back</a>
    </div>
</div>
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Post Details</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
                <h3>
                    Title : {{$data->title}}
                </h3>
                <div>
                    <img src="{{asset('postimage/'.$data->image)}}" alt="" width="100%">
                </div>
                <h5>
                    Description : {{$data->description}}
                </h5>
                <div class="d-flex align-items-center">
                    <div class="mr-1">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div>
                        {{$data->view_count}}
                    </div>
                </div>

            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
