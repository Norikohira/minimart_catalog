@extends('layouts.app')

@section('content')
<div class="card w-50 mx-auto">
  <div class="card-header bg-success text-white">
    <h2 class="card-title h4 mb-0">Edit Product Details</h2>
  </div>
  
  <div class="card-body">
    <form action="{{ route('product.update', $product->id) }}" method="POST">
    @csrf
    @method('PATCH')
      <label for="title" class="form-label small">Title</label>
      <input type="text" name="title" value="{{ old('title', $product->title) }}" id="title" class="form-control mb-2" required autofocus>

      <label for="description" class="form-label small">Description</label>
      <textarea name="description" id="description" class="form-control mb-2" cols="30" rows="10" required>{{ old('description', $product->description) }}</textarea>

      <label for="price" class="form-label">Price</label>
        <div class="input-group mb-2">
          <div class="input-group-text">$</div>
          <input type="number" name="price" step="any" value="{{ old('price', $product->price) }}" id="price" class="form-control" required>
        </div>

      <label for="section_id" class="form-label small">Section</label>
      <select name="section_id" id="section_id" class="form-select mb-5">
        <option value="" hidden>Select Section</option>
        @foreach($all_sections as $section)
          @if($product->section_id == $section->id)
            <option value="{{ old('section_id', $product->section_id) }}" selected>{{ old('title', $section->title) }}</option>

          @else
            <option value="{{ $section->id }}">{{ $section->title }}</option>
          @endelse
          @endif
        @endforeach
      </select>

      <a href="{{ route('index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button type="submit" name="btn_update" class="btn btn-success px-5">Update</button>
    </form>
  </div>
</div>
@endsection
