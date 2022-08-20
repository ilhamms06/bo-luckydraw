@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Item</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="screen_id">Screen</label>
          <select class="form-control @error('screen_id') is-invalid @enderror" name="screen_id">
              <option value="" disabled selected>-- select screen --</option>
              @foreach ($screen as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
          </select>
          @error('screen_id')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
          @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="total_draw">Total Draw</label>
          <input type="number" id="total_draw" name="total_draw" class="form-control @error('total_draw') is-invalid @enderror" placeholder="Total Draw">
          @error('total_draw')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="limit_per_draw">Limit Per Draw</label>
          <input type="number" id="limit_per_draw" name="limit_per_draw" class="form-control @error('limit_per_draw') is-invalid @enderror" placeholder="Limit per Draw">
          @error('limit_per_draw')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>

        <div class="form-group">
          <label for="image">File</label>
          <img class="img-preview d-block w-100 mb-3 col-sm-5">
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImg()">
          @error('image')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
      <button class="btn btn-primary" type="submit">Save</button>
    </form>

    </div>
</div>


<script>
  function previewImg() {
    const foto = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview') 

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(foto.files[0]);

    oFReader.onload = function(oFREvent){
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>
@endsection
