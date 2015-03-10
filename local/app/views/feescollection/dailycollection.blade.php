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
                      <h4><i class="fa fa-angle-right"></i>Daily Collection Report</h4>
                      <section id="unseen">
                           <table class="table table-bordered table-striped table-condensed" >
                             <tr>  
                              <td align="right" valign="middle">Select Month</td>
                                <td>
                                  <select name="month" class="form-control" id="mnth">
                                    <option disabled="disable"> Select Month</option>                              
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">Novomber</option>
                                    <option value="12">December</option>
                                  </select>
                                </td>
                              </tr>
                            </table>
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">Date</th>
                                  <th class="numeric">Amount</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                               <div style="display:none"> 
                                {{ $total = 0 }}
                              </div>
                              @foreach($res as $rec)
                              <tr>
                                  <td class="numeric">{{ $rec->date; }}</td>
                                  <td class="numeric">{{ $rec->amount; }}</td>
                              </tr>
                              <div style="display:none"> 
                                {{ $total = $total + $rec->amount }}
                              </div>
                              @endforeach
                              <tr>
                                  <td align="right">Total</td>
                                  <td>{{ $total }}</td>
                              </tr>
                             </tbody>
                          </table>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->     
        </div>
        <script>
        $(document).ready(function(){
          $(function() {
              $("#mnth").val({{ $month }});
          });
           $("#mnth").on('change',function(){
                  var mn = this.value;
                  var url = "{{ URL::to('/').'/dailycollection?mnth=' }}"+mn;
                  window.location= url;                                   
           });
      });
        </script>
        
    @stop