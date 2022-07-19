@extends('frontend.layouts.app')
@section('title', 'Transaction Detail')

@section('content')
<div class="transaction-detail">
    
    <div class="card">
        <div class="card-body">
            @if(session('transfer-success'))
            <div class="alert alert-success text-center fade show" role="alert">
                
                {{session('transfer-success')}}
              </div>
            @endif
            <div class="text-center mb-3">
                <img src="{{asset('frontend/img/check.png')}}" alt="">
            </div>
           @if($transaction->type == 1)
           <h4 class="text-center text-success mb-4"> {{number_format($transaction->amount)}}MMK</h4>
             @elseif($transaction->type == 2)
             <h4 class="text-center text-danger mb-4">- {{number_format($transaction->amount)}}MMK</h4>
           @endif

           <div class="d-flex justify-content-between">
               <p class="mb-0">Trs ID</p>
               <p class="mb-0">{{$transaction->trs_id}}</p>
           </div>
           <hr>
           <div class="d-flex justify-content-between">
            <p class="mb-0">Reference Number</p>
            <p class="mb-0">{{$transaction->ref_no}}</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <p class="mb-0">Type</p>
            <p>
                @if($transaction->type == 1)
                    <span class="badge rounded-pill bg-success" >Income</span>
                @elseif($transaction->type == 2)
                <span class="badge rounded-pill bg-danger">Expense</span>
                @endif
            </p>
        </div>
        
        <hr>
           <div class="d-flex justify-content-between">
            <p class="mb-0">Amount</p>
            <p class="mb-0">{{number_format($transaction->amount)}}</p>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <p class="mb-0">Date And Time</p>
            <p class="mb-0">{{$transaction->created_at}}</p>
        </div>
        <hr>
           <div class="d-flex justify-content-between">
            <p class="mb-0">
                @if($transaction->type == 1)
                    From
                @elseif($transaction->type == 2)
                    To
                @endif
            
            </p>
            <p class="mb-0">
                {{$transaction->source ? $transaction->source->name : '-'}}
            </p>
        </div>
       
        <hr>
            <div class="d-flex justify-content-between">
                <p class="mb-0">Description</p>
                <p class="mb-0">{{$transaction->description}}</p>
            </div>
        </div>
    </div>
</div>
@endsection
