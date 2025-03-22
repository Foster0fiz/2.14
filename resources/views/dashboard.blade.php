@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Welcome to Your Dashboard</h2>

    <div class="row justify-content-center mt-4">
        <div class="col-md-4 profile-card">
            <h4 class="text-center">Your Profile</h4>
            <p>Name: <strong>{{ auth()->user()->name }}</strong></p>
            <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
            
            <div class="text-center">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                         alt="Avatar" 
                         class="img-fluid rounded-circle mb-3" width="150">
                @else
                    <img src="{{ asset('default-avatar.png') }}" 
                         alt="Default Avatar" 
                         class="img-fluid rounded-circle mb-3" width="150">
                @endif
                
                <p><a href="{{ route('profile.edit') }}" class="btn btn-secondary">Edit Profile</a></p>

                {{-- Logout через POST --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
