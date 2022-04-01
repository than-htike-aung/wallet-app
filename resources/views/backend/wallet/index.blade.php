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
                 Wallets
               
            </div>
        </div>
           
    </div>
</div>  


<div class="content py-3">
   
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Account Number</th>
                            <th>Account Person</th>
                            <th>Amount (MMK)</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
   
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
      var table =  $('.Datatable').DataTable({
            processing: true,
            serverSide: true,
             ajax: "/admin/wallet/datatable/ssd",

             columns : [
                 {
                     data: "account_number",
                     name: "account_number",
                    
                 },
                 {
                     data: "account_person",
                     name: "account_person",
                   
                 },
                 {
                     data: "amount",
                     name: "amount",
                 },
                
                 {
                     data: "created_at",
                     name: "created_at",
                 },
                 {
                     data: "updated_at",
                     name: "updated_at",
                 }
                
             ],
             order: [
                    [
                         4, 'desc'
                    ]
                 ]
          
            });
            
          
    
        } );
</script>
@endsection