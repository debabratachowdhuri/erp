@extends('layout.master')
@section('title')
   Monthly Collection Report
@stop
@section('content')

   {{ HTML::Script("assets/js/jquery-ui.js"); }}
   {{ HTML::Style("assets/css/jquery-ui.css"); }}

<div class="row mt">
            <div class="col-lg-12">
                      <div class="content-panel">
                      <h4><i class="fa fa-angle-right"></i>Monthly Collection Report</h4>
                      <section id="unseen">
                            <table class="table table-bordered table-striped table-condensed">
                              <thead>
                              <tr>
                                  <th class="numeric">Month</th>
                                  <th class="numeric">Amount</th>
                                  
                              </tr>
                              </thead>
                              <tbody>
                               <div style="display:none"> 
                                {{ $total = 0 }}
                              </div>
                              @foreach($res as $rec)
                              <tr>
                                  <td class="numeric">{{ $rec->mnth; }}</td>
                                  <td class="numeric">{{ $rec->total; }}</td>
                              </tr>
                              <div style="display:none"> 
                                {{ $total = $total + $rec->total }}
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
        
    @stop