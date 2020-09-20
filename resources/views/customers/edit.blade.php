@extends('layouts.main')

@section('content')

<div class="fade-in">
  <div class="row">
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong>{{ $title }}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              {!! Form::model($model) !!}
                {!! Form::hidden('lat', null, ['id' => 'lat']) !!}
                {!! Form::hidden('lng', null, ['id' => 'lng']) !!}
                <div class="form-group">
                  <label for="name">Name</label>
                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
                </div>
                <div class="form-group">
                  <label for="contact">Contact</label>
                  {!! Form::text('contact', null, ['class' => 'form-control', 'id' => 'contact', 'placeholder' => 'Contact']) !!}
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) !!}
                </div>
                @include('partials.errors')
                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="card">
        <div class="card-header">
          <strong>Location</strong>
        </div>
        <div class="card-body" style="height: 504px;">
          <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection

@section('scripts')

<script type="text/javascript">
  var lat;
  var lng;

  $(document).ready(function() {
    lat = $('#lat').val();
    lng = $('#lng').val();

    initMap();
  });
  function initMap() {
    var male = {lat: 4.1753508, lng: 73.5093263};

    var map = new google.maps.Map(
        document.getElementById('map'), {zoom: 14, center: male});
    
    var marker = new google.maps.Marker({
            position: {lat: parseFloat(lat), lng: parseFloat(lng)},
            map: map,
        });
    
    map.addListener('click', function (event) {
        marker.setMap(null);
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map,
        });
        $('#lat').val(event.latLng.lat().toString());
        $('#lng').val(event.latLng.lng().toString());
      
    });
  }
</script>

<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZKgE9_xuf54zKLcUDcqzJKwH0nwXz6RQ"></script>
    
@endsection