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
        action="{{ $ids->exists ? '/ids/patch/' . $ids->id : '/ids/put' }}"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="mb-3">
            <label for="id-name" class="form-label">Name</label>

            <input
                type="text"
                id="id-name"
                name="name"
                value="{{ old('name', $ids->name) }}"
                class="form-control @error('name') is-invalid @enderror"
            >

            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-sinner" class="form-label">Sinner</label>

            <select
                id="id-sinner"
                name="sinner_id"
                class="form-select @error('sinner_id') is-invalid @enderror"
            >
                <option value="">Select a sinner</option>

                @foreach ($sinners as $sinner)
                    <option
                        value="{{ $sinner->id }}"
                        @if ($sinner->id == old('sinner_id', $ids->sinner_id ?? false))
                            selected
                        @endif
                    >
                        {{ $sinner->name }}
                    </option>
                @endforeach
            </select>

            @error('sinner_id')
                <p class="invalid-feedback">{{ $errors->first('sinner_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-description" class="form-label">Description</label>

            <textarea
                id="id-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $ids->description) }}</textarea>

            @error('description')
                <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-year" class="form-label">Year</label>

            <input
                type="number"
                max="{{ date('Y') + 1 }}"
                step="1"
                id="id-year"
                name="year"
                value="{{ old('year', $ids->year) }}"
                class="form-control @error('year') is-invalid @enderror"
            >

            @error('year')
                <p class="invalid-feedback">{{ $errors->first('year') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-price" class="form-label">Price</label>

            <input
                type="number"
                min="0.00"
                step="0.01"
                lang="en"
                id="id-price"
                name="price"
                value="{{ old('price', $ids->price) }}"
                class="form-control @error('price') is-invalid @enderror"
            >

            @error('price')
                <p class="invalid-feedback">{{ $errors->first('price') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-image" class="form-label">Image</label>

            @if ($ids->image)
                <img
                    src="{{ asset('images/' . $ids->image) }}"
                    class="img-fluid img-thumbnail d-block mb-2"
                    alt="{{ $ids->name }}"
                >
            @endif

            <input
                type="file"
                accept="image/png, image/jpeg, image/webp"
                id="id-image"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
            >

            @error('image')
                <p class="invalid-feedback">{{ $errors->first('image') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="id-display"
                    name="display"
                    value="1"
                    class="form-check-input @error('display') is-invalid @enderror"
                    @if (old('display', $ids->display)) checked @endif
                >

                <label class="form-check-label" for="id-display">
                    Publish entry
                </label>

                @error('display')
                    <p class="invalid-feedback">{{ $errors->first('display') }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $ids->exists ? 'Update entry' : 'Add entry' }}
        </button>
    </form>

@endsection