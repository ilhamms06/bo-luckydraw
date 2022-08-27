@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
      <h4>Detail Item</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-md">
          <tbody>
            <tr>
                <th>Screen</th>
                <td>{{ $model->screen->name }}</td>
            </tr> 
            <tr>
              <th>Name</th>
              <td>{{ $model->name }}</td>
          </tr>
          <tr>
              <th>Image</th>
              <td><img src="{{  asset('image/' . $model->image)}}"></td>
          </tr>
          <tr>
            <th>Total Draw</th>
            <td>{{ $model->total_draw }}</td>
        </tr>
        <tr>
          <th>Limit per Draw</th>
          <td>{{ $model->limit_per_draw }}</td>
        </tr>  
        </tbody>
    </table>
      </div>
    </div>
    
  </div>
@endsection