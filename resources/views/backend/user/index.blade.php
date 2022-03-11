@extends('backend.layout.app')

@section('title', 'Users')
@section('content')
@section('user-active', 'mm-active')


<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-users icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>
                 Users
               
            </div>
        </div>
           
    </div>
</div>  

<div class="py-3">
    <a href="{{route('admin.user.create')}}" class="btn btn-primary">
        <i class="fas fa-plus-circle">Create User</i>
    </a>
</div>

<div class="content py-3">
   
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered Datatable">
                    <thead>
                        <tr class="bg-light">
                            <th>Name</th>
                            {{-- <th class="no-sort">Email</th> --}}
                            <th class="no-sort">Email</th>
                            <th class>Phone Number</th>
                            <th>IP</th>
                            <th>User Agent</th>
                            <th>Login at</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
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
                 ajax: "/admin/user/datatable/ssd",

                 columns : [
                     {
                         data: "name",
                         name: "name",
                        //  sortable: false
                     },
                     {
                         data: "email",
                         name: "email",
                         //  sortable: false
                        // searchable:false
                     },
                     {
                         data: "phone",
                         name: "phone",
                     },
                     {
                         data: "ip",
                         name: "ip",
                     },
                     {
                         data: "user_agent",
                         name: "user_agent",
                         searchable: false,
                         sortable: false
                     },
                     {
                         data: "login_at",
                         name: "login_at",
                     },
                     {
                         data: "created_at",
                         name: "created_at",
                     },
                     {
                         data: "updated_at",
                         name: "updated_at",
                     },
                     {
                         data: "action",
                         name: "action",
                         searchable: false,
                         sortable: false
                     },
                 ],
                 order: [
                    [
                         6, 'desc'
                    ]
                 ]
                //  columnDefs : [{
                //      targets: 'no-sort',
                //      sortable : false
                //  }]

            
                });
                
                $(document).on('click', '.delete', function(e){
                    e.preventDefault();
                    //alert(123);
                    var id = $(this).data('id');
                    //alert(id);

                            Swal.fire({
                        title: 'Are you sure, you want to delete?',
                       
                        showCancelButton: true,
                        confirmButtonText: 'Confirm',
                       
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            // Swal.fire('Saved!', '', 'success')
                            $.ajax({
                                url: "/admin/user/" + id,
                                type: "DELETE",

                                
                                success: function(){
                                    table.ajax.reload();
                                }
                            })
                        } 
                        })
                });
        
            } );
    </script>
@endsection