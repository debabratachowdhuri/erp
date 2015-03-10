@extends('layout.master')
@section('title')
   Daily Collection Report
@stop
@section('content')

   {{ HTML::Script("assets/js/jquery-ui.js"); }}
   {{ HTML::Style("assets/css/jquery-ui.css"); }}
 

<div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i> Collection Report</h4>
                      <section id="unseen">
                             
                        {{ Form::open(array('url' => 'show', 'method' => 'post','class' => 'form-horizontal style-form', 'id' => 'collection_report')) }}      
                             <table class="Table table-striped table-advance table-hover" >
                             <tr>
                               <td>From Date  <input  type="date" id="from_date" name="frm_dt"></td>
                               <td>To Date  <input type="date" id="to_date" name="to_dt"></td>
                               <td>Serch By Stdent ID  <input type="text" id="s_id" autocomplete="off" name="sid" style="text-transform:uppercase"></td>
                               <td><button type="button" id="show" class="btn btn-info">Show</button></td>
                              </tr>
                             </table>
                          </form>  

                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">MR Number</th>
                                  <th class="numeric">Date</th>
                                  <th class="numeric">Student ID</th>
                                  <th class="numeric">Name</th>
                                  <th class="numeric">Class</th>
                                  <th class="numeric">Sec</th>
                                  <th class="numeric">Roll</th>
                                  <th class="numeric">From Month</th>
                                  <th class="numeric">To Month</th>
                                  <th class="numeric">Fine</th>
                                  <th class="numeric">Total</th>
                                  <th class="numeric">Action</th>
                              </tr>
                              </thead>
                              <tbody>
                               <div style="display:none"> 
                                {{ $total = 0 }}
                              </div>
                              @foreach($res as $rec)
                              <tr id= {{ "R".$rec->receiptno;  }}>
                                  <td class="numeric">{{ $rec->receiptno; }}</td>
                                  <td class="numeric">{{ $rec->date; }}</td>
                                  <td class="numeric">{{ $rec->sid; }}</td>
                                  <td class="numeric">{{ $rec->name; }}</td>
                                  <td class="numeric">{{ $rec->class; }}</td>
                                  <td class="numeric">{{ $rec->sec; }}</td>
                                  <td class="numeric">{{ $rec->roll; }}</td>
                                  <td class="numeric">{{ $month[$rec->frommonth]; }}</td>
                                  <td class="numeric">{{ $month[$rec->tomonth]; }}</td>
                                  <td class="numeric">{{ $rec->fine; }}</td>
                                  <td class="numeric">{{ $tution_fees *(($rec->tomonth - $rec->frommonth)+1)+$rec->fine; }}</td>
                                  <td class="numeric">
                                   
                                   <a href="javascript:void(0)" onclick="popitup('{{ URL::to('/') }}/reprint/{{$rec->receiptno}}','Reprint Receipt',1000,650);">
                                    <button class="btn btn-primary btn-xs" id={{"print".$rec->receiptno}}><i class="fa fa-print"></i></button>
                                  </a>
                                    <button class="btn btn-danger btn-xs" id={{"delete".$rec->receiptno}} name="delete" value={{ $rec->receiptno; }}><i class="fa fa-trash-o"></i></button>

                                  </td>
                              </tr>
                              <div style="display:none"> 
                                {{ $total = $total + $tution_fees * (($rec->tomonth - $rec->frommonth)+1)+$rec->fine }}
                              </div>
                              @endforeach
                              <tr>
                                  <td colspan="10" align="right">Total</td>
                                  <td>{{ $total }}</td>
                                  <td></td>
                              </tr>
                             </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->     
        </div>
        <script>
        $(document).ready(function(){
          $('[name = "delete"]').on('click',function(){ 
              var obj_id = this.id;
              var mrno = document.getElementById(obj_id).value;
              $.ajax( {
                       url:'deletefee',
                       method : 'get',
                       dataType: 'json',
                       data: {"receiptno" :mrno },
                       success: function (data) {
                          $('#R'+mrno).hide( "slow" );
                        }
                      });
          });

          $("#show").on('click',function(){
              document.getElementById('collection_report').submit();
          }); 
      });
        </script>
        <script language="javascript" type="text/javascript">
        <!--
        function popitup(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
            var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
            var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

            width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            var left = ((width / 2) - (w / 2)) + dualScreenLeft;
            var top = ((height / 2) - (h / 2)) + dualScreenTop;
            var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

            // Puts focus on the newWindow
            if (window.focus) {
                newWindow.focus();
            }
        }

// -->
</script>
    @stop