<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reprint Receipt</title>
 </head>
{{ HTML::Script("assets/js/convert_number.js"); }}
{{ HTML::Style("assets/css/reprint_receipt.css"); }}
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div>
   @foreach($rec as $res)
<div id="apDiv1">
  <div id="apDiv3">Receipt No. - {{ "SSMS/".date("y")."/".$res->receiptno }}
    <div id="apDiv4">Date - 
	<?php 
		$date = new DateTime($res->date);
		echo $date->format('d/m/y');
	?>
    </div>
  </div>
  <p>&nbsp;</p>
  <div id="apDiv7">SOUTH SIDE MODEL SCHOOL <br />
    <span class="KGP">KHARAGPUR </span></div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="806" align="center" class="preview">
    <tr  class="preview">
      <td class="preview" width="139">Student ID</td>
      <td width="246">{{ strtoupper($res->sid) }}</td>
      <td class="preview" width="106">Name</td>
      <td width="289">{{ $res->name;}}</td>
    </tr>
    <tr  class="preview">
      <td class="preview">Class</td>
      <td>{{ $res->class }}</td>
      <td class="preview">Roll No.</td>
      <td>{{ $res->roll }}</td>
    </tr>
    <tr class="preview">
      <td class="preview">From Month</td>
      <td>{{ $month[$res->frommonth] }}</td>
      <td class="preview">To Month</td>
      <td>{{ $month[$res->tomonth] }}</td>
    </tr>
    <tr class="preview">
      <td class="preview" colspan="2" align="center"><strong>Description</strong></td>
      <td  colspan="2" align="center"><strong>Amount</strong></td>
    </tr>
    <tr class="preview">
      <td class="preview" colspan="2" align="left">Tution Fees</td>
      <td colspan="2" align="right">
	 
        {{ $total =  230 * (1+($res->tomonth - $res->frommonth)) }}
     
      </td>
    </tr>
 
   	 @if($res->fine > 0)
		<div style="display:none"> 
     	  {{ $total =  230 * (1+($res->tomonth - $res->frommonth))+$res->fine }}
      </div>
    <tr id="fine_amt" class="preview" style="border:thin">
      <td colspan="2" align="left">Late Fee</td>
      <td colspan="2" align="right">{{ $res->fine }}</td>
    </tr>
   	@else
   		<div style="display:none"> 
		  {{ $fine = 0 }}
		</div>
	@endif
    <tr>
      <td colspan="2" align="left" style="border-bottom:3px solid black;"><b>Total</b></td>
      <td colspan="2" align="right"><div id="total">
	  	{{ $total }}
      </div></td>
    </tr>
    <tr>
      <td colspan="4" align="center">
      	<div id="num2word"></div>
      </td>
    </tr>
  </table>
  <div id="apDiv5">for South Side Model School</div>
  <div id="apDiv9">To avoid &quot;Late Fee&quot; please pay within 10<sup>th</sup> of every month. <br />
    <br />
    System Designed and Developed By:<span class="copy"> Debabrata Chowdhuri</span> (<span class="copy1">debabratachowdhuri@gmail.com</span>)
  </div>
</div>
@endforeach
 <div id="print_btn" align="center">
      <input type="button" value="Print" onclick="operation();"/>
</div>
</body>
</html>
<script type="text/javascript">
function operation() {
		var str = convert_number({{ $total }});
		document.getElementById('num2word').innerHTML = "In Word: Rupees "+str + " Only";
		window.print();
	}
</script>