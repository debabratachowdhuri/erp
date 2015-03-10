@extends('layout.master')
@section('title')
   Faculty
@stop
@section('content')
{{ HTML::Style("assets/css/popup.css");}}
<div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Faculty List</h4>
                      <section id="unseen">
                      <div id="success_message" class="alert alert-success">Login Details Successfully Updated</div>
                          <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">Name</th>
                                  <th class="numeric">Contact</th>
                                  <th class="numeric">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($faculty as $res)
                                <tr id={{"R".$res->id}}>
                                  <td id={{"name".$res->id}}>{{ $res->name }}</td>
                                  <td id={{"contact".$res->id}}>{{ $res->contactno }}</td>
                                  <input type="hidden" value="{{ $res->id}}" id={{"fid". $res->id}}>
                                  <input type="hidden" value="{{ $res->dob}}" id={{"dob". $res->id}}>
                                  <input type="hidden" value="{{ $res->doj}}" id={{"doj". $res->id}}>
                                  <input type="hidden" value="{{ $res->qualification}}" id={{"qualification". $res->id}}>                                  
                                  
                                  <td class="numeric">
                                   
                                        <button class="btn btn-warning btn-xs" id={{"login".$res->id}} value={{ $res->id; }} name="login"><i class="fa fa-key"></i></button>
                                        <button class="btn btn-primary btn-xs" id={{$res->id}} name="edit"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-xs" id={{"delete".$res->id}} value={{ $res->id; }} name="delete"><i class="fa fa-trash-o"></i></button>

                                  </td>
                                </tr>
                      @endforeach
                      <tr>
                        <td colspan="6" align="center">
                            {{ $faculty->links() }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
            </div>
</div>
<div id="contactdiv">
      <h3>Edit </h3>
 <form class="form" action="#" id="contact">     
 

      <label>Name: <span>*</span></label>
      <input type="text" class="edit_input" id="name" />
       
      <label>Contact <span>*</span></label>
      <input type="text" class="edit_input" id="contactno"  />

      <label>Qualification <span></span></label>
      <input type="text" class="edit_input" id="qualification" readonly="readonly"  />      

      <label>Age:</label>
      <input type="text" class="edit_input" id="age"  readonly="readonly"  />

      <label>Years of Service:</label>
      <input type="text" class="edit_input" id="yos" readonly="readonly" />
     
      <input type="hidden" class="edit_input" id="hidden_id" readonly="readonly" />

      <div id="loading">
        {{ HTML::Image("assets/img/custom/saving.gif")}}
      </div>
                
      <input type="hidden" id="hidden_fid">
      <input type="button" id="Save" value="Save"/>
      <input type="button" id="cancel" value="Cancel"/>
      <br/>
     </form> 
</div>
<div id="logindiv">
      <h3>Create / Modify Login </h3>
 <form class="form" action="#" id="login">   

      <label>Username: <span>*</span></label>
      <input type="text" class="edit_input" id="username" />
       
      <label>Password <span>*</span></label>
      <input type="password" class="edit_input" id="password"  />

      <label>Confirm Password <span></span></label>
      <input type="password" class="edit_input" id="confirm_password"   />    
      <div id="invalid"></div>  

      <input type="hidden" class="edit_input" id="hidden_id" readonly="readonly" />

      <div id="login_loading">
        {{ HTML::Image("assets/img/custom/saving.gif")}}
      </div>
                
      <input type="hidden" id="loging_hidden_fid">
      <input type="button" id="login_save" value="Save"/>
      <input type="button" id="login_cancel" value="Cancel"/>
      <br/>
    </form>
</div>
<script>
  $(document).ready(function(){
    $("#success_message").hide();
    $("#loading").css("display", "none");
    var id;
    $('[name = "login"]').on('click',function(){  
           id = this.id;

          $("#logindiv").css("display", "block");
          $("#login_loading").css("display", "none");
          $("#invalid").css("display", "none");
          $("#username").val("") ;
          $("#confirm_password").val("") ;
          $("#password").val("") ;
          $("#confirm_password").css("border-color","");
    });

    $("#login_save").on('click',function(){
      if($("#username").val().length == 0)
      { 
        $("#username").css("border-color","red");
        $("#invalid").css("color", "red");
        $("#invalid").css("display", "block");
        $("#invalid").html("Username cannot be blank");
      }
      else if($("#password").val().length == 0)
      {
        $("#password").css("border-color","red");
        $("#invalid").css("color", "red");
        $("#invalid").css("display", "block");
        $("#invalid").html("Password cannot be blank");
      }
      else if($("#password").val().trim() != $("#confirm_password").val().trim())
        {
          $("#confirm_password").val("") ;
          $("#confirm_password").css("border-color","red");
          $("#invalid").css("display", "block");
          $("#invalid").css("color", "red");
          $("#invalid").html("The passwords do not match");
        }
        else
        {
            $("#loading").css("display", "block");
            
            $.ajax( { 
                       url      : 'createlogin',
                       method   : 'get',
                       dataType : 'json',
                       data: {
                          "id"            : $('#'+id).val(),
                          "username"      : $("#username").val(),
                          "password"      : $("#password").val(),
                        },
                       success: function (data) {
                        $("#loading").css("display", "none");
                        $("#name"+id).html($("#name").val());
                        $("#contact"+id).html($("#contactno").val());
                        $("#logindiv").css("display", "none");
                        $('#success_message').fadeIn('fast').delay(1000).fadeOut('slow');
                       }
                    });
        }
    });

      
    $('[name = "edit"]').on('click',function(){  
         var id= this.id;

         var age = document.getElementById("dob"+id).value;
         var yos = document.getElementById("doj"+id).value;

         age = age.substring(6,10);
         yos = yos.substring(6,10);

         var d = new Date();
         var y = d.getFullYear();

         $("#age").val( (Number(y) - Number(age)) );
         $("#yos").val( (Number(y) - Number(yos)) );

         $("#contactdiv").css("display", "block");
         $("#hidden_id").val(id);
         $("#name").val(document.getElementById("name"+id).innerHTML);
         $("#qualification").val(document.getElementById("qualification"+id).value);
         $("#contactno").val(document.getElementById("contact"+id).innerHTML);
       });
      $('#Save').on('click',function(){
        $("#loading").css("display", "block");
        $.ajax( { 
                       url:'editfaculty',
                       method : 'get',
                       dataType: 'json',
                       data: {
                          "fid"       : $("#hidden_id").val(),
                          "name"      : $("#name").val(),
                          "contact"   : $("#contactno").val(),
                        },
                       success: function (data) {
                        $("#loading").css("display", "none");
                         var id = $("#hidden_id").val();
                         
                         $("#name"+id).html($("#name").val());
                         $("#contact"+id).html($("#contactno").val());
                         $("#contactdiv").css("display", "none");
                        }
                      });
    });

            $('[name = "delete"]').on('click',function(){ 
              var obj_id = this.id;
              var fid = document.getElementById(obj_id).value;
              $.ajax( {
                       url:'deletefaculty',
                       method : 'get',
                       dataType: 'json',
                       data: {"fid" :fid },
                       success: function (data) {
                          $('#R'+fid).hide( "slow" );
                        }
                      });
          });

      $("#contact #cancel").click(function() {
          $("#loading").css("display", "none");
          $(this).parent().parent().hide();
      });

       $("#login #login_cancel").click(function() {
          $("#loading").css("display", "none");
          $(this).parent().parent().hide();
      });

       $('[name = "edit"]').on('click',function(){  
         var id= this.id;

         var age = document.getElementById("dob"+id).value;
         var yos = document.getElementById("doj"+id).value;

         age = age.substring(6,10);
         yos = yos.substring(6,10);

         var d = new Date();
         var y = d.getFullYear();

         $("#age").val( (Number(y) - Number(age)) );
         $("#yos").val( (Number(y) - Number(yos)) );

         $("#contactdiv").css("display", "block");
         $("#hidden_id").val(id);
         $("#name").val(document.getElementById("name"+id).innerHTML);
         $("#qualification").val(document.getElementById("qualification"+id).value);
         $("#contactno").val(document.getElementById("contact"+id).innerHTML);
       });

//Hide div on esc press
      var elem = $( '#contactdiv' )[0];
      $( document ).on( 'keydown', function ( e ) {
          if ( e.keyCode === 27 ) {
              $( elem ).hide();
          }
      });

      var log = $( '#logindiv' )[0];
      $( document ).on( 'keydown', function ( e ) {
          if ( e.keyCode === 27 ) {
              $( log ).hide();
          }
      });

  });
</script>
@stop