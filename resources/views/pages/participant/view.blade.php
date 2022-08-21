@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
      <h4>Detail Participant</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-md">
          <tbody>
            <tr>
                <th>Project</th>
                <td>{{ data_get($model, 'project.name') }}</td>
            </tr> 
            <tr>
              <th>Screen</th>
              <td>{{ data_get($model, 'screen.name') }}</td>
          </tr>
          <tr>
              <th>Item</th>
              <td>{{ data_get($model, 'item.name') }}</td>
          </tr>
          <tr>
            <th>Code</th>
            <td>{{ data_get($model, 'code')}}</td>
          </tr>
          <tr>
            <th>Name</th>
            <td>{{ data_get($model, 'name') }}</td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ data_get($model, 'email') }}</td>
          </tr>  
          <tr>
            <th>Phone</th>
            <td>{{data_get($model, 'phone') }}</td>
          </tr>  
          <tr>
            <th>Branch</th>
            <td>{{ data_get($model, 'branch') }}</td>
          </tr>  
          <tr>
            <th>Province</th>
            <td>{{ data_get($model, 'province')}}</td>
          </tr>  
          <tr>
            <th>City</th>
            <td>{{ data_get($model, 'city') }}</td>
          </tr>    
        </tbody>
      </table>
      </div>
    </div>
    
  </div>
@endsection