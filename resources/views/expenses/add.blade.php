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
                  <label for="description">Description</label>
                  {!! Form::text('description', null, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description']) !!}
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'price', 'placeholder' => 'Price in MVR']) !!}
                </div>
                <div class="form-group">
                  <label for="supplier">Supplier</label>
                  {!! Form::select('supplier_id', $suppliers->pluck('name', 'id')->toArray(), null, ['class' => 'form-control', 'id' => 'suppliers', 'placeholder' => 'Select Supplier']) !!}
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