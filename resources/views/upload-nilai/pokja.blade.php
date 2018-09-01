@extends('_main')

@section('title')
    @if(Auth::user()->level == 3)
        Penilaian Bab
    @endif

    @if(Auth::user()->level == 4)
        Upload Dokumen
    @endif
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
                <h5 class="card-title">List Pokja</h5>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Pokja</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pokjas as $index => $pokja)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td>{{ $pokja->nama }}</td>
                            <td>
                                @if(Auth::user()->pokja == $pokja->id || Auth::user()->level == 1)
                                    <button type="button" data-id="{{ $pokja->id }}" class="btn btn-info btn-sm btn-view">View</button>
                                @endif
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
            $('.table').DataTable({
                "paging": false
            });
        });

        $(document).on('click', '.btn-view', function(){
            var id = $(this).attr('data-id');
            window.location = '/pokja/' + id + '/standar/upload-nilai';
        });
    </script>
@endsection