@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Item</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('item.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="form-group">
          <label for="screen_id">Screen</label>
          <select class="form-control @error('screen_id') is-invalid @enderror" name="screen_id">
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
            <label for="name">name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $model->name }}">
          </div>
          <div class="form-group">
            <label for="total_draw">Total Draw</label>
            <input type="text" id="total_draw" name="total_draw" class="form-control" value="{{ $model->total_draw }}">
          </div>
          <div class="form-group">
            <label for="limit_per_draw">Limit per Draw</label>
            <input type="text" id="limit_per_draw" name="limit_per_draw" class="form-control" value="{{ $model->limit_per_draw }}">
          </div>
          <div class="form-group">
            <label for="image">File</label>
            @if ($model->image)
            <img src="{{ Storage::url($model->image)}}" class="img-preview d-block w-100 mb-3 col-sm-5">
            @endif
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImg()" value="{{  $model->image }}">
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
