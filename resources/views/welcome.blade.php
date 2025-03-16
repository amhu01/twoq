@extends('layouts.app')
@auth
    <script>
        window.location.href = "{{ route('home') }}";
    </script>
@else
    @section('content')
        <div class="container text-center mt-5">
            <h1>Welcome to Company Management</h1>
            <p>Manage your companies efficiently with our system.</p>

            <div class="mt-4">
                @auth
                    <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </div>
        </div>
    @endsection
@endauth
