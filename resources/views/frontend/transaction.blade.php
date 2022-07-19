@extends('frontend.layouts.app')
@section('title', 'Transaction')

@section('content')
<div class="transaction">
    <div class="card mb-3">
        <div class="card-body p-2">
            <h6><i class="fas fa-filter"></i> Filter</h6>
            <div class="row">
                <div class="col-6">
                    <div class="input-group my-2">
                        <label class="input-group-text p-1">date</label>
                       <input type="text" class="form-control date" value="{{request()->date}}" placeholder="All">
                      </div>
                </div>
                <div class="col-6">
                    <div class="input-group my-2">
                        <label class="input-group-text p-1 ">Type</label>
                        <select class="form-select type">
                          <option value="">All</option>
                          <option value="1" @if(request()->type ==1) selected @endif>
                            Income
                        </option>
                          <option value="2" @if(request()->type == 2) selected @endif>
                              Expense
                            </option>
                         
                        </select>
                      </div>
                </div>
            </div>
        </div>
    </div>
    <h6>Transaction</h6>
    <div class="infinite-scroll">
    @foreach($transactions as $transaction)
        <a href="{{url('transaction' , $transaction->trs_id)}}">
            <div class="card mb-2">
                <div class="card-body p-2">
                     <div class="d-flex justify-content-between">
                         <h5>Trs Id : {{$transaction->trs_id}}</h5>
                         <p class="mb-1 @if($transaction->type ==1) text-success
                              @elseif($transaction->type == 2)  text-danger
                              @endif">
                             {{$transaction->amount}} <small>MMK</small>
                         </p>
                     </div>
                     <p class="mb-1">
                         @if($transaction->type ==1)
                             From
                         @elseif($transaction->type ==2)  
                             To
                         @endif
                         
                         {{$transaction->source ? $transaction->source->name : ''}}
                     </p>
                     <p class="text-muted">{{$transaction->created_at}}</p>
                </div>
             </div>
        </a>
    @endforeach

    {{$transactions->links()}}
    </div>
</div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('ul.pagination').hide();
        $(function() {
            $('.infinite-scroll').jscroll({
                autoTrigger: true,
                loadingHtml: '<div class="text-center"><img class="center-block" src="/images/loading.gif" alt="Loading..." /></div>',
                padding: 0,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.infinite-scroll',
                callback: function() {
                    $('ul.pagination').remove();
                }
            });

            
            
        });
        
            $('.date').daterangepicker({
                "singleDatePicker": true,
                "autoApply": false,
                "autoUpdateInput":false,
                "locale": {
                    "format": "YYYY-MM-DD",
                
                },
               
});

$('.type').change(function(){
    var date = $('.date').val();
    var type = $('.type').val();

    history.pushState(null, '', `?date=${date}&type=${type}`);
    window.location.reload();
            });

$('.date').on('apply.daterangepicker', function(ev, picker) {
    $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm:ss'));
    
    var date = $('.date').val();
    var type = $('.type').val();

    history.pushState(null, '', `?date=${date}&type=${type}`);
    window.location.reload();
});

$('.date').on('cancel.daterangepicker', function(ev, picker){
    $(this).val('');
    var date = $('.date').val();
    var type = $('.type').val();

    history.pushState(null, '', `?date=${date}&type=${type}`);
    window.location.reload();
});



    </script>
@endsection