@extends('frontend.layouts.app')
@section('title', 'Profile')

@section('content')
   <div class="update-password">
    
    <div class="card mb-3">
        <div class="card-body pe-0">
                <div class="text-center">
                    <img src="{{asset('frontend/img/security.png')}}" alt="">
                </div>
               <form action="{{route('update-password.store')}}" method="POST">
                @csrf
                    @include('frontend.layouts.flash_msg')
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" value="{{old('old_password')}}"  name="old_password">
                  @error('old_password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" value="{{old('new_password')}}" name="new_password">
                    @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                  </div>
               
                <button type="submit" class="btn btn-theme w-100 my-2">Submit</button>
               </form>
              
        </div>
    </div>

   </div>
@endsection

@section('scripts')
   <script>
    
   </script>
@endsection