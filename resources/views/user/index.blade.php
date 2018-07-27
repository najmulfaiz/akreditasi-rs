@extends('_main')

@section('title')
    Master Users
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
                <h5 class="card-title">List Users</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Level</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $user)
                        <tr>
                            <td>{{ ($index + 1) }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $levels[$user->level] }}</td>
                            <td>
                                <button type="button" data-id="{{ $user->id }}" class="btn btn-primary btn-sm btn-edit">Edit</button>
                                <button type="button" data-id="{{ $user->id }}" class="btn btn-danger btn-sm btn-delete">Delete</button>
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
            window.location = '{{ route('user.index') }}/' + id + '/edit';
        });

        $(document).on('click', '.btn-delete', function(){
            var id = $(this).attr('data-id');
            var csrf_token = $('meta[name=csrf-token]').attr('content');

            if(confirm('Apa anda yakin?')) {
                $.ajax({
                    url: '{{ route('user.index') }}/' + id,
                    type: 'POST',
                    data: { '_method': 'DELETE', '_token': csrf_token },
                    success: function(data) {
                        alert('User berhasil dihapus');
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