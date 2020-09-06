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
                <div class="form-group">
                  <label for="name">Name</label>
                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
                </div>
                @include('partials.errors')
                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection