<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white flex items-center justify-center h-screen">
    <div class="w-full max-w-2xl p-8 space-y-6 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center">Register</h2>
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div class="flex space-x-4">
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" autofocus
                        autocomplete="name"
                        class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email"
                        class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="phone" class="block mb-2 text-sm font-medium">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="off"
                        class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('phone')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Password and Confirm Password in one line -->
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                    <input type="password" id="password" name="password" autocomplete="new-password"
                        class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-1/2">
                    <label for="confirm-password" class="block mb-2 text-sm font-medium">Confirm Password</label>
                    <input type="password" id="confirm-password" name="password_confirmation"
                        autocomplete="new-password"
                        class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <button type="submit"
                class="w-full py-3 mt-4 bg-blue-600 rounded-lg font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Register</button>
            <p class="mt-4 text-sm text-center">Already have an account? <a href="{{ route('login') }}"
                    class="text-blue-400 hover:underline">Login</a></p>
        </form>
    </div>
</body>

</html>
