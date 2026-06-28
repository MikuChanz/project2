@extends('layout')

@section('content')

    <h1>{{ $title }}</h1>

    @if (count($items) > 0)

        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Vārds</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $sinners)
                    <tr>
                        <td>{{ $sinners->id }}</td>
                        <td>{{ $sinners->name }}</td>
                        <td> <a href="/sinners/update/{{ $sinners->id }}" class="btn btn-outline-primary btn-sm"> Edit </a> 
                            <form
                                action="/sinners/delete/{{ $sinner->id }}" method="post" class="deletion-form d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm"> Delete </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else

        <p>Couldn't find any list</p>

    @endif

    <a href="/sinners/create" class="btn btn-primary">Create new</a>

@endsection