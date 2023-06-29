@extends('layouts.app')

@section('content')
<div class="card w-50 mx-auto">
  <img src="{{ asset('storage/images/' . $user->photo) }}" alt="{{ $user->name }}">

  <div class="card-body">
    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    
      <div class="input-group mb-2">
        <input type="file" name="photo" class="form-control" aria-label="Choose Photo">
        
        <input type="submit" class="btn btn-outline-secondary" name="btn_upload_photo" value="Update"></input>
      </div>                
    </form>

    <div class="mt-5">
      <p class="lead fw-bold mb-0">{{ $user->name }}</p>
    </div>
  </div>
</div>
@endsection
