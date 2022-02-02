<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Parcels PDF</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm 1.5cm ;
        }

        body {
            font-family: "URW Gothic L", "Gotham Narrow", "Andrew Samuels";
            font-size: 0.8em;
        }

        h2 {
            text-align: center;
            margin: 5px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        .right {
            text-align: right
        }

        .left {
            text-align: left
        }

        td {
        {#border: 1px solid black;#} vertical-align: top;
        }

        .btgrey {
            border-top: 1px solid grey
        }

        .bbgrey {
            border-bottom: 1px solid grey;
        }

        h3 {
            margin: 3px
        }

        .double {
            border-bottom: 3px double black;
        }

        .logo {
            width: 100%;
        }

        .picha {
            width: 15%;
            float: left;
            text-align: right;

        {#border: 1px solid black;#}
        }

        .jina {
            float: left;
            width: 70%;
        {#border: 1px solid black;#}
        }

        .jina > h1 {
            color: darkgreen;
            font-family: "Times New Roman";
            margin-top: 5px;
            margin-bottom: 0;
            text-align: center;
        {#border: 1px solid black;#}
        }

        .jina > h1 > span {
        {#font-size: 0.9em; Todo Adjust if page font sizes change#}
        }

        .jina > h5 {
            margin: 0;
            text-align: center;
        {#border: 1px solid black;#}
        }

        .header {
            clear: both;
        }

        .page-header {
            clear: both;
        }

        tr:nth-of-type(even):not(.dont) > td {
            background-color: #f9f9f9;
        }

        .red {
            color: red
        }

        .green {
            color: green
        }

        h1 {
            text-align: center
        }

        th {
            text-align: unset;
        }

        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        tr.page-break {
            display: block;
            page-break-before: always;
        }
        pre > * {
            font-size: 1.5em;
        }
        @page {
            size: A4 landscape;
            margin: 1cm 1.5cm ;
        }

        table {
            table-layout: fixed;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding:10px;
        }
    </style>
  </head>
  <body>

    <table class="table table-sm table-bordered table-striped">
    	<thead>
    		<tr>
    			<th colspan="11">
    				<center>
    					<u><h1> {{ config('app.name', 'Fulcrum') }} Processed Parcels<br>
    						Station : {{ Auth::user()->station_name }}<br>
    						Date: <?php echo  date("Y-m-d");?>

    					</h1></u>
    				</center>
    			</th>
    		</tr>
    	</thead>
	<thead>
		<tr>
			<th colspan="1">#</th>
			<th>Parcel Number</th>
			<th>Sender Name</th>
			<th>Sender Phone</th>
			<th>Station</th>
			<th>Recipient Name</th>
			<th>Recipient ID</th>
			<th>Recipient Phone</th>
			<th>Status</th>
            <th>Date processed</th>
            <th>Cost</th>
			
		</tr>
	</thead>
	<tbody><?php $num = 0;?>
		@forelse($parcels as $key=>$p)
		<?php $num++;?>
		<tr>
			<td colspan="1">{{ $num }}</td>
			<td>{{ $p->percel_no }}</td>
			<td>{{ $p->sender_name }}</td>
			<td>{{ $p->sender_phone }}</td>
			<td>
				@if($stations[$key][0]=='T' && $p->status=='closed')
				<span class="badge badge-success">{{ $stations[$key] }}</span>
				@elseif($stations[$key][0]=='T' && $p->status=='on transit')
				<span class="badge badge-primary">{{ $stations[$key] }}</span>
				@elseif($stations[$key][0]=='F' && $p->status=='closed')
				<span class="badge badge-success">{{ $stations[$key] }}</span>
				@else
				<span class="badge badge-info">{{ $stations[$key] }}</span>
				@endif
			</td>
			<td>{{ $p->receiver_name }}</td>
			<td>{{ $p->receiver_idnumber }}</td>
			<td>{{ $p->receiver_phone }}</td>
			<td>
				@if($p->status == 'on transit')
				<span class="badge badge-info"><i class="fas fa-car"></i> {{ ucfirst($p->status) }}</span>
				@elseif($p->status=='waiting pickup')
				<span class="badge badge-warning"><i class="fas fa-spinner"></i> {{ ucfirst($p->status) }}</span>
				@else
				<span class="badge badge-success"><i class="fas fa-check-circle"></i> {{ ucfirst($p->status) }}</span>
				@endif
			</td>            
            <td>{{ date("Y/m/d",strtotime($p->created_at)) }}</td>
            <td>KES. <b>{{ $p->cost }}</b></td>
			
		</tr>

		@empty
		<tr>
			<td colspan="10">
				<div class="alert alert-info" role="alert">
				  <i class="fas fa-info-circle fa-2x"></i> &nbsp;This Station has not processed any parcels
				</div>
			</td>
		</tr>
		@endforelse
        <tr>
            
            
            <td></td>
            <td colspan="9" style="text-align: right;"><b>TOTAL</b></td>
            <td>KES. <b>{{ $total }}</b></td>
        </tr>
	</tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>