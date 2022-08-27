@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Participant</h4>
    </div>
    <div class="card-body">
      <form action="{{ route('participant.store') }}" method="POST">
        @csrf
      <div class="form-group">
        <label for="project_id">Project</label>
        <select class="form-control @error('project_id') is-invalid @enderror" name="project_id" id="project">
            <option value="" disabled selected>-- select project --</option>
            @foreach ($project as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @error('project_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="screen_id">Screen</label>
        <select class="form-control @error('screen_id') is-invalid @enderror" id="screen_id" name="screen_id">
            <option value="">-- select screen --</option>
        </select>
        <span id="result"></span>
        <div id="result_tunggu"></div>
        @error('screen_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="item_id">Item</label>
        <select class="form-control @error('item_id') is-invalid @enderror" id="item_id" name="item_id">
            <option value="">-- select item --</option>
        </select>
        <span id="result1"></span>
        <div id="result_tunggu1"></div>
        @error('item_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="phone">phone</label>
        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="phone" value="{{ old('phone') }}">
        @error('phone')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="branch">branch</label>
        <input type="text" id="branch" name="branch" class="form-control @error('branch') is-invalid @enderror" placeholder="branch" value="{{ old('branch') }}">
        @error('branch')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="province">province</label>
        <input type="text" id="province" name="province" class="form-control @error('province') is-invalid @enderror" placeholder="province" value="{{ old('province') }}">
        @error('province')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="city">city</label>
        <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="city" value="{{ old('city') }}">
        @error('city')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
      </div>
      <button class="btn btn-primary" type="submit">Save</button>
    </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript">
  $("#project").on('change', function () {
        var selectedValue = $(this).val();
        $.ajax({
            url: '/getScreen/' + selectedValue,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {},
            beforeSend: function() {
                $("#result").html("");
                $('#screen_id').remove();
                $("#result_tunggu").html(
                    '<p style="color:green"><blink>Tunggu sebentar</blink></p>');
            },

            success: function(html) {
                $('#screen_id').remove();
                $("#result").html(html);
                $("#result_tunggu").html('');
            }
        });
    });


    $("#screen_id").on('change', function () {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        $.ajax({
            url: '/getItem/' + selectedValue,
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            data: {},
            beforeSend: function() {
                $("#result1").html("");
                $('#item_id').remove();
                $("#result_tunggu1").html(
                    '<p style="color:green"><blink>Tunggu sebentar</blink></p>');
            },

            success: function(html) {
                $('#item_id').remove();
                $("#result1").html(html);
                $("#result_tunggu1").html('');
            }
        });
    })
</script>
@endpush

