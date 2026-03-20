@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="max-w-lg mx-auto px-4 py-12">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Verify your email</h1>

        <p class="text-gray-700 mb-4">
            Thanks for signing up. Before logging in, please verify your email address by clicking the link we sent.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 rounded border border-green-200 bg-green-50 px-3 py-2 text-green-700">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 rounded border border-green-200 bg-green-50 px-3 py-2 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center rounded border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
