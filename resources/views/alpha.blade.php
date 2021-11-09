@extends('adminlte::page')
 
@section('title', 'Alpha')
 
@section('content_header')
    <h1>Alpha</h1>
@stop
@section('content')

       <div class="card">
         <div class="card-header">
         <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#CreateUserModal"> 
                Create New Data
            </button>
         </div>
         
         <div class="card-body"> 

         <div id="showtable"></div> 
       
        </div>
   
<!-- modal -------------------------------------->
<!-- Create User Modal -->
<div class="modal" id="CreateUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data Create</h4>
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
                    <label for="name">Gender:</label>
                    <input type="text" class="form-control" name="gender" id="gender">
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

<!-- Information modal -->
<div class="modal" id="DetailUserModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Data Information</h4>
                <button type="button" class="close infoClose" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              
            <div id="DetailUserModalBody">

                <b>Name:</b>
                <p id="name-info"></p>
                <b>Email:</b>
                <p id="email-info"></p>
                <b>Phone:</b>
                <p id="phone-info"></p>
                <b>Gender:</b>
                <p id="gender-info"></p>

                                
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

    function getApi(){
        var op ="";
        $.ajax({
                    type:'get',
                    url: "{{route('alpha.getAllPost')}}",
                        success: function(response){
                            let getData = response.data;
                            let result = getData.tester.map(({id, name, email, phone_number, gender}) => ({id, name, email, phone_number, gender}));
                        op+='<table class="table table-striped">';
                        op+='<tr><th>Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Action</th></tr>';
                        for(var i=0;i<result.length;i++){
                        op+='<tr>';
                        op+='<td>'+result[i].name+'</td><td>'+result[i].email+'</td><td>'+result[i].phone_number+'</td><td>'+result[i].gender+'</td><td><button type="button" class="btn btn-default btn-sm" id="getDetailUserData" data-id="'+result[i].id+'">Detail</button></td></tr>';
                        }
                        op+='</table>';
                        $('#showtable').html(op);
                        //console.log("Data Correctly Processed");
                        
                        console.log(result);
                        },
                        error: function(){
                        console.log("Error Occurred");
                        }
                    });
    }

    getApi();



      
  
// Create Data Ajax request.
        $('#SubmitCreateUserForm').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('alpha.addPost') }}",
                type: 'post',
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone_number: $('#phone_number').val(),
                    gender: $('#gender').val()
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
                        toastr.info(result);
                        getApi();
           
                    }
                }
            });
        });

           // Get single data in InfoModel
        $('.infoClose').on('click', function(){
            $('#DetailUserModal').hide();
        });
        $('body').on('click', '#getDetailUserData', function(e) {
            // e.preventDefault();
            id = $(this).data('id');
            $.ajax({
                url: "{{ route('alpha.getPostById') }}",
                method: 'post',
                data: {
                     id: id,
                },
                success: function(response) {
                    console.log(response);
                    let getDatx = response.alphax;
                    let resultx = getDatx.data;
                    console.log(resultx.name);
                    $("#name-info").html(resultx.name);
                    $("#email-info").html(resultx.email);
                    $("#phone-info").html(resultx.phone_number);
                    $("#gender-info").html(resultx.gender);
                    $('#DetailUserModal').modal('show');
  
                }
            });
        });

    });
</script>
@stop