@extends('frontend.layouts.app')
@section('title', 'Notification Detail')

@section('content')
   <div class="card">
       <div class="card-body text-center">
        <div class="text-center">
            <img src="{{asset('frontend/img/noti.png')}}" alt="" style="width: 220px">
          </div>
          <h4 class="text-center">{{$notification->data['title']}}</h4>
          <p class="text-muted mb-1 text-center">{{$notification->data['message']}}</p>
         <p class="text-center"> <small class="mb-3">{{Carbon\Carbon::parse($notification->created_at)->format('Y-m-d h:i:s: A')}}</small></p>
          <a href="{{$notification->data['web_link']}}" class="btn  btn-theme btn-sm">Continue</a>
        </div>
   </div>
@endsection
