@extends('_main')

@section('title')
    @section('title')
        @if(Auth::user()->level == 3)
            <a href="{{ route('upload-nilai.pokja') }}"><i class="icon-arrow-left52 mr-2 icon-2x" title="Kembali"></i></a> Penilaian Bab
        @endif

        @if(Auth::user()->level == 4)
            <a href="{{ route('upload-nilai.pokja') }}"><i class="icon-arrow-left52 mr-2 icon-2x" title="Kembali"></i></a> Upload Dokumen
        @endif
    @endsection
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
                <h5 class="card-title">List Standar</h5>
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
            window.location = '/pokja/standar/' + id + '/upload-nilai';
        });
    </script>
@endsection