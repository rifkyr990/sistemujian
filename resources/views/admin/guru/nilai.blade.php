@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Content Row -->
    @foreach($categories as $category)
    <div class="container">
        <div class="card-header py-3 bg-transparent">
            <h1 class="fw-heading">Daftar Nilai</h1>
            <h4>{{ $category->mapel->nama_mapel }} - Kelas {{$category->mapel->kelas}}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-User" cellspacing="0"
                    width="100%">
                    <thead class="bg-primary-dashboard text-light">
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Judul Ujian</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    @if($categories->isEmpty())
                    <p>Tidak ada data nilai untuk ditampilkan.</p>
                    @else
                        @foreach($category->results as $index => $result)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result->user->nomer_induk }}</td>
                            <td>{{ $result->user->name }}</td>
                            <th>{{ $category->name }}</th>
                            <td>{{ $result->score }}</td>
                        </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
    @endforeach
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
            url: "{{ route('admin.users.mass_destroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });
                if (ids.length === 0) {
                    alert('zero selected')
                    return
                }
                if (confirm('are you sure ?')) {
                    $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function () {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        $.extend(true, $.fn.dataTable.defaults, {
            order: [
                [1, 'asc']
            ],
            pageLength: 50,
        });
        $('.datatable-User:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
    })
</script>
@endpush