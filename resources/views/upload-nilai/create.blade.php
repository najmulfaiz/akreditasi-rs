@extends('_main')

@section('title')
    Master Elemen
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Tambah Elemen</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('elemen.store', $id) }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">{{ __('Nama Elemen') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}"  autofocus>

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">{{ __('Deskripsi Elemen') }}</label>

                        <div class="col-md-6">
                            <textarea name="deskripsi" id="deskripsi" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>

                            @if ($errors->has('deskripsi'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('deskripsi') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-3">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Simpan') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection