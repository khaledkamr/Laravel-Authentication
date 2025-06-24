<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white mt-20 flex justify-center p-6 flex-col items-center">
    @session('success')
        <div class="bg-green-600 bg-opacity-20 border border-green-500 text-green-200 px-4 py-3 rounded-md mx-6 mt-6 mb-6 flex items-center space-x-2">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endsession
  <div class="max-w-2xl w-full bg-gray-800 rounded-lg shadow-lg overflow-hidden">
    <!-- Profile Header -->
    <div class="p-8 bg-gray-700 flex flex-col sm:flex-row items-center gap-8">
      <img src="{{ asset('imgs/profile.png') }}" alt="Profile Picture" class="w-28 h-28 rounded-full border-4 border-gray-600 shadow-lg object-cover">
      <div class="flex-1 w-full">
        <ul class="space-y-2 mb-6">
          <li>
            <h2 class="text-3xl font-extrabold tracking-tight">{{ auth()->user()->name }}</h2>
          </li>
          <li>
            <span class="font-semibold text-gray-300">Email:</span>
            <span class="text-gray-100">{{ auth()->user()->email }}</span>
          </li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="flex justify-start">
          @csrf
          <button type="submit" class="py-2 px-6 bg-red-600 rounded-lg font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 transition">
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>