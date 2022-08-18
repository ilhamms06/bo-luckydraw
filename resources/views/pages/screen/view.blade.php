@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
      <h4>Detail Screen</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-md">
          <tbody>
            <tr>
                <th>Project</th>
                <td>{{ $model->project->name }}</td>
            </tr> 
            <tr>
                <th>Name</th>
                <td>{{ $model->name }}</td>
            </tr>  
        </tbody>
    </table>
      </div>
    </div>
    
  </div>
@endsection