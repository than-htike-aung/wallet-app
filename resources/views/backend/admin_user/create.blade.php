@extends('backend.layout.app')

@section('title', 'Admin Create')
@section('content')
@section('admin-user-active', 'mm-active')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
               Create Admin Users
               
            </div>
        </div>
           
    </div>
</div>  


<div class="content">
   
        <div class="card">
            <div class="card-body">
                @include('backend.layout.flash_msg')
               <form action="{{route('admin.admin-user.store')}}" method="POST" id="create">
                @csrf
                   <div class="form-group">
                       <label for="">Name</label>
                       <input type="text" name="name" class="form-control">
                   </div>
                   <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="number" name="phone" class="form-control">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary mr-2 back-btn">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
               </form>
            </div>
        </div>
   
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\StoreAdminUserRequest', '#create') !!}
    <script>
        $(document).ready(function() {
            
        } );
    </script>
@endsection