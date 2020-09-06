@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('product-types.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($productTypes as $productType)
            <tr>
              <td>{{ $productType->id }}</td>
              <td>{{ $productType->name }}</td>
              <td width=150>
                <a href="{{ route('product-types.edit', ['id' => $productType->id]) }}" class="btn btn-outline-primary"><span class="fas fa-pen"></span></a>
                <a href="{{ route('product-types.delete', ['id' => $productType->id]) }}" class="del-conf btn btn-outline-primary"><span class="fas fa-trash"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @include('partials.delete-confirm-modal')
</div>
    
@endsection