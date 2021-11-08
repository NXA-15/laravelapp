@extends('adminlte::page')
 
@section('title', 'Company')
 
@section('content_header')
    <h1>Companies</h1>
@stop
@section('content')

       <div class="card">
         <div class="card-header">
         <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#CreateUserModal"> 
                Create New Company
            </button>
         </div>
         
         <div class="card-body"> 
           <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Website</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
   
<!-- modal -------------------------------------->
<!-- Create User Modal -->
<div class="modal" id="CreateUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Company Create</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Company was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="enail" class="form-control" name="email" id="email" autocomplete="off">                        
                </div>
                <div class="form-group">
                    <label for="name">Website:</label>
                    <input type="text" class="form-control" name="website" id="website">
                </div>
                <div class="form-group">
                    <label for="name">Address:</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="form-group">
                    <label for="name">Phone:</label>
                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                </div>
             
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitCreateUserForm">Create</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal" id="EditUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Company Edit</h4>
                <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                    <strong>Success!</strong>Company was added successfully.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="EditUserModalBody">
                    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="SubmitEditUserForm">Update</button>
                <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete User Modal -->
<div class="modal" id="DeleteUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Company Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Company?</h4>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="SubmitDeleteUserForm">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<!-- Information modal -->
<div class="modal" id="DetailUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Company Information</h4>
                <button type="button" class="close infoClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="DetailUserModalBody">

                <b>Name:</b>
                <p id="name-info"></p>
                <b>Email:</b>
                <p id="email-info"></p>

                <b>Employee List:</b>
                <div id="showtable"></div> 

                                
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-default infoClose" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- -------------------------------------->

     
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
@stop
 
@section('js')

    <script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">     
$(document).ready(function() {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    }); 

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('company.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'website', name: 'website'},
            {data: 'address', name: 'address'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
// Create company Ajax request.
        $('#SubmitCreateUserForm').click(function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "{{ route('company.store') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    website: $('#website').val(),
                    address: $('#address').val(),
                    phone_number: $('#phone_number').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        //$('.alert-success').show();
                        $('#CreateUserModal').modal('hide');
                        toastr.info(result.success);
                        table.ajax.reload();
                    }
                }
            });
        });

        // Get single company in EditModel
        $('.modelClose').on('click', function(){
            $('#EditUserModal').hide();
        });
        var id;
        $('body').on('click', '#getEditUserData', function(e) {
            // e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "company/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditUserModalBody').html(result.html);
                    $('#EditUserModal').modal('show');
                }
            });
        });

        // Update company Ajax request.
        $('#SubmitEditUserForm').click(function(e) {
            e.preventDefault();
 
            $.ajax({
                url: "company/"+id,
                method: 'PUT',
                data: {
                    name: $('#editName').val(),
                    email: $('#editEmail').val(),
                    website: $('#editWebsite').val(),
                    address: $('#editAddress').val(),
                    phone_number: $('#editPhone').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        //$('.alert-success').show();
                        $('#EditUserModal').modal('hide');
                        toastr.info(result.success);
                        table.ajax.reload();
                    }
                }
            });
        });

        // Delete company Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteUserForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
     
            $.ajax({
                url: "company/"+id,
                method: 'DELETE',
                success: function(data) {
                    $('#DeleteUserModal').modal('hide');
                    toastr.info(data.success);
                    table.ajax.reload();
                }
            });
        });

        // Get single company in InfoModel
        $('.infoClose').on('click', function(){
            $('#DetailUserModal').hide();
        });
        $('body').on('click', '#getDetailUserData', function(e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "company/"+id,
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(response) {
                    //console.log(result);
                    //$('#DetailUserModalBody').html(result.html);
                    let company = response.company;
                    $("#name-info").html(company.name);
                    $("#email-info").html(company.email);
                    $('#DetailUserModal').modal('show');
                    
                    //retrive record into table
                    var op ="";
                    var cid = company.id;
                    $.ajax({
                    type:'post',
                    url: "{{route('employee.postForm')}}",
                    data:{
                            'company_id': cid
                        },
                        success: function(data2){
                        op+='<table class="table table-striped">';
                        op+='<tr><th>No</th><th>Employee Name</th><th>Employee Email</th></tr>';
                        for(var i=0;i<data2.length;i++){
                        op+='<tr>';
                        op+='<td>'+(i+1)+'</td><td>'+data2[i].name+'</td><td>'+data2[i].email+'</td></tr>';
                        }
                        op+='</table>';
                        $('#showtable').html(op);
                        //console.log("Data Correctly Processed");
                        console.log(data2);
                        },
                        error: function(){
                        console.log("Error Occurred");
                        }
                    });
  
                }
            });
        });
    });
</script>
@stop