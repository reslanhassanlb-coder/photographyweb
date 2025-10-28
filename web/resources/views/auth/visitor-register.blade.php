<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8">

    {{-- Logo --}}
    <div class="flex justify-center mb-6">
        <a href="{{ url('/') }}">
            <img src="{{ asset('assets/images/favicon.ico') }}" alt="Website Logo" class="h-16">
        </a>
    </div>

    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Create Your Account</h2>

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

    {{-- Registration Form --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}"
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <input type="tel" name="phone" placeholder="Phone Number" required  pattern="^\+?[0-9]{6,15}$" value="{{ old('phone') }}"
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}"
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <input type="password" name="password" placeholder="Password" required
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
               class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        <button type="submit"
                class="bg-green-500 text-white w-full p-3 rounded-lg hover:bg-green-600 transition font-semibold">
            Register
        </button>
    </form>

    {{-- Login link --}}
    <p class="text-center text-gray-500 mt-4">
        Already have an account?
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline font-medium">Login</a>
    </p>

    {{-- Back to Home link --}}
    <p class="text-center text-gray-400 mt-6">
        <a href="{{ url('/') }}" class="hover:underline">Back to Home</a>
    </p>

</div>
</body>
</html>
