@extends('_main')

@section('title')
    <a href="{{ route('standar.pokja') }}"><i class="icon-arrow-left52 mr-2 icon-2x" title="Kembali"></i></a> Master Standar
@endsection

@section('content')

@if (session('pesan'))
    <div class="alert alert-primary border-0 alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        {{ session('pesan') }}
    </div>
@endif

<div id="modal_import" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Standar</h5>
            </div>

            <form action="{{ route('standar.import', $pokja->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" name="file">
                </div>

                <div class="modal-footer">
                    <input type="reset" class="btn bg-danger" value="Cancel" id="btn_close">
                    <button type="submit" class="btn bg-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Standar</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <button class="btn btn-primary btn-sm" id="btn_upload" style="display: none;"><i class="fa fa-upload"></i>&nbsp; Import</button>
                        <a href="{{ route('standar.create', $pokja->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table-detail">
                    <tr>
                        <td><b>POKJA</b></td>
                        <td>:</td>
                        <td>{{ $pokja->nama }}</td>
                    </tr>
                </table>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Standar</td>
                        <td>Deskripsi</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($standars as $index => $standar)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
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

        $(document).on('click', '#btn_upload', function(){
            $('#modal_import').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $(document).on('click', '#btn_close', function(){
            $('#modal_import').modal('hide')
        });
    </script>
@endsection