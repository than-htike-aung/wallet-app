@extends('frontend.layouts.app')
@section('title', 'Transfer')

@section('content')
<div class="transfer">
    
       <div class="card">
           <div class="card-body">
               @include('frontend.layouts.flash_msg')
               <form action="{{url('transfer/confirm')}}" method="GET" id="transfer-form">
                    <input type="hidden" name="hash_value" class="hash_value" value="">
               <div class="form-group">
                    <label for="">From</label>
                    <p class="mb-1 text-muted">{{$authUser->name}}</p>
                    <p class="mb-1 text-muted">{{$authUser->phone}}</p>
               </div>
               <div class="form-group mb-3">
                   <label for="">To <span class="to_account_info text-success"></span></label>
                <div class="input-group">
                    <input type="text" class="form-control to_phone  @error('to_phone') is-invalid @enderror" id="to_phone" id="to_phone" name="to_phone" value="{{old('to_phone')}}"  aria-describedby="basic-addon2">
                    <span class="input-group-text btn btn-secondary verify-btn " id="basic-addon2"><i class="fas fa-circle-check"></i></span>
                    @error('to_phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror 
                </div>
                   
                </div>

                
                  
               <div class="form-group">
                <label for="">Amount (MMK)</label>
                <input type="number" name="amount" class="form-control amount @error('amount') is-invalid @enderror" id="amount" value="{{old('amount')}}">
                @error('amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control description">{{old('description')}}</textarea>
            </div>
            <button type="submit" class="btn btn-theme w-100 mt-5 submit-btn">Continue</button>
        </form>
           </div>
       </div>
    
</div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function(){
            
            $('.verify-btn').on('click', function(){
               
                var phone = $('.to_phone').val();
               //console.log(phone);
                $.ajax({
                    url:'/to-account-verify?phone=' + phone,
                    type: 'GET',
                  
                    success: function(res){
                        //console.log(res);
                        if(res.status == 'success'){
                             $('.to_account_info').text('('+res.data['name']+')');
                        }else{
                        $('.to_account_info').text('('+res.message+')');
                    }
                    },
                   
                });
            });

            $('.submit-btn').on('click', function(e){
                e.preventDefault();

                var to_phone = $('.to_phone').val();
                var amount = $('.amount').val();
                var description = $('.description').val();

                $.ajax({
                    url : `/transfer-hash?to_phone=${to_phone}&amount=${amount}&description=${description}`,
                    type: 'GET',
                    success: function(res){
                        if(res.status == 'success'){
                            $('.hash_value').val(res.data);
                            $('#transfer-form').submit();
                        }
                    }
                });

            });
        });
    </script>
@endsection

