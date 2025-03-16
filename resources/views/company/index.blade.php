@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Companies</h1>
        @if (auth()->user()->is_admin)
            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add Company</a>
        @endif

        <table id="companies-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" width="100">
                            @endif
                        </td>
                        <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Include jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#companies-table').DataTable();
        });
    </script>
@endsection
