@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
    </div>
    <div class="card-body">
      {!! Form::open(['class' => 'form-inline']) !!}
        <label for="" class="col-sm-1">Start</label>
        {!! Form::date('start', null, ['class' => 'form-control col-sm-4']) !!}
        <label for="" class="col-sm-1">End</label>
        {!! Form::date('end', null, ['class' => 'form-control col-sm-4']) !!}
        {!! Form::submit('Download', ['class' => 'btn btn-outline-primary col-sm-2']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
    
@endsection