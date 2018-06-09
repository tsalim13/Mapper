@extends('layouts.templateMap')

@section('scriptMap')
<!--************************************ SCRIPT MAP ******************************************-->		
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/map-assets/map-css.css">
<script src="{{URL::to('/')}}/map-assets/map-api-edit.js?v={!!str_random()!!}"></script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrmVnM6kACq75FBLoOUlG-VsW1hzf8n1s&libraries=places&callback=initMap">
    </script>
<!--************************************ SCRIPT MAP ******************************************-->
@endsection

@section('titrePage') Mapper/ Modifier la map @endsection

@section('indices')
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle hvr-icon-down" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Indices
  </button>
  <div class="dropdown-menu">
      &ensp; &diams; &ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Chartreuse-icon.png">Nouveau<br>
      &ensp; &diams; &ensp;<img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/32/Map-Marker-Marker-Outside-Azure-icon.png">Ancien<br><br>
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
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nouveau marker</h4>
      </div>
      <div class="modal-body">
              <b><p style="text-align: center; " id="coordonees"></p></b>
       
        {{ Form::open(['route' => 'edit.store', 'method'=>'post', 'id'=>'formStoreMarker']) }}

        <div class="form-group">
        {!! Form::hidden('lat', null , ['id' => 'lat']) !!}
        {!! Form::hidden('lng', null , ['id' => 'lng']) !!}
        {!! Form::hidden('etat', 0 ) !!}
      </div>

        <div class="form-group">
        {!! Form::label('nom', 'Identifiant : ') !!}
        {!! Form::text('nom', null , ['placeholder' => 'Identifiant' , 'class' => 'form-control', 'id'=>'nomM']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('type', 'Type : ') !!}
        {!! Form::select('type', ['paneau' => 'Paneau', 'plaque' => 'Plaque', 'abrisdebus' => 'Abris de bus'], null, ['placeholder' => 'Veuillez choisir le type' , 'class' => 'form-control', 'id'=>'typeM']) !!}
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
        <button class="hvr-icon-up btn btn-primary" type="submit" value="Submit">Ajouter</button>
		{!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
@endsection


@section('modalSupp')
	@foreach ($markers as $marker)
	     		<!-- Modal supp -->
	<div id="myModalsupp{!! $marker->id!!}" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body">
          <p style="text-align:center;"><img src="{{URL::to('/')}}/images/danger.png"></p>
	      	<p style="text-align:center;" id="markerSupp">Voulez vous vraiment supprimer <b><i>{!! $marker->name!!}</i></b> ?</p> 
	      </div>
	      <div class="modal-footer">           
			  {{ Form::open(['method' => 'DELETE', 'id'=>'formDel', 'route' => ['edit.destroy', $marker->id]]) }}
        <input type="hidden" name="delMark" id="delMark">
        <p style="text-align:center;">
          <button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
          <button type="submit" class="hvr-icon-sink-away btn btn-danger">Supprimer</button>
        </p>
			  {{Form::close()}}
	      </div>
	    </div>
	  </div>
	</div>
	 @endforeach
@endsection

@section('scriptAjax')

 <script type="text/javascript">
  //*********************************Form Supp ***********************************

      $(document).on('submit', '#formDel', function (event) {
          event.preventDefault();
          $this = $(this);

          var idd = document.getElementById("delMark").value;
          var idModal = "#myModalsupp"+idd;
          console.log(idModal);

        $(idModal).modal('hide');  // hide modal

          setNull(idd);

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

  //***********************Fin Form Supp****************************************

  //******************************Form Add*************************************

  $(document).on('submit', '#formStoreMarker', function (event) {
          event.preventDefault();
          $this = $(this);

        $("#myModal").modal('hide');  // hide modal

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
