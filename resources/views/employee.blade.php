@extends('adminlte::page')
 
@section('title', 'Employee')
 
@section('content_header')
    <h1>Employees</h1>
@stop
@section('content')

       <div class="card">
         <div class="card-header">
         <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#CreateUserModal"> 
                Create New Employee
            </button>
         </div>
         
         <div class="card-body"> 
           <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Company</th>
                        <th>Photo</th>
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
                <h4 class="modal-title">Employee Create</h4>
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
                    <strong>Success!</strong>Employee was added successfully.
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
                    <input type="email" class="form-control" name="email" id="email" autocomplete="off">                        
                </div>
                <div class="form-group">
                    <label for="name">Phone:</label>
                    <input type="text" class="form-control" name="phone_number" id="phone_number">
                </div>
                <div class="form-group">
                    <label for="name">Address:</label>
                    <input type="text" class="form-control" name="address" id="address">
                </div>
                <div class="form-group">
                    <label for="name">Photo url:</label>
                    <input type="text" class="form-control" name="photo" id="photo">
                </div>
                <div class="form-group">
                    <label for="name">Company:</label>
                <select class="itemName form-control" name="company_id"  id="company_id" style="width:465px" >
                <option value=''>Select a Company</option>
                </select>
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
                <h4 class="modal-title">Employee Edit</h4>
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
                    <strong>Success!</strong>User was added successfully.
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
                <h4 class="modal-title">Employee Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <h4>Are you sure want to delete this Employee?</h4>
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
                <h4 class="modal-title">Employee Information</h4>
                <button type="button" class="close infoClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              
                <div id="DetailUserModalBody">
                    
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


  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>



<script type="text/javascript">     
$(document).ready(function() {

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    }); 


    $('.itemName').select2({
        ajax: { 
          url: "{{route('company.getCompanies')}}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }

      });

      
 

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('employee.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone_number', name: 'phone_number'},
            {data: 'address', name: 'address'},
            {data: 'company.name', name: 'company.name'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
     
// Create employee Ajax request.
        $('#SubmitCreateUserForm').click(function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('employee.store') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone_number: $('#phone_number').val(),
                    address: $('#address').val(),
                    photo: $('#photo').val(),
                    company_id: $('#company_id').val(),
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

        // Get single employee in EditModel
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
                url: "employee/"+id+"/edit",
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#EditUserModalBody').html(result.html);
                    $('#EditUserModal').show();
                    $('.itemNamex').select2(
                        {
                            ajax: { 
                            url: "{{route('company.getCompanies')}}",
                            type: "post",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                search: params.term // search term
                                };
                            },
                            processResults: function (response) {
                                return {
                                results: response
                                };
                            },
                            cache: true
                            }

                        }
                    );
                }
            });
        });

        // Update employee Ajax request.
        $('#SubmitEditUserForm').click(function(e) {
            e.preventDefault();
        
            $.ajax({
                url: "employee/"+id,
                method: 'PUT',
                data: {
                    name: $('#editName').val(),
                    email: $('#editEmail').val(),
                    phone_number: $('#editPhone').val(),
                    address: $('#editAddress').val(),
                    photo: $('#editPhoto').val(),
                    company_id: $('#editCompany').val(),
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
                        $('#EditUserModal').hide();
                        toastr.info(result.success);
                        table.ajax.reload();
                    }
                }
            });
        });

        // Delete employee Ajax request.
        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteUserForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
    
            $.ajax({
                url: "employee/"+id,
                method: 'DELETE',
                success: function(data) {
                    $('#DeleteUserModal').modal('hide');
                    toastr.info(data.success);
                    table.ajax.reload();
                }
            });
        });
        
        // Get single employee in InfoModel
        $('.infoClose').on('click', function(){
            $('#DetailUserModal').hide();
        });
        $('body').on('click', '#getDetailUserData', function(e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "employee/"+id,
                method: 'GET',
                // data: {
                //     id: id,
                // },
                success: function(result) {
                    console.log(result);
                    $('#DetailUserModalBody').html(result.html);
                    $('#DetailUserModal').show();
  
                }
            });
        });
    });
</script>
@stop