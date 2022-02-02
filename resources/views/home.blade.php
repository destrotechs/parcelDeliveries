@extends('layouts.masterlayout')

@section('content')
<div class="container">
    {{-- <div class="row mt-5"></div> --}}
    <div class="row mt-5 justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="input-group mb-3">                          
                          <input type="text" name="searchkey" class="form-control form-control-lg searchkey" aria-label="Example text with button addon" aria-describedby="button-addon1" placeholder="search by parcel number">
                          <div class="input-group-append">
                            <button class="btn btn-outline-primary btn-lg" type="button" id="button-addon1">Track Parcel</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
       $("#button-addon1").click(function(){
        var searchkey = $(".searchkey").val();
        var _token = $("input[name='_token']").val();
        if(searchkey!=""){
            var request = $.ajax({
                method:'POST',
                url:"{{ route('parcel.search') }}",
                data:{searchkey:searchkey,_token:_token},
            });

            request.done(function(result){
                console.log(result);
                alert(result);
            })
        }
       })
    })
</script>
@endsection
@endsection
