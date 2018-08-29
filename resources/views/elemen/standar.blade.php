@extends('_main')

@section('title')
    <a href="{{ route('elemen.pokja') }}"><i class="icon-arrow-left52 mr-2 icon-2x" title="Kembali"></i></a> Master Elemen
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

<div id="modal_import" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Standar</h5>
            </div>

            <form action="{{ route('elemen.import') }}" method="post" enctype="multipart/form-data">
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
                <div class="list-icons">
                    <button class="btn btn-primary btn-sm" id="btn_upload" style="display: none;"><i class="fa fa-upload"></i>&nbsp; Import</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table-detail">
                    <tr>
                        <td><b>Pokja</b></td>
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
                        <td>Deskripsi Standar</td>
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
                                <button type="button" data-id="{{ $standar->id }}" class="btn btn-info btn-sm btn-view">View</button>
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

        $(document).on('click', '.btn-view', function(){
            var id = $(this).attr('data-id');
            window.location = '/pokja/standar/' + id + '/elemen';
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