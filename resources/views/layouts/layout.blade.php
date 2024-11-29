<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HomeSphere')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-base-200">

    <!-- Navbar -->
    <div class="navbar bg-base-100 shadow-md">
        <!-- Logo and Home Link -->
        <div class="flex-1">
            <a class="btn btn-ghost normal-case text-xl" href="{{ url('/') }}">HomeSphere</a>
        </div>

        <!-- Navbar Menu Items -->
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 items-center space-x-4">
                <!-- Properties Link -->
                <li class="font-semibold"><a href="{{ route('properties.index') }}">My Properties</a></li>
                
                <!-- Management Dropdown -->
                <li class="dropdown relative">
                    <button class="btn m-1 btn-ghost">Management</button>
                    <ul class="dropdown-content menu rounded-box z-[1] w-52 p-2 shadow absolute hidden">
                        <li class="font-semibold"><a href="{{ route('properties.create') }}">Add Property</a></li>
                        <li class="font-semibold"><a href="{{ route('properties.create') }}">Statistics</a></li>
                        <li class="font-semibold"><a href="{{ route('properties.create') }}">Settings</a></li>
                    </ul>
                </li>

                <!-- Authentication Links (Login/Logout) -->
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-ghost font-semibold">Logout</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="font-semibold"><a href="{{ route('login') }}">Login</a></li>
                @endguest

                <!-- Theme Toggle -->
                <li>
                    <label>
                        <input type="checkbox" value="dark" id="themeToggle" class="toggle theme-controller" />
                    </label>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto py-10">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer p-4 bg-base-300 text-base-content text-center">
        <p>&copy; {{ date('Y') }} HomeSphere. All Rights Reserved.</p>
    </footer>

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <script>
        const themeToggle = document.getElementById('themeToggle');

        // Load the preferred theme on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            themeToggle.checked = savedTheme === 'dark';
        });

        // Switch themes and save preference
        themeToggle.addEventListener('change', () => {
            const theme = themeToggle.checked ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        });

        // Toggle dropdown visibility on hover or click
        const dropdownButton = document.querySelector('.dropdown button');
        const dropdownMenu = document.querySelector('.dropdown ul');

        dropdownButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', (e) => {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>
