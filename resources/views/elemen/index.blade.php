@extends('_main')

@section('title')
    Master Elemen
@endsection

@section('content')

@if (session('pesan'))
    <div class="alert alert-primary border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        {{ session('pesan') }}
    </div>
@endif

<style>
    .table-detail td {
        padding: 2px 2px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Elemen</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{ route('elemen.create', $id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table-detail">
                    <tr>
                        <td><b>Standar</b></td>
                        <td>:</td>
                        <td>{{ $standar->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Deskripsi</b></td>
                        <td>:</td>
                        <td>{{ $standar->deskripsi }}</td>
                    </tr>
                </table>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Elemen</td>
                        <td>Deskripsi Elemen</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemens as $index => $elemen)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td>{{ $elemen->nama }}</td>
                            <td>{{ $elemen->deskripsi }}</td>
                            <td>
                                <button type="button" data-id="{{ $elemen->id }}" class="btn btn-primary btn-sm btn-edit">Edit</button>
                                <button type="button" data-id="{{ $elemen->id }}" class="btn btn-danger btn-sm btn-delete">Delete</button>
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
            window.location = '/pokja/standar/elemen/' + id + '/edit';
        });

        $(document).on('click', '.btn-delete', function(){
            var id = $(this).attr('data-id');
            var csrf_token = $('meta[name=csrf-token]').attr('content');

            if(confirm('Apa anda yakin?')) {
                $.ajax({
                    url: '/pokja/standar/elemen/' + id,
                    type: 'POST',
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function(data) {
                        alert('Elemen berhasil dihapus');
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