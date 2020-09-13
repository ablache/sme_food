@extends('layouts.main')

@section('content')

<div class="fade-in">
  @include('partials.errors')
  @include('partials.success')
  <div class="card">
    <div class="card-header">
      <strong>{{ $title }}</strong>
      <div class="card-header-actions">
        <a href="{{ route('suppliers.add') }}"><i class="fas fa-plus"></i></a>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-lg">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Controls</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($suppliers as $supplier)
            <tr>
              <td>{{ $supplier->id }}</td>
              <td>{{ $supplier->name }}</td>
              <td>{{ $supplier->contact }}</td>
              <td>{{ $supplier->address }}</td>
              <td width=150>
                <a href="{{ route('suppliers.edit', ['id' => $supplier->id]) }}" class="btn btn-outline-primary"><span class="fas fa-pen"></span></a>
                <a href="{{ route('suppliers.delete', ['id' => $supplier->id]) }}" class="del-conf btn btn-outline-primary"><span class="fas fa-trash"></span></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $suppliers->links() }}
    </div>
  </div>
  @include('partials.delete-confirm-modal')
</div>
    
@endsection