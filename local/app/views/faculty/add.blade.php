@extends('layout.master')
@section('title')
   Add Student
@stop
@section('content')
 
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4><i class="fa fa-angle-right"></i>Add Faculty</h4>
                      {{ Form::open(array('url' => 'savefaculty', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'add_faculty')) }}
                          
 

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
                              <div class="col-lg-10">
                                    <input type="text" required="required" class="form-control" id="name" name="name" required="required" autocomplete="off" requried placeholder="Name">
                                     <div class="alert alert-warning alert-dismissable" id="warning_name" >
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                     
                                  </div> 
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Contact number</label>
                              <div class="col-lg-10">
                                    <input type="text" required="required" class="form-control" id="contact_number" name="contact_number" required="required" autocomplete="off"   placeholder="Contact Number"> 
                                  </div> 
                              </div>
                          
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Qualification</label>
                              <div class="col-lg-10">
                                    <input type="text" required="required" class="form-control" id="qualification" name="qualification" required="required" autocomplete="off"   placeholder="Qualification"> 
                                  </div> 
                              </div>
                          
 
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date of Birth</label>
                              <div class="col-lg-10">
                                  <input type="date" style="text-transform:uppercase" class="form-control" id="dob" name="dob" required="required" autocomplete="off">
                              </div>
                          </div>


                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Date of Joining</label>
                              <div class="col-lg-10">
                                  <input type="date" style="text-transform:uppercase" class="form-control" id="doj" name="doj" required="required" autocomplete="off">
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
          $('#warning_name').css("display", "none");
                 

          $('#save').on('click',function(){
            if(document.getElementById('name').value.length > 0 ){
                          document.getElementById('add_faculty').submit();
                      }
            else if(document.getElementById('name').value.length == 0 )
                  {
                   $('#warning_name').html("Name can't be blank");
                   $('#warning_name').css("display", "block");
                   document.getElementById('name').focus();
                   exit;
                }                          
          });

           

          $('#reset').on('click',function(){
              window.location = '{{ URL::to('/') . '/addfaulty' }}';
          });
  });
</script>
@stop         