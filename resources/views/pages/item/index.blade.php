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
                <a href="{{ route('item.create') }}" class="btn btn-success"> <i class="fas fa-plus"></i> Create Item</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-md" id="dataTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Screen</th>
                      <th>Name</th>
                      <th>Total Draw</th>
                      <th>Limit per Draw</th>
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
          ajax: "{{ route('item.index') }}",
          columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {data: 'screen_id', name: 'screen_id'},
            {data: 'name', name: 'name'},
            {data: 'total_draw', name: 'total_draw'},
            {data: 'limit_per_draw', name: 'limit_per_draw'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>
@endpush
