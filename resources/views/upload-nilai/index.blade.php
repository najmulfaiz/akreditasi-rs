@extends('_main')

@section('title')
    Upload & Penilaian
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

<div id="modal_default" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penilaian Elemen</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="form-group row">
                    <label for="elemen" class="col-form-label col-sm-3">Nama Elemen</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="elemen_id" id="elemen_id" class="form-control">
                        <input type="text" name="nama" id="nama" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deskripsi" class="col-form-label col-sm-3">Deskripsi</label>
                    <div class="col-sm-9">
                        <textarea name="deskripsi" id="deskripsi" class="form-control" readonly></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nilai" class="col-form-label col-sm-3">Nilai</label>
                    <div class="col-sm-9">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="nilai" id="nilai1" value="0" class="styled" checked="checked">
                                0
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="nilai" id="nilai2" value="5" class="styled">
                                5
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" name="nilai" id="nilai3" value="10" class="styled">
                                10
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                <button type="button" class="btn bg-primary" id="btn_simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-12">
        @if(Auth::user()->level == 3 || Auth::user()->level == 1)
        <div class="alert alert-info alert-styled-left alert-dismissible">
            <span class="font-weight-semibold">Klik angka untuk mengubah nilai</span>
        </div>
        @endif
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">List Elemen</h5>
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
                        
                        @if(Auth::user()->level == 3 || Auth::user()->level == 1)
                        <td>Nilai</td>
                        @endif

                        @if(Auth::user()->level == 4 || Auth::user()->level == 1)
                        <td>#</td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($elemens as $index => $elemen)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td id="nama_{{ $elemen->id }}">{{ $elemen->nama }}</td>
                            <td id="deskripsi_{{ $elemen->id }}">{{ $elemen->deskripsi }}</td>

                            @if(Auth::user()->level == 3 || Auth::user()->level == 1)
                            <td>
                                <button type="button" class="btn btn-link btn-sm btn-nilai" data-id="{{ $elemen->id }}">
                                    {{ $elemen->nilai == null ? '0' : $elemen->nilai }}
                                </button>
                            </td>
                            @endif

                            @if(Auth::user()->level == '4' || Auth::user()->level == 1)
                            <td>
                                <!-- <button type="button" data-id="{{ $elemen->id }}" class="btn btn-primary btn-sm btn-nilai">Nilai</button> -->
                                <button type="button" data-id="{{ $elemen->id }}" class="btn btn-success btn-sm btn-upload">Upload</button>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.table').DataTable();
            $("input:radio").uniform();
        });

        $(document).on('click', '.btn-upload', function(){
            var id = $(this).attr('data-id');
            window.location = '/dokumen/' + id + '/list';
        });

        $(document).on('click', '.btn-nilai', function(){
            var id = $(this).attr('data-id');
            var nama = $.trim( $('#nama_' + id).html() );
            var deskripsi = $.trim( $('#deskripsi_' + id).html() );

            $('#elemen_id').val(id);
            $('#nama').val(nama);
            $('#deskripsi').val(deskripsi);
            $('#modal_default').modal('show');
        });

        $(document).on('click', '#btn_simpan', function(){
            var csrf_token = $('meta[name=csrf-token]').attr('content');
            var id = $('#elemen_id').val();
            var nilai = $('input[name=nilai]:checked').val();

            $.ajax({
                url: '/pokja/standar/elemen/' + id + '/nilai',
                type: 'POST',
                data: { 
                    '_method': 'PATCH', 
                    '_token': csrf_token, 
                    'nilai': nilai 
                },
                success: function(data) {
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