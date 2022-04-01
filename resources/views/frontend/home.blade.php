@extends('frontend.layouts.app')
@section('title', 'Magic ')

@section('content')
    <div class="home">
        <div class="row">
            <div class="col-12">
                <div class="profile mb-3">
                    <img src="https://ui-avatars.com/api/?background=5842e3&color=fff&name={{$user->name}}" alt="no img">
                    <h5>{{$user->name}}</h5>
                    <a href="" class="text-muted">
                        {{$user->wallet ? number_format($user->wallet->amount) : 0}} <span>MMK</span>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="card shortcut-box mb-3">
                    <div class="card-body p-3">
                        <img class="mr-2" src="{{asset('frontend/img/code-scanning.png')}}" alt="no-img">
                        <span>Scan & Pay</span>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card shortcut-box mb-3">
                    <div class="card-body p-3">
                        <img class="mr-2" src="{{asset('frontend/img/qr-code.png')}}" alt="no-img">
                        <span>Receive QR</span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-3 function-box">
                    <div class="card-body pe-0">
                        
                            <a href="{{url('transfer')}}" class="d-flex justify-content-between">
                                <span><img src="{{asset('frontend/img/money-transfer.png')}}" alt=""> Transfer</span>
                                <span class="me-3"><i class="fas fa-angle-right"></i></span>
                            </a>
                        
                        <hr>
                        <a href="#" class="d-flex justify-content-between logout">
                            <span><img src="{{asset('frontend/img/wallet.png')}}" alt="">Wallet</span>
                            <span class="me-3"><i class="fas fa-angle-right"></i></span>
                        </a>                        

                        <hr>
                        <a href="{{url('transaction')}}" class="d-flex justify-content-between logout">
                            <span><img src="{{asset('frontend/img/transaction.png')}}" alt="">Transaction</span>
                            <span class="me-3"><i class="fas fa-angle-right"></i></span>
                        </a>                            

                        <hr>
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
