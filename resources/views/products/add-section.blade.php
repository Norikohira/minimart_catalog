@extends('layouts.app')

@section('content')
<form action="{{ route('section.store') }}" method="post">
@csrf
  <div class="card w-50 mx-auto">
    <div class="card-header">
      <h2>ADD New Section</h2>
    </div>
                
    <div class="card-body">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" id="title" class="form-control mb-2">

      <a href="{{ route('index') }}" class="btn btn-outline-secondary">Cancel</a>
      <button type="submit" name="btn_add" class="btn btn-info">Add</button>
    </div>
  </div>
</form>

<div class="container w-25 mx-auto mt-2">
  <h2 class="h3 text-muted">Section List</h2>

  <table class="table table-sm align-middle text-center">
    <thead class="table-info">
      <tr>
        <th>#</th>
        <th>Title</th>
        <th></th>
      </tr>
    </thead>
    
    <tbody>
    @forelse($all_sections as $section)
      <tr>
        <td>{{ $section->id }}</td>
        <td>{{ $section->title }}</td>
        <td>
          <form action="{{ route('section.destroy', $section->id) }}" method="post">
          @csrf
          @method('DELETE')
            <button type="submit" value="{{ $section->id }}" name="btn_delete" class="btn btn-outline-danger border-0" title="Delete">
              <i class="fa-solid fa-trash-can"></i>
            </button>
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6">No sections found.</td>
      </tr>
    @endforelse
  </tbody>
</table>
@endsection
