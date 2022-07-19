@extends('backend.layout.app')

@section('title', 'Wallets')
@section('content')
@section('wallet-active', 'mm-active')


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-wallet icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                 Add Amount
               
            </div>
        </div>
           
    </div>
</div>  

<div class="content py-3">
   
        <div class="card">
            <div class="card-body">
              <form action="{{url('admin/wallet/add/amount/store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="">User</label>
                      <select name="user_id" class="form-control user_id" id="">
                          <option value="">--Please Choose --</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}">{{$user->name}} ( {{$user->phone}} ) </option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="">Amount</label>
                      <input type="number" name="amount" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" class="form-control"></textarea>
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
    <script>
        $(document).ready(function(){
            $('.user_id').select2({
                theme: 'bootstrap4',
                placeholder: "--Please Choose--",
                allowClear: true
            })
            
        })
    </script>
@endsection