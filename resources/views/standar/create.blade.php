@extends('_main')

@section('title')
    Master Standar
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Tambah Standar</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('standar.store') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">{{ __('Pokja') }}</label>

                        <div class="col-md-6">
                            <input type="hidden" name="pokja" id="pokja" class="form-control" value="{{ $id }}" readonly>
                            <select name="pokja_name" id="pokja_name" class="form-control{{ $errors->has('pokja') ? ' is-invalid' : '' }}" disabled>
                                <option value=""> -- Pilih Pokja -- </option>
                                @foreach($pokjas as $pokja)
                                    <option value="{{ $pokja->id }}" {{ $pokja->id == $id ? 'selected':'' }}>{{ $pokja->nama }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('pokja'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pokja') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">{{ __('Nama Standar') }}</label>

                        <div class="col-md-6">
                            <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}">

                            @if ($errors->has('nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nama') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nama" class="col-md-3 col-form-label">{{ __('Deskripsi') }}</label>

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