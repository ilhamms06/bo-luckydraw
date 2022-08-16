@extends('layouts.main')

@section('content')

<div class="card">
    <div class="card-header">
      <h4>Create Screen</h4>
    </div>
    <div class="card-body">
      <div class="form-group">
        {!! form($form) !!}
      </div>
    </div>
</div>
@endsection
