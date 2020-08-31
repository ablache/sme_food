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
              {!! Form::open() !!}
                <div class="form-group">
                  <label for="name">Name</label>
                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
                </div>
                <div class="form-group">
                  <label for="in">Address</label>
                  {!! Form::textarea('address', null, ['class' => 'form-control', 'id' => 'in', 'placeholder' => 'Address']) !!}
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