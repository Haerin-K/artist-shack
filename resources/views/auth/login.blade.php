@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-purple-50">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">🎁 The Artist Shack</h1>
            <p class="text-gray-600 mt-2">Welcome Back!</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="input-field @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" name="password" required class="input-field @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full btn-primary py-3 font-semibold">
                Sign In
            </button>
        </form>

        <p class="text-center text-gray-600 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-700 font-semibold">Sign up</a>
        </p>
    </div>
</div>
@endsection