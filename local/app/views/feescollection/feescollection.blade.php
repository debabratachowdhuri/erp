@extends('layout.master')
@section('title')
   Fees Collection 
@stop
@section('content')
{{ HTML::Style("assets/css/print.css"); }}
  
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
              <div class="col-lg-12">
                  <div class="form-panel">
                      
                      {{ Form::open(array('url' => 'save', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'collection_form')) }}
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Student ID</label>
                               <div class="col-sm-10">
                                  <input type="text" class="form-control" id="sid" name="sid" required="required" autocomplete="off"  style="text-transform:uppercase" requried>
                                  <div class="alert alert-warning alert-dismissable" id="warning">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <strong>Warning!</strong> Invalid Student ID.
                                  </div>  
                              </div>
                          </div>

                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Name</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="name"></p>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Class</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="class"></p>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Sec.</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="sec"></p>
                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Roll</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="roll"></p>
                              </div>
                          </div>  

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Form Month</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="month"></p>
                              </div>
                          </div>                     
                          

                           <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Select Month</label> 
                              <div class="col-sm-10">
                                <select class="form-control" id="to_month" name="to_month"></select>
                              </div>
                            </div>
                          
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Fine</label>
                              <div class="col-lg-10">
                                  <input class="form-control" id="focusedInput" type="text" Placeholder="0" autocomplete="off">
                              </div>
                          </div>                     

                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Amount</label>
                              <div class="col-lg-10">
                                  <p class="form-control-static" id="amount"></p>
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
                                      <button type="button" id="print" class="btn btn-theme">Print</button>
                                    </div>
                                    <div class="btn-group">
                                      <button type="button" id="reset" class="btn btn-theme">Reset</button>
                                    </div>
                                  </div>              
                                </div>  
                          </div>

                          <input type="hidden" name="class" id="hidden_class">
                          <input type="hidden" name="roll" id="hidden_roll">
                          <input type="hidden" name="tomonth" id="hidden_tomonth">
                          <input type="hidden" name="frommonth" id="hidden_frommonth">
                          <input type="hidden" name="fine" id="hidden_fine">

                      </form> 
           


   {{ HTML::Script("assets/js/jq.js"); }}
   {{ HTML::Script("assets/js/convert_number.js"); }}
   <script>
      var tm, total , fm  ;
      var tution_fees = {{ $tution_fees }};
      $(document).ready(function(){
        $('#warning').css("display", "none");
        $("#sid").blur(function(){  
                    $.ajax( {
                       url:'sid',
                       method : 'get',
                       dataType: 'json',
                       data: {"sid" : document.getElementById('sid').value },
                       success: function (data) {            
                       if(data.length == 0) {
                         $('#warning').css("display", "block");
                         document.getElementById('sid').value = "";
                         document.getElementById('sid').focus();
                         exit;
                       }     
                      $.each(data, function(index, element) {
                            $('#warning').css("display", "none");
                            $("#s_id").html(document.getElementById('sid').value);//Print View
                            $("#name").html(element.name);
                            $("#sname").html(element.name);//Print View
                            $("#class").html(element.class);
                            $("#cls").html(element.class);//Print View
                            $("#hidden_class").val(element.class);//Hidden  Field 
                            $("#sec").html(element.sec);
                            $("#section").html(element.sec);
                            $("#roll").html(element.roll);
                            $("#roll_no").html(element.roll);//Print View
                            $("#hidden_roll").val(element.roll);//Hidden  Field 
		
                    $.ajax( {
                       url:'month',
                       method : 'get',
                       dataType: 'json',
                       data: {"sid" : document.getElementById('sid').value },
                       success: function (data) { 
                      $.each(data, function(index, element) {
                          var month = {
                                        1:"January",
                                        2:"February",
                                        3:"March",
                                        4:"April",
                                        5:"May",
                                        6:"June",
                                        7:"July",
                                        8:"August",
                                        9:"September",
                                        10:"October",
                                        11:"November",
                                        12:"December"
                                    };
                           $("#month").html(month[Number(element.month) + 1 ]);
                           var option = ''; 
                           tm = Number(element.month) + 1;
                            $("#hidden_tomonth").val(Number(element.month) + 1);//Hidden Field
                            $("#hidden_frommonth").val(Number(element.month) +1);//Hidden Field

                            $("#tomonth").html(month[Number(element.month) + 1]);//Print View
                            $("#frommonth").html(month[Number(element.month) + 1]);//Print View
                            for (i = Number(element.month) + 1;i <= 12;i++){
                                option += '<option value="'+ i + '">' + month[i] + '</option>';
                            }
                            $('#to_month').empty();
                            $('#to_month').append(option);
                            $('#amount').html(tution_fees);
                            $("#tutionfee").html(tution_fees);
                          });
                      }
                   });
               });
            }
        });
      });

        $("#to_month").on('change',function(){
        	var month = {
                                        1:"January",
                                        2:"February",
                                        3:"March",
                                        4:"April",
                                        5:"May",
                                        6:"June",
                                        7:"July",
                                        8:"August",
                                        9:"September",
                                        10:"October",
                                        11:"November",
                                        12:"December"
                                    };
            fm = document.getElementById("to_month").value;
            $("#hidden_tomonth").val(Number(fm));//Hidden Field
            $("#tomonth").html("");
            $("#tomonth").html(month[Number(fm)]);//Print View	
            var fine = Number(document.getElementById("focusedInput").value);
            total = tution_fees * ((fm - tm) + 1) + fine;
            total_rs = tution_fees * ((fm - tm) + 1);
            $("#tutionfee").html(total_rs);
            $("#total_amt").html(total);//Print View
            $("#amount").html(total);
            var str = "In word:Rs."+convert_number(Number(total))+" Only";
            $("#num2word").html(str);
        });

        $("#focusedInput").on('blur', function(){ 
            if(isNaN((document.getElementById("focusedInput").value)))
            {
              $("#amount").html('0');
            }
            else  
            { 
              fm = document.getElementById("to_month").value;
              var fine = document.getElementById("focusedInput").value;
              total = tution_fees * ((fm - tm) + 1) + Number(fine);
              if(Number(fine) > 0)
              {
                    $("#caption").html("Fine");
                    $("#fine_amount").html(fine);  
              }
              else
              {
                    $("#caption").html("");
                    $("#fine_amount").html("");   
              }
              $("#hidden_fine").val(fine);//Hidden Field
              $("#amount").html(total);
              $("#total_amt").html(total);//Print View
              var str = "In word:Rs."+convert_number(Number(total))+" Only";
              $("#num2word").html(str);
            }
        });

        //Button Group

          $('#save').on('click',function(){
            if(document.getElementById('sid').value.length > 0 ){
                          document.getElementById('collection_form').submit();
                      }
            else
              {
                 $('#warning').css("display", "block");
                 document.getElementById('sid').focus();
              }
          });

          $('#print').on('click',function(){
              if(document.getElementById('sid').value.length > 0 )
                {
                    window.print();
                    document.getElementById('collection_form').submit();
                }
                else
                  {
                          $('#warning').css("display", "block");
                          document.getElementById('sid').focus();
                  }
          });
          

          $('#reset').on('click',function(){
              window.location = '{{ URL::to('/') . '/collect' }}';
          });
  });


   </script>
  @stop
  @section('print')
    <!-- Print DIV -->
<div id="print_area">
   <div id="apDiv1">
    <div id="apDiv3">Receipt No. - {{  "SSMS/".date("y")."/". $receiptno }}
      <div id="apDiv4">Date - {{ date("d/m/y") }} </div>
    </div>
    <p>&nbsp;</p>
    <div id="apDiv7">SOUTH SIDE MODEL SCHOOL <br />
    <span class="KGP">KHARAGPUR </span></div>
    <p>&nbsp;</p>
    <table width="806" align="center" class="preview" style="margin-top:120px;">
      <tr  class="preview"> 
        <td class="preview" width="139">Student ID</td>
        <td width="246"><div id="s_id"></div></td>
        <td class="preview" width="106">Name</td>
        <td width="289"><div id="sname"></div></td>
      </tr>
      <tr  class="preview">
        <td class="preview">Class</td>
        <td><div id="cls"></div></td>
        <td class="preview">Roll No.</td>
        <td>
          <table width="264">
          <tr>
              <td width="81"><div id="roll_no"></div></td>
                <td width="63">Sec.</td>
                <td width="49"><div id="section"></div></td>
          </table>
      </tr>
       <tr class="preview">
        <td class="preview">From Month</td>
        <td><div id="frommonth"></div></td>
        <td class="preview">To Month</td>
        <td><div id="tomonth"></div></td>
      </tr>
      <tr class="preview">
        <td class="preview" colspan="2" align="center"><strong>Description</strong></td>
        <td  colspan="2" align="center"><strong>Amount</strong></td>
      </tr>
      <tr class="preview">
        <td class="preview" colspan="2" align="left">Tution Fees</td>
        <td colspan="2" align="right"><div id="tutionfee"></div></td>
      </tr>
      <tr id="fine_amt" class="preview" style="border:thin">
        <td colspan=2 align=left><div id="caption"></div></td>
        <td colspan=2 align=right><div id="fine_amount"></div></td>
      </tr>
       <tr>
        <td colspan=2 align=left style="border-bottom:3px solid black;"><b>Total</b></td>
        <td colspan=2 align=right><div id="total_amt"></div></td>
       </tr>
       <tr>
         <td colspan=4 align=center><div id="num2word">In word:Rs. Two Hundred Thirty Only</div></td>
       </tr>
    </table>
    <div id="apDiv5">for South Side Model School</div>
    <div id="apDiv9">To avoid &quot;Late Fee&quot; please pay within 10<sup>th</sup> of every month. <br />
      <br />
      System Designed and Developed By:<span class="copy"> Debabrata Chowdhuri</span> (<span class="copy1">debabratachowdhuri@gmail.com</span>)<br />
       <br /><br />
    </div>
  </div>
</div>

<!-- End -->
@stop         

