@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Companies</h1>
            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add Company</a>

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
                        <td>{{ $company->comp_name }}</td>
                        <td>{{ $company->comp_email }}</td>
                        <td>
                            @if ($company->comp_logo)
                                <img src="{{ asset('storage/' . $company->comp_logo) }}" width="100">
                            @endif
                        </td>
                        <td>
                            <a href="{{ Str::startsWith($company->comp_website, ['http://', 'https://']) ? $company->comp_website : 'https://' . $company->comp_website }}" target="_blank">
                                {{ $company->comp_website }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye me-1"></i>View</a>
                            @if (auth()->user()->id == $company->created_by || auth()->user()->is_admin)
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-pencil me-1"></i>Edit</a>
                            @endif
                            @if (auth()->user()->is_admin || auth()->user()->id == $company->created_by)
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this company?')">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            @endif
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
            $('#companies-table').DataTable({
                    columns:[
                        {width: "40%"},
                        {width: "20%"},
                        {width: "10%"},
                        {width: "10%"},
                        {width: "20%"},
                    ]

                }
            );
        });
    </script>
@endsection
