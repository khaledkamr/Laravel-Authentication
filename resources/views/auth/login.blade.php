<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center h-screen flex-col">
    @session('success')
        <div class="bg-green-600 bg-opacity-20 border border-green-500 text-green-200 px-4 py-3 rounded-md mx-6 mt-6 mb-6 flex items-center space-x-2">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endsession
  <div class="w-full max-w-md p-8 space-y-6 bg-gray-800 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center">Login</h2>
    @session('error')
        <div class="bg-red-600 bg-opacity-20 border border-red-500 text-red-200 px-4 py-3 rounded-md mx-6 mt-6 mb-6 flex items-center space-x-2">
            <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m7.07-10.93a10 10 0 11-14.14 14.14 10 10 0 0114.14-14.14z"/>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endsession
    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
      <div>
        <label for="email" class="block mb-2 text-sm font-medium">Email</label>
        <input type="email" id="email" name="email" class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('email')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <label for="password" class="block mb-2 text-sm font-medium">Password</label>
        <input type="password" id="password" name="password" class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('password')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
        @enderror
      </div>
      <p class="mt-4 text-sm text-center">Forgot your password? <a href="{{route("forgot.password")}}" class="text-blue-400 hover:underline">reset now</a></p>
      <button type="submit" class="w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Login</button>
      <p class="mt-4 text-sm text-center">Don’t have an account? <a href="{{route("register")}}" class="text-blue-400 hover:underline">Register</a></p>
    </form>
  </div>
</body>
</html>