@extends('frontend.layouts.app')
@section('title', 'Transaction')

@section('content')
<div class="transaction">
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
    </script>
@endsection