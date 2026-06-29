@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            Please correct the errors!
        </div>
    @endif

    <form
        method="post"
        action="{{ $association->exists ? '/associations/patch/' . $association->id : '/associations/put' }}"
    >
        @csrf

        <div class="mb-3">
            <label for="association-name" class="form-label">
                Name
            </label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="association-name"
                name="name"
                value="{{ old('name', $association->name) }}"
            >

            @error('name')
                <p class="invalid-feedback">
                    {{ $errors->first('name') }}
                </p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $association->exists ? 'Update association' : 'Add association' }}
        </button>
    </form>

@endsection