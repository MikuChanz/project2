@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)

        <table class="table table-sm table-hover table-striped">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sinner</th>
                    <th>Year</th>
                    <th>Price</th>
                    <th>Display</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $ids)
                    <tr>
                        <td>{{ $ids->id }}</td>
                        <td>{{ $ids->name }}</td>
                        <td>{{ $ids->sinner->name }}</td>
                        <td>{{ $ids->year }}</td>

                        <td>
                            &euro; {{ number_format($ids->price, 2, '.', '') }}
                        </td>

                        <td>
                            {!! $ids->display ? '&#x2714;' : '&#x274C;' !!}
                        </td>

                        <td>
                            <a
                                href="/ids/update/{{ $ids->id }}"
                                class="btn btn-outline-primary btn-sm"
                            >
                                Edit
                            </a>

                            <form
                                method="post"
                                action="/ids/delete/{{ $ids->id }}"
                                class="d-inline deletion-form"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-outline-danger btn-sm"
                                >
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

    <a href="/ids/create" class="btn btn-primary">
        Add new
    </a>

@endsection