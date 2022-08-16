@extends('layouts.main')

@section('title')
    {{ ucfirst($module) }}
@endsection

@section('content')
      <div class="section-header">
        <h1>{{ ucfirst($module) }}</h1>
      </div>

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('success') }}
        </div>
      </div>
      @elseif (session()->has('error'))
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('error') }}
        </div>
      </div>
      @endif

      <div class="section-body">

        <div class="card">
            <div class="card-header">
              <div class="buttons">
                <a href="{{ route('participant.create') }}" class="btn btn-success"> <i class="fas fa-plus"></i> Create Participant</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-md" id="dataTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Project</th>
                      <th>Screen</th>
                      <th>Item</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Branch</th>
                      <th>Province</th>
                      <th>City</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer text-right">
              
            </div>
          </div>
      </div>
@endsection



@push('js')
<script type="text/javascript">
    $(function () {
        
      var table = $('#dataTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('participant.index') }}",
          columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {data: 'project_id', name: 'project_id'},
            {data: 'screen_id', name: 'screen_id'},
            {data: 'item_id', name: 'item_id'},
            {data: 'code', name: 'code'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'branch', name: 'branch'},
            {data: 'province', name: 'province'},
            {data: 'city', name: 'city'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>
@endpush
