@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            Please resolve the appearing errors!
        </div>
    @endif

    <form
        method="post"
        action="{{ $sinners->exists ? '/sinners/patch/' . $sinners->id : '/sinners/put' }}"
    >
        @csrf

        <div class="mb-3">
            <label for="sinner-name" class="form-label">
                Sinners name
            </label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="sinner-name"
                name="name"
                value="{{ old('name', $sinners->name) }}"
            >

            @error('name')
                <p class="invalid-feedback">
                    {{ $errors->first('name') }}
                </p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $sinners->exists ? 'Update sinner' : 'Add sinner' }}
        </button>
    </form>

@endsection