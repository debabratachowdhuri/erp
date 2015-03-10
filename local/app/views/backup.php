@extends('master')
@section('title')
   Daily Collection Report
@stop
@section('content')

 


   {{ HTML::Script("assets/js/jq.js"); }}
   {{ HTML::Script("assets/js/jquery-ui.js"); }}
   {{ HTML::Script("assets/js/jquery-1.10.2.js"); }}
   {{ HTML::Style("assets/css/jquery-ui.css"); }}

   <script>
        $(function($){
          $('#delete').on('click',function(){
              var mrno = document.getElementById('delete').value;
              var url = '{{ URL::to('/') . '/deletefee?receiptno=' }}' + mrno;
              window.location = url;
          });
        
            $("#datepicker-10").datepicker({
               changeMonth:true,
               changeYear:true,
               numberOfMonths:[2,2]
            });
         });
        </script>



<div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i> Collection Report</h4>
                          <section id="unseen">

                            <p>Enter Date: <input type="text" id="datepicker-10"></p>

                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">MR Number</th>
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
                              @foreach($res as $rec)
                              <tr>
                                  <td class="numeric">{{ $rec->receiptno; }}</td>
                                  <td class="numeric">{{ $rec->sid; }}</td>
                                  <td class="numeric">{{ $rec->name; }}</td>
                                  <td class="numeric">{{ $rec->class; }}</td>
                                  <td class="numeric">{{ $rec->sec; }}</td>
                                  <td class="numeric">{{ $rec->roll; }}</td>
                                  <td class="numeric">{{ $month[$rec->frommonth]; }}</td>
                                  <td class="numeric">{{ $month[$rec->tomonth]; }}</td>
                                  <td class="numeric">{{ $rec->fine; }}</td>
                                  <td class="numeric">{{ 230*($rec->tomonth - $rec->frommonth)+$rec->fine; }}</td>
                                  <td class="numeric">
                                    <button type="button" id="delete" value={{ $rec->receiptno; }} class="btn btn-default">Delete</button>
                                    <button type="button" id="print" class="btn btn-primary">Print</button>
                                  </td>
                              </tr>
                              @endforeach
                             </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->     
        </div>
       
    @stop