@extends('backend.layout.app')

@section('title', 'Edit Action User')
@section('content')
@section('user-active', 'mm-active')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
               Edit  Users
               
            </div>
        </div>
           
    </div>
</div>  


<div class="content">
   
        <div class="card">
            <div class="card-body">
                @include('backend.layout.flash_msg')
               <form action="{{route('admin.user.update', $user->id)}}" method="POST" id="update">
                    @csrf
                    @method('PUT')
                   <div class="form-group">
                       <label for="">Name</label>
                       <input type="text" name="name" class="form-control" value="{{$user->name}}">
                   </div>
                   <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control"  value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control"  value="{{$user->phone}}">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 back-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
               </form>
            </div>
        </div>
   
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#update') !!}
    <script>
        $(document).ready(function() {
            
        } );
    </script>
@endsection