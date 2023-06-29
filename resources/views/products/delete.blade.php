@extends('layouts.app')

@section('content')
<div class="card w-25 mx-auto border-0">
  <div class="card-header bg-white border-0">
    <h2 class="card-title text-center text-danger h4 mb-0">Delete Product</h2>
  </div>
  
  <div class="card-body">
    <div class="text-center mb-4">
      <i class="fa-solid fa-triangle-exclamation text-warning fs-1 d-block mb-2"></i>
      <p class="fw-bold mb-0">Are you sure you want to delete <span class="fst-italic text-danger">{{ $product->title }}</span>? </p>
    </div>
    
    <div class="row">
      <div class="col">
        <a href=="{{ route('index') }}" class="btn btn-secondary w-100">Cancel</a>
      </div>
      
      <div class="col">
        <form action="{{ route('product.destroy', $product->id) }}" method="post">
        @csrf
        @method('DELETE')
        
          <button type="submit" class="btn btn-outline-danger w-100" name="btn_delete">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection