@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Project</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('project.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $model->name }}">
          </div>
          <div class="form-group">
            <label for="background">File</label>
            @if ($model->background)
            <img src="{{ Storage::url($model->background)}}" class="img-preview d-block w-100 mb-3 col-sm-5">
            @endif
            <input type="file" class="form-control @error('background') is-invalid @enderror" id="background" name="background" onchange="previewImg()" value="{{  $model->background }}">
            @error('background')
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
      const foto = document.querySelector('#foto');
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
