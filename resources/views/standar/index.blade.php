@extends('_main')

@section('title')
    Master Standar
@endsection

@section('content')

@if (session('pesan'))
    <div class="alert alert-primary border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        {{ session('pesan') }}
    </div>
@endif

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Standar</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{ route('standar.create', $id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Pokja</td>
                        <td>Nama Standar</td>
                        <td>Deskripsi</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($standars as $index => $standar)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td>{{ $standar->pokja->nama }}</td>
                            <td>{{ $standar->nama }}</td>
                            <td>{{ $standar->deskripsi }}</td>
                            <td>
                                <button type="button" data-id="{{ $standar->id }}" class="btn btn-primary btn-sm btn-edit">Edit</button>
                                <button type="button" data-id="{{ $standar->id }}" class="btn btn-danger btn-sm btn-delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script></script>
    <script>
        $(document).ready(function(){
            $('.table').DataTable();
        });

        $(document).on('click', '.btn-edit', function(){
            var id = $(this).attr('data-id');
            window.location = '/standar/' + id + '/edit';
        });

        $(document).on('click', '.btn-delete', function(){
            var id = $(this).attr('data-id');
            var csrf_token = $('meta[name=csrf-token]').attr('content');

            if(confirm('Apa anda yakin?')) {
                $.ajax({
                    url: '/standar/' + id,
                    type: 'POST',
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function(data) {
                        alert('Standar berhasil dihapus');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Oops! Something wrong!");
                    }
                });
            }
        });
    </script>
@endsection