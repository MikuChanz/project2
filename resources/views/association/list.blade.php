@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $association)
                    <tr>
                        <td>{{ $association->id }}</td>
                        <td>{{ $association->name }}</td>

                        <td>
                            <a
                                href="/associations/update/{{ $association->id }}"
                                class="btn btn-outline-primary btn-sm"
                            >
                                Edit
                            </a>

                            <form
                                action="/associations/delete/{{ $association->id }}"
                                method="post"
                                class="deletion-form d-inline"
                            >
                                @csrf

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p>No records found</p>

    @endif

    <a href="/associations/create" class="btn btn-primary">
        Create new
    </a>

@endsection