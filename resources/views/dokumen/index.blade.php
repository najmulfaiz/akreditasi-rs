@extends('_main')

@section('title')
    <a href="{{ route('upload-nilai.index', $elemen->standar_id) }}"><i class="icon-arrow-left52 mr-2 icon-2x" title="Kembali"></i></a> Dokumen
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
        @if(Auth::user()->level == 4 && $elemen->note != '')
            <div class="alert alert-warning alert-styled-left alert-dismissible">
                <span class="font-weight-semibold">Catatan!</span><br />
                {{ $elemen->note }}
            </div>
        @endif
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Dokumen</h5>
                @if(Auth::user()->level == 4)
                <div class="header-elements">
                    <div class="list-icons">
                    <a href="{{ route('dokumen.create', $id) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <table class="table-detail">
                    <tr>
                        <td><b>Elemen</b></td>
                        <td>:</td>
                        <td>{{ $elemen->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>Deskripsi</b></td>
                        <td>:</td>
                        <td>{{ $elemen->deskripsi }}</td>
                    </tr>
                </table>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Deskripsi Dokumen</td>
                        <td>Terakhir Diubah</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dokumens as $index => $dokumen)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td>{{ $dokumen->deskripsi }}</td>
                            <td>{{ $dokumen->updated_at }}</td>
                            <td>
                                <button type="button" data-id="{{ $dokumen->id }}" class="btn btn-info btn-sm btn-view">View</button>
                                @if(Auth::user()->level == 4)
                                <button type="button" data-id="{{ $dokumen->id }}" class="btn btn-primary btn-sm btn-edit">Edit</button>
                                <button type="button" data-id="{{ $dokumen->id }}" class="btn btn-danger btn-sm btn-delete">Delete</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(Auth::user()->level == 3)
        <div class="card">
            <div class="card-body">
                <p class="font-weight-bold">Catatan :</p>
                <input type="hidden" class="form-control" id="elemen_id" name="elemen_id" value="{{ $elemen->id }}">
                <textarea name="note" id="note" class="form-control" rows="5">{{ $elemen->note }}</textarea>
                <button class="btn btn-primary btn-sm mt-2" id="btn_simpan_note">Simpan</button>
            </div>
        </div>
        @endif
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
            window.location = '/dokumen/' + id + '/edit';
        });

        $(document).on('click', '.btn-view', function(){
            var id = $(this).attr('data-id');
            window.open('/dokumen/' + id + '/view', '_blank');
        })

        $(document).on('click', '.btn-delete', function(){
            var id = $(this).attr('data-id');
            var csrf_token = $('meta[name=csrf-token]').attr('content');

            if(confirm('Apa anda yakin?')) {
                $.ajax({
                    url: '/dokumen/' + id + '/delete',
                    type: 'POST',
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function(data) {
                        alert('Dokumen berhasil dihapus');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Oops! Something wrong!");
                    }
                });
            }
        });

        $(document).on('click', '#btn_simpan_note', function(){
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            var note = $.trim( $('#note').val() );
            var elemen_id = $.trim( $('#elemen_id').val() );

            $.ajax({
                url: '/elemen/' + elemen_id + '/note',
                type: 'POST',
                data: { 
                    '_method': 'PATCH', 
                    '_token': csrf_token,
                    'note' : note
                },
                success: function(data) {
                    // console.log(data);
                    alert(data.msg);
                    location.reload();
                },
                error: function(xhr) {
                    alert("Oops! Something wrong!");
                }
            });
        });
    </script>
@endsection