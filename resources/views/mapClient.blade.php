@extends('layouts.templateMap')

@section('scriptMap')
<!--************************************ SCRIPT MAP ******************************************-->		
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/map-assets/map-css.css">
<script src="{{URL::to('/')}}/map-assets/map-api.js?v={!!str_random()!!}"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrmVnM6kACq75FBLoOUlG-VsW1hzf8n1s&libraries=places&callback=initMap">
    </script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<!--************************************ SCRIPT MAP ******************************************-->
@endsection

@section('titrePage') Mapper/ Louer (map) @endsection

@section('indices')
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle hvr-icon-down" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Indices
  </button>
  <div class="dropdown-menu">
      &ensp; &diams; &ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Chartreuse-icon.png">Libre<br>
      &ensp; &diams; &ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Push-Pin-1-Azure-icon.png">Louer<br><br>
      &ensp; &diams; &ensp;Plq : Plaque <br>
      &ensp; &diams; &ensp;Pn : Panneau <br>
      &ensp; &diams; &ensp;Abs : Abris de bus
  </div>
</div>
@endsection

@section('content')
  <!--************************************ MAP ******************************************-->  
    <input id="pac-input" class="controls" type="text" placeholder="Recherchez un endroit">
      <div id="map"></div>
  <!--************************************ MAP ******************************************-->
@endsection

@section('modalAdd')
<!-- ******************************** Modal Louer ******************************* -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="titreModal"></h4>
      </div>
      <div class="modal-body">
              <b><p style="text-align: center; " id="coordonees"></p></b>
       
        {{ Form::open(['route' => 'map-client.store', 'method'=>'post', 'id'=>'formLouer']) }}

      <div class="form-group">
        {!! Form::hidden('idMarker', null , ['id' => 'idMarker']) !!}
      </div>

      <div class="form-group col-md-6">
        <div class="input-group">
        	<span class="input-group-addon">Du:</span>
        	{!! Form::date('dateDebut' ,\Carbon\Carbon::now(), ['class'=>'form-control']);!!}
    	</div>
      </div>

      <div class="form-group col-md-6">
        <div class="input-group">
        	<span class="input-group-addon">Jusqu'au:</span>
        	{!! Form::date('dateFin' ,null, ['class'=>'form-control']);!!}
      	</div>
      </div>  <br><br><br>

      <div class="form-group">
      	<div class="input-group">
      		<span class="input-group-addon">Pour le client:</span>
	     	<select class="js-example-theme-single" name="idClient" style="width: 100%">
	     	  @foreach ($clients as $client)
	  			<option value="{!! $client->id !!}">{!! $client->name !!}</option>
	  		  @endforeach
			</select>
		</div>
	  </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        <button class="hvr-icon-up btn btn-primary" type="submit" value="Submit">Louer</button>
		{!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<!-- ****************************** Fin Modal Louer ***************************** -->

<!-- **************************** Modal deja attribuer ***************************** -->
<div id="ModalDejaAttribuer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align:center;"><img src="{{URL::to('/')}}/images/alert.png"></p><br>
        <b><p style="text-align: center; " id="dejaAttribuer"></p></b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Ok</button>
      </div>
    </div>

  </div>
</div>
<!-- **************************** Modal deja attribuer ***************************** -->
@endsection

@section('scriptAjax')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script type="text/javascript">
   // In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
	    $(".js-example-theme-single").select2({
		  theme: "classic"
		});
	});
	//*************************Form Add ***********************************
	    $(document).on('submit', '#formLouer', function (event) {
	        event.preventDefault();
	        $this = $(this);

	       // var idd = document.getElementById("delMark").value;
	       // var idModal = "#myModalsupp"+idd;
	       // console.log(idModal);

	      $('#myModal').modal('hide');  // hide modal
		
	        //console.log(idd);
	        //setNull(idd);

	        $.ajax({
	            url: $this.attr('action'),
	            type: $this.attr('method'),
	            dataType: 'json',
	            data: $this.serialize()

	        }).done(function (data) {
	            // do whatever u want if the request is ok
	        }).fail(function (data) {
	            // do what ever you want if the request is not ok
	        });
	    });
	//***********************Fin Form Add****************************************
</script>
@endsection
