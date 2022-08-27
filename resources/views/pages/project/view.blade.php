@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
      <h4>Detail Project</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-md">
          <tbody>
            <tr>
                <th>name</th>
                <td>{{ $model->name }}</td>
            </tr> 
            <tr>
                <th>Image</th>
                <td><img src="{{  asset('background/' . $model->background)}}"></td>
            </tr>  
        </tbody>
    </table>
      </div>
    </div>
    
  </div>
@endsection