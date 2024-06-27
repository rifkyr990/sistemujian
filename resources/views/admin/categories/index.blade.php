@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- Content Row -->
        <div class="card">
            <div class="card-header py-3 d-flex">
                <h2 class="m-0 font-weight-bold text-dark">
                    {{ __('Jadwal Ujian') }}
                </h2>
                <div class="ml-auto">
                    <a href="{{ route('admin.categories.create') }}" class="btn bg-success-dashboard">
                        <span class="icon text-black-50">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                        <span class="text">{{ __('Tambah Ujian') }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-category" cellspacing="0" width="100%">
                        <thead class="bg-primary-dashboard text-light">
                            <tr>
                                <th width="10">

                                </th>
                                <th>No</th>
                                <th>Nama Ujian</th>
                                <th>Mata pelajaran</th>
                                <th>Guru pengampu</th>
                                <th>Kelas</th>
                                <th>Kode Ujian</th>
                                <th>Tanggal Ujian</th>
                                <th>Jam mulai</th>
                                <th>Jam selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr data-entry-id="{{ $category->id }}">
                                <td>

                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td> {{ $category->mapel?->nama_mapel }} </td>
                                <td>{{ $category->user?->name }}</td>
                                <td> {{ $category->mapel?->kelas }} </td>
                                <td> {{ $category->kode_ujian }} </td>
                                <td> {{ $category->tanggal_ujian }} </td>
                                <td> {{ $category->jam_mulai }} </td>
                                <td> {{ $category->jam_selesai }} </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-info">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <form onclick="return confirm('are you sure ? ')" class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('Data Empty') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <!-- Content Row -->

</div>
@endsection

@push('script-alt')
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  let deleteButtonTrans = 'delete selected'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.categories.mass_destroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });
      if (ids.length === 0) {
        alert('zero selected')
        return
      }
      if (confirm('are you sure ?')) {
        $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 50,
  });
  $('.datatable-category:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endpush