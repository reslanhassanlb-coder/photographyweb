<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('assets/javascripts/main.js') }}" defer></script>
    <script src="{{ asset('js/visitor-tracker.js') }}"></script>
    <script src="{{ asset('js/social_login.js') }}"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8" style="text-align: center;">

    {{-- Logo --}}
    <div class="flex justify-center mb-6">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/images/favicon.ico') }}" alt="Website Logo" class="h-16">
        </a>
    </div>

    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Login to Your Account</h2>

    {{-- Display validation errors --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email" required
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" value="{{ old('email') }}">
        <input type="password" name="password" placeholder="Password" required
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button type="submit"
                class="bg-blue-500 text-white w-full p-3 rounded-lg hover:bg-blue-600 transition font-semibold">
            Login
        </button>
    </form>

    {{-- Register link --}}
    <p class="text-center text-gray-500 mt-4">
        Don't have an account?
        <a href="{{ route('register') }}" class="text-green-500 hover:underline font-medium">Register</a>
    </p>
    <button onclick="startSocialLogin('google')" style="margin:5px; padding:10px 20px; background:#db4437; color:#fff; border:none; border-radius:5px; cursor:pointer;">Continue with Google</button>
    <button onclick="startSocialLogin('facebook')" style="margin:5px; padding:10px 20px; background:#4267B2; color:#fff; border:none; border-radius:5px; cursor:pointer;">Continue with Facebook</button>

    {{-- Back to Home link --}}
    <p class="text-center text-gray-400 mt-6">
        <a href="{{ url('/') }}" class="hover:underline">Back to Home</a>
    </p>

</div>
</body>
</html>
