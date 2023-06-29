@extends('layouts.app')

@section('content')
  <a href="{{ route('section.index') }}" class="btn btn-outline-info float-end ms-2"><i class="fas fa-plus-circle"></i> Add New Section</a>
  <a href="{{ route('product.create') }}" class="btn btn-success float-end"><i class="fas fa-plus-circle"></i> Add New Product</a>

  <h2 class="h3 text-muted">Product List</h2>

  <table class="table table-hover mt-4">
    <thead class="table-light">
      <tr>
        <th>#</th>
        <th>TITLE</th>  
        <th>DESCRIPTION</th>
        <th>PRICE</th>
        <th>SECTION</th>
        <th style="width: 95px"></th>   <!-- for the action buttons -->
      </tr>
    </thead>
    
    <tbody>
    @forelse($all_products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->title }}</td>
        <td>{{ $product->description }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->section->title }}</td>
        <td>
          <a href="{{ route('product.edit', $product->id) }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-pencil-alt"></i>
          </a>

          <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-danger btn-sm">
            <i class="fas fa-trash"></i>
          </a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6">No products found.</td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
