@extends('layout.master')
@section('title')
   Add Student
@stop
@section('content')
 
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4><i class="fa fa-angle-right"></i>Add Student</h4>
                      {{ Form::open(array('url' => 'savestudent', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'add_student')) }}
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Student ID</label>
                              <div class="col-lg-10">
                                     <p class="form-control-static" id="name">{{ $lastid->sid }}</p>
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Student ID</label>
                               <div class="col-sm-10">
                                  <input type="text" class="form-control" id="sid" name="sid" required="required" autocomplete="off"  style="text-transform:uppercase" placeholder="Student ID">
                                  <div class="alert alert-warning alert-dismissable" id="warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Warning!</strong> Student ID already exists.
                                  </div>  
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
                              <div class="col-lg-10">
                                    <input type="text" required="required" class="form-control" id="sname" name="sname" required="required" autocomplete="off" requried placeholder="Name">
                                     <div class="alert alert-warning alert-dismissable" id="warning_name" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                     
                                  </div> 
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Class</label>
                              <div class="col-lg-10">
                                    <select class="form-control" id="class" name="sclass" />
                                        <option disabled="disabled" selected="selected">Select Class</option>
                                        <option value="KG">KG</option>
                                        <option value="Junior">Junior</option>
                                        <option value="Senior">Senior</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                    </select>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Sec.</label>
                              <div class="col-lg-10">
                                  <input type="text" style="text-transform:uppercase" class="form-control" id="ssec" name="ssec" required="required" autocomplete="off" requried placeholder="Section">
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Roll</label>
                              <div class="col-lg-10">
                                  <input type="text" class="form-control" id="sroll" name="sroll" required="required" autocomplete="off" requried placeholder="Roll">
                              </div>
                          </div>  
                    </div>
              </div>
            </div><!-- /row -->                                
                      
                          <div class="form-group">
                               <div class="showback">
                                  <div class="btn-group btn-group-justified">
                                    <div class="btn-group">
                                      <button type="button" id="save" class="btn btn-theme">Save</button>
                                    </div>
                                    
                                    <div class="btn-group">
                                      <button type="button" id="reset" class="btn btn-theme">Reset</button>
                                    </div>
                                  </div>              
                                </div>  
                          </div>
                      </form> 
             



   {{ HTML::Script("assets/js/jq.js"); }}
   
   <script>
      
      $(document).ready(function(){
        $('#warning').css("display", "none");
        $('#warning_name').css("display", "none");
        $("#sid").blur(function(){  
                    $.ajax({
                       url:'sid',
                       method : 'get',
                       dataType: 'json',
                       data: {"sid" : encodeURIComponent(document.getElementById('sid').value) },
                       success: function (data) {            
                       if(data.length == 0) {
                            $('#warning').css("display", "none");
                      } 
                      else{
                               $('#warning').css("display", "block");
                               document.getElementById('sid').value = "";
                               document.getElementById('sid').focus();
                               exit;
                      }
                    }    
              });    
          });          

          $('#save').on('click',function(){
            if(document.getElementById('sid').value.length > 0 && document.getElementById('sname').value.length > 0 ){
                          document.getElementById('add_student').submit();
                      }
            else if(document.getElementById('sname').value.length == 0 )
                  {
                   $('#warning_name').html("Name can't be blank");
                   $('#warning_name').css("display", "block");
                   document.getElementById('sname').focus();
                   exit;
                }
              
            else
              {
                 $('#warning').html("Student ID can't be blank");
                 $('#warning').css("display", "block");
                 document.getElementById('sid').focus();
                 exit;
              }
          });

           

          $('#reset').on('click',function(){
              window.location = '{{ URL::to('/') . '/collect' }}';
          });
  });
</script>
@stop         