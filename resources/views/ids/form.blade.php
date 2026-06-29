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
            <label for="id-association" class="form-label">Association</label>

            <select
                id="id-association"
                name="association_id"
                class="form-select @error('association_id') is-invalid @enderror"
            >
                <option value="">Select an association</option>

                @foreach ($associations as $association)
                    <option
                        value="{{ $association->id }}"
                        @if ($association->id == old('association_id', $ids->association_id ?? false))
                            selected
                        @endif
                    >
                        {{ $association->name }}
                    </option>
                @endforeach
            </select>

            @error('association_id')
                <p class="invalid-feedback">{{ $errors->first('association_id') }}</p>
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
            <label for="id-rarity" class="form-label">Rarity</label>

            <select
                id="id-rarity"
                name="rarity"
                class="form-select @error('rarity') is-invalid @enderror"
            >
                <option value="">Select rarity</option>

                <option
                    value="00"
                    @if (old('rarity', $ids->rarity) == '00') selected @endif
                >
                    00
                </option>

                <option
                    value="000"
                    @if (old('rarity', $ids->rarity) == '000') selected @endif
                >
                    000
                </option>
            </select>

            @error('rarity')
                <p class="invalid-feedback">{{ $errors->first('rarity') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-season" class="form-label">Season</label>

            <input
                type="text"
                id="id-season"
                name="season"
                value="{{ old('season', $ids->season) }}"
                class="form-control @error('season') is-invalid @enderror"
            >

            @error('season')
                <p class="invalid-feedback">{{ $errors->first('season') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="id-release-year" class="form-label">Release year</label>

            <input
                type="number"
                max="{{ date('Y') + 1 }}"
                step="1"
                id="id-release-year"
                name="release_year"
                value="{{ old('release_year', $ids->release_year) }}"
                class="form-control @error('release_year') is-invalid @enderror"
            >

            @error('release_year')
                <p class="invalid-feedback">{{ $errors->first('release_year') }}</p>
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