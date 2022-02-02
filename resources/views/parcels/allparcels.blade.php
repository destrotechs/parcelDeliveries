@extends('layouts.masterlayout')
@section('pagetitle')
Parcels
@endsection
@section('buttons')
{{-- <button type="button" class="btn btn-sm btn-outline-secondary" id="filter">Filter</button> --}}
<a href="{{ route('parcels.pdf') }}" type="button" class="btn btn-sm btn-outline-secondary" id="exportpdf">Export PDF</a>
@endsection
@section('content')
<table class="table table-sm table-bordered table-striped">
	<thead>
		<tr>
			<th>#</th>
			<th>Parcel Number</th>
			<th>Sender Name</th>
			<th>Sender Phone</th>
			<th>Station</th>
			<th>Recipient Name</th>
			<th>Recipient ID</th>
			<th>Recipient Phone</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody><?php $num = 0;?>
		@forelse($parcels as $key=>$p)
		<?php $num++;?>
		<tr>
			<td>{{ $num }}</td>
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
				<span class="badge badge-success"><i class="fas fa-check-circle"></i> {{ ucfirst('delivered') }}</span>
				@endif
			</td>
			<td>
				@if(Auth::user()->id !=$p->source_station_id && $p->status!='closed')
				<a href="#" id="{{ $p->percel_no }}" class="btn btn-primary btn-sm edit" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-edit"></i></a>
				@endif
			</td>
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
	</tbody>
</table>
<div class="d-flex justify-content-center">
    {!! $parcels->links() !!}

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title about" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('actiononparcel') }}" method="POST">
        	@csrf
        	<label>Parcel Number</label>
        	<input type="text" class="form-control" readonly name="parcel_no" id="parcel_no">
        	<input type="hidden" name="id" id="id">
        	<input type="hidden" name="status" id="newstatus">
        	<br>
        	<div class="alert alert-info"><i class="fas fa-info-circle fa-2x"></i>&nbsp;<span id="sender_details"></span></div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary action"></button>
      </div>

  		</form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".edit").click(function(){
			var id = $(this).attr('id');
			$.ajax({
				method:'GET',
				url:"parcelinfo/"+id,
				success:function(data){
					if(data['result'][0]['status']=='on transit'){
						$(".about").html("Alert Recipient To Pickup");
						$(".action").html("Send Alert");
						$("#newstatus").val("waiting pickup");
					}else if(data['result'][0]['status']=='waiting pickup'){
						$(".about").html("Mark Parcel Processing Closed");
						$(".action").html("Finish Processing");
						$("#newstatus").val("closed");
					}
					$("#id").val(data['result'][0]['id']);
					$("#parcel_no").val(data['result'][0]['percel_no']);
					$("#sender_details").html("Percel No : "+data['result'][0]['percel_no'] +"|Sender Name : "+data['result'][0]['sender_name']+"|Recipient Name : "+data['result'][0]['receiver_name']+"|Recipient ID : "+data['result'][0]['receiver_idnumber']+"|Recipient Phone : "+data['result'][0]['receiver_phone']);

				}
			})
		})
	})
</script>
@endsection