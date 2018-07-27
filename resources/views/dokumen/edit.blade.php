@extends('_main')

@section('title')
    Master Standar
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit Standar</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dokumen.update', $dokumen->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-form-label col-md-3">File</label>
                        <div class="col-md-6">
                            <input type="file" name="file" id="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="deskripsi" class="col-md-3 col-form-label">{{ __('Deskripsi Dokumen') }}</label>

                        <div class="col-md-6">
                            <input id="deskripsi" type="text" class="form-control{{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" name="deskripsi" value="{{ $dokumen->deskripsi }}">

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