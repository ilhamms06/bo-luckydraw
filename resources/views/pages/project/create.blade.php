@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Project</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="example: Input name">
          @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
          @enderror
        </div>

        
        <div class="form-group">
          <label class="form-label">Spinner Type</label>
          <div class="row gutters-sm">
            <div class="col-6 col-sm-6">
              <label class="imagecheck mb-4">
                <input name="sprint_type" type="radio" value="{{ asset('gif/spinner-1.gif') }}" class="imagecheck-input">
                <figure class="imagecheck-figure">
                  <img src="{{ asset('gif/spinner-1.gif') }}" alt="}" class="imagecheck-image">
                </figure>
              </label>
            </div>
            <div class="col-6 col-sm-6">
              <label class="imagecheck mb-4">
                <input name="sprint_type" type="radio" value="{{ asset('gif/spinner-2.gif') }}" class="imagecheck-input">
                <figure class="imagecheck-figure">
                  <img src="{{ asset('gif/spinner-2.gif') }}" alt="}" class="imagecheck-image">
                </figure>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="background">File</label>
          <img class="img-preview d-block w-100 mb-3 col-sm-5">
          <input type="file" class="form-control @error('background') is-invalid @enderror" id="background" name="background" onchange="previewImg()">
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
    const foto = document.querySelector('#background');
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
