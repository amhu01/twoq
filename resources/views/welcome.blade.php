@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>Welcome to Company Management</h1>
    <p>Manage your companies efficiently with our system.</p>
    
    <div class="mt-4">
        @auth
            <a href="{{ route('companies.index') }}" class="btn btn-primary">Go to Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        @endauth
    </div>
</div>
@endsection
