@extends('_main')

@section('title')
    Master Users
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Edit User</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}"  autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" >

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-3 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-3 col-form-label">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-md-3 col-form-label">{{ __('Level') }}</label>

                        <div class="col-md-6">
                            <select name="level" id="level" class="form-control{{ $errors->has('level') ? ' is-invalid' : '' }}">
                                <option value=""> -- Select Level -- </option>
                                <option value="1" {{ $user->level == 1 ? 'selected':'' }}>Super Admin</option>
                                <option value="2" {{ $user->level == 2 ? 'selected':'' }}>Ketua Akreditasi</option>
                                <option value="3" {{ $user->level == 3 ? 'selected':'' }}>Ketua Pokja</option>
                                <option value="4" {{ $user->level == 4 ? 'selected':'' }}>Anggota Pokja</option>
                            </select>

                            @if ($errors->has('level'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pokja" class="col-md-3 col-form-label">{{ __('Pokja') }}</label>

                        <div class="col-md-6">
                            <select name="pokja" id="pokja" class="form-control{{ $errors->has('pokja') ? ' is-invalid' : '' }}">
                                <option value=""> -- Select Pokja -- </option>
                                @foreach($pokjas as $pokja)
                                    <option value="{{ $pokja->id }}" {{ $user->pokja == $pokja->id ? 'selected':'' }}>{{ $pokja->nama }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('pokja'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pokja') }}</strong>
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