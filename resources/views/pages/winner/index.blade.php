@extends('layouts.main')

@section('content')
      <div class="section-header">
        {{-- <h1>{{$title}}</h1> --}}
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
                <a href="{{ route('project.create') }}" class="btn btn-success"> <i class="fas fa-plus"></i> Tambah Kategori</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-md" id="dataTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Unique Field</th>
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
          ajax: "{{ route('project.index') }}",
          columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {data: 'name', name: 'name'},
            {data: 'unique_field', name: 'unique_field'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
        
    });
  </script>
@endpush
