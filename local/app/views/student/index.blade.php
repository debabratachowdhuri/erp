@extends('layout.master')
@section('title')
   Student
@stop
@section('content')
{{ HTML::Style("assets/css/popup.css");}}
<div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Student List</h4>
                      <section id="unseen">
                           {{ Form::open(array('url' => 'showstudent', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'view_student')) }}
                            <table class="table table-bordered table-striped table-condensed" >
                             <tr align="center">
                                 <td align="center">Find Stdent 
                                 <input type="text"  id="student" autocomplete="off" name="sid" style="text-transform:uppercase"></td>
                                 <td><button type="button" name="show" id="show" class="btn btn-info">Show</button></td>
                              </tr>
                             </table>
                            </form>   
                       <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">Student ID</th>
                                  <th class="numeric">Name</th>
                                  <th class="numeric">Class</th>
                                  <th class="numeric">Section</th>
                                  <th class="numeric">Roll</th>
                                  <th class="numeric">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach ($student as $res)
                                <tr id={{"R".$res->sid}}>
                                  <td id={{"sid".$res->sid}}>{{ $res->sid }}</td>
                                  <td id={{"name".$res->sid}}>{{ $res->name }}</td>
                                  <td id={{"class".$res->sid}}>{{ $res->class }}</td>
                                  <td id={{"section".$res->sid}}>{{ $res->sec }}</td>
                                  <td id={{"roll".$res->sid}}>{{ $res->roll }}</td>
                                  <td class="numeric">
                                   
                                        <button class="btn btn-primary btn-xs" id={{$res->sid}} name="edit"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-xs" id={{"delete".$res->sid}} value={{ $res->sid; }} name="delete"><i class="fa fa-trash-o"></i></button>

                                  </td>
                                </tr>
                      @endforeach
                      <tr>
                        <td colspan="6" align="center">
                            {{ $student->links() }}
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
      <label>Studebt ID: <span>*</span></label>
      <input type="text" class="edit_input" id="sid" />
      <input type="hidden" id="hidden_sid">

      <label>Name: <span>*</span></label>
      <input type="text" class="edit_input" id="name" />
      

      <label>Class: <span>*</span></label>
      <select class="edit_input" id="class"  />
          <option value="KG">KG</option>
          <option value="Junior">Junior</option>
          <option value="Senior">Senior</option>
          <option value="I">I</option>
          <option value="II">II</option>
          <option value="III">III</option>
          <option value="IV">IV</option>
      </select>
    
      <label>Section: <span>*</span></label>
      <input type="text" class="edit_input" id="section"  />
      

      <label>Roll: <span>*</span></label>
      <input type="text" class="edit_input" id="roll" />
     
      <div id="loading">
        {{ HTML::Image("assets/img/custom/saving.gif")}}
      </div>
           
      <input type="button" id="Save" value="Save"/>
      <input type="button" id="cancel" value="Cancel"/>
      <br/>
</div>
<script>
  $(document).ready(function(){
    $('[name = "show"]').on('click',function(){
        document.getElementById('view_student').submit();
    });

    $("#loading").css("display", "none");
      
    $('[name = "edit"]').on('click',function(){ 
         var id= this.id;
         $("#contactdiv").css("display", "block");
         $("#sid").val(document.getElementById("sid"+id).innerHTML);
         $("#hidden_sid").val(document.getElementById("sid"+id).innerHTML);
         $("#name").val(document.getElementById("name"+id).innerHTML);
         $("#class").val(document.getElementById("class"+id).innerHTML);
         $("#section").val(document.getElementById("section"+id).innerHTML);
         $("#roll").val(document.getElementById("roll"+id).innerHTML);
      });

      $('#Save').on('click',function(){
        $("#loading").css("display", "block");
        $.ajax( { 
                       url:'editstudent',
                       method : 'get',
                       dataType: 'json',
                       data: {
                          "sid"     : $("#sid").val(),
                          "hsid"    : $("#hidden_sid").val(),
                          "name"    : $("#name").val(),
                          "class"   : $("#class").val(),
                          "section" : $("#section").val(),
                          "roll" : $("#roll").val() 
                        },
                       success: function (data) {
                        $("#loading").css("display", "none");
                         var id = $("#hidden_sid").val();
                         
                         $("#sid"+id).html(document.getElementById("sid").value);
                         $("#name"+id).html(document.getElementById("name").value);
                         $("#class"+id).html(document.getElementById("class").value);
                         $("#section"+id).html(document.getElementById("section").value);
                         $("#roll"+id).html(document.getElementById("roll").value);
                         $("#contactdiv").css("display", "none");
                        }
                      });
    });

            $('[name = "delete"]').on('click',function(){ 
              var obj_id = this.id;
              var sid = document.getElementById(obj_id).value;
              $.ajax( {
                       url:'deletestudent',
                       method : 'get',
                       dataType: 'json',
                       data: {"sid" :sid },
                       success: function (data) {
                          $('#R'+sid).hide( "slow" );
                        }
                      });
          });

      $("#contact #cancel").click(function() {
          $("#loading").css("display", "none");
          $(this).parent().parent().hide();
      });

//Hide On esc press

       var elem = $( '#contactdiv' )[0];                      
      $( document ).on( 'keydown', function ( e ) {
          if ( e.keyCode === 27 ) {
              $( elem ).hide();
          }
      });
  });
</script>
@stop