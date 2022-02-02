@extends('layouts.masterlayout')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stepform.css') }}">
@endsection
@section('content')
	<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-md-12 text-center p-0 mb-0">
            <div class="card px-0 pt-1 pb-0 mb-1">
                <h2><strong>Parcel Processing</strong></h2>
                {{-- <p>Fill all form field to go to next step</p> --}}
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Parcel</strong></li>
                                <li id="personal"><strong>Sender</strong></li>
                                <li id="payment"><strong>Recepient</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Percel Details</h2>
                                    <div class="form-row"> 
                                    <div class="col form-group">
									    <label for="exampleFormControlSelect1">Parcel Type</label>
									    <select class="form-control" id="type">
									      <option value="">Select Type ...</option>
									      <option value="Envelope">Envelope</option>
									      <option value="Box">Box(es)</option>
									      <option value="Rods">Rods</option>
									      <option value="Fragile">Fragile(s)</option>
									    </select>
									 </div>
									 <div class="col form-group">
									    <label for="exampleFormControlSelect1">Destination</label>
									    <select class="form-control" id="destination_station_id" name="destination_station_id">
									    	<option value="">Select Destination</option>
									    	@forelse($stations as $s)
									    	@if($s->id!=Auth::user()->id)
									    	<option value="{{ $s->id }}"> {{ $s->station_name }}</option>
									    	@endif
									    	@empty
									    	<option value="">No Stations Available</option>
									    	@endforelse
									   
									    </select>
									 </div>
									</div>
									 <div class="form-row">
									 	<div class="col">
									 		<label>Quantity</label>
									 		<input type="text" name="weight" class="form-control" id="quantity" placeholder="quantity">
									 	</div>
									 	
									 	<div class="col form-group">
									 		<label>Payemnt Mode</label>
									 		<select name="payment_mode" id="payment_mode" class="form-control">

									 			<option value="">Select mode of payment ...</option>
									 			<option value="Cash">Cash</option>
									 		</select>
									 	</div>
									 	<div class="col">
									 		<label>Total Cost (KES)</label>
									 		<input id="cost" type="text" name="cost" class="form-control" placeholder="KES">
									 	</div>
									 </div>
                                </div> 
                                <input type="button" name="next" class="next action-button btn btn-primary" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Sender Details</h2> 
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Sender Name</label>
                                    		<input id="sender_name" type="text" name="sender_name" class="form-control" placeholder="sender name">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Sender Phone</label>
                                    		<input type="text" name="sender_phone" class="form-control" id="sender_phone" placeholder="sender phone number">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Sender ID Number (optional)</label>
                                    		<input id="sender_idnumber" type="text" name="sender_idnumber" class="form-control" placeholder="sender id number">
                                    	</div>
                                    </div>
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Recipient Details</h2>
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Recipient Name</label>
                                    		<input id="recipient_name" type="text" name="recipient_name" class="form-control" placeholder="recipient name">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Recipient Phone</label>
                                    		<input id="recipient_phone" type="text" name="recipient_phone" class="form-control" placeholder="recipient phone number">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                    	<div class="col">
                                    		<label>Recipient ID Number (optional)</label>
                                    		<input id="recipient_idnumber" type="text" name="recipient_idnumber" class="form-control" placeholder="recipient id number">
                                    	</div>
                                    </div>
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="make_payment" class="next action-button" value="Confirm" id="savedata"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card justify-content-center">
                                    <h2 class="fs-title text-center res"></h2> <br><br>
                                    <div class="row justify-content-center">
                                        <center><div class="col-3 info"></div></center>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <center><h5 class="mes"></h5></center>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" style="display:none;" id="prev" /> 
                            </fieldset>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$("#savedata").click(function(){
			if(confirm("Do you want to submit the details now ?")){
				var type = $("#type").val();
				var destination_station_id = $("#destination_station_id").val();
				var quantity = $("#quantity").val();
				var payment_mode = $("#payment_mode").val();
				var sender_name = $("#sender_name").val();
				var sender_phone = $("#sender_phone").val();
				var sender_idnumber = $("#sender_idnumber").val();
				var recipient_name = $("#recipient_name").val();
				var recipient_phone = $("#recipient_phone").val();
				var cost = $("#cost").val();
				var recipient_idnumber = $("#recipient_idnumber").val();
				var _token = $("input[name='_token']").val();
				var request = $.ajax({
					method:"POST",
					url:"{{ route('newparcel') }}",
					data: {type:type,destination_station_id:destination_station_id,quantity:quantity,payment_mode:payment_mode,sender_name:sender_name,sender_phone:sender_phone,sender_idnumber:sender_idnumber,recipient_name:recipient_name,recipient_phone:recipient_phone,recipient_idnumber:recipient_idnumber,_token:_token,cost:cost},
				})
				request.done(function(result){
					alert(result);
				})

			}else{
				$(".res").html("Failed!!").addClass("text-warning");
				$(".info").html("<i class='fas fa-times text-warning fa-3x'></i>");
				$(".mes").html("Information Not submitted, Please confirm and submit").addClass("text-warning");
				$("#prev").show();
			}
		})
	})
</script>
<script type="text/javascript" src="{{ asset('js/stepform.js') }}"></script>

@endsection