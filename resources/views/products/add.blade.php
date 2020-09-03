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
              {!! Form::open(['enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                  <label for="name">Name</label>
                  {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) !!}
                </div>
                <div class="form-group">
                  <label for="type">Product Type</label>
                  {!! Form::select('type_id', $types->pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'type', 'placeholder' => 'Select']) !!}
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price in MVR']) !!}
                </div>
                <div class="form-group">
                  <label for="file">Image</label>
                  {!! Form::file('file', ['class' => 'form-control', 'id' => 'file']) !!}
                </div>
                <div class="form-group">
                  <label for="preferences">Product Preferences</label>
                  <div class="row">
                    <div class="col-sm-12">
                      @foreach ($preferences as $p)
                      <div class="custom-control custom-radio custom-control-inline">
                        {!! Form::checkbox('preferences[' . $p->id . ']', true, null, ['class' => 'form-check-input']) !!}
                        <label for="">{{ $p->name }}</label>
                      </div>
                      @endforeach
                    </div>
                  </div>
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