<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ isset($title) ? $title . ' - Chirper' : 'Chirper' }} </title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans pb-16 lg:pb-0">
    {{-- 1. TOP NAVIGATION (Sticky & Frosted Glass) --}}
    <nav class="navbar bg-base-100/80 backdrop-blur-md border-b border-base-200 px-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto w-full flex justify-between items-center">

            {{-- Brand (Left) --}}
            <div class="flex-none">
                <a href="{{ route('chirps.index') }}" class="flex items-center gap-2 group">
                    <div
                        class="bg-primary text-primary-content rounded-xl p-1.5 transition-transform group-hover:scale-105 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m18 8 4 4-4 4" />
                            <path d="M2 12h8" />
                            <path d="m4 16-2-4 2-4" />
                            <path d="M14 12h8" />
                            <path d="m10 8 4 4-4 4" />
                        </svg>
                    </div>
                    <span
                        class="text-xl font-black tracking-tighter text-base-content hidden sm:block">Micro-connect</span>
                </a>
            </div>

            {{-- Theme Toggle (Center-ish) --}}
            <div class="flex-1 flex justify-end md:justify-center px-4">
                <!-- Front-end logic only: DaisyUI Theme Controller -->
                <!-- Toggles between lofi (light) and dracula (dark) -->
                <label class="swap swap-rotate btn btn-ghost btn-circle btn-sm">
                    <input type="checkbox" class="theme-controller" value="dracula" />
                    <!-- sun icon -->
                    <svg class="swap-off fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                    </svg>
                    <!-- moon icon -->
                    <svg class="swap-on fill-current w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                    </svg>
                </label>
            </div>

            {{-- Account Actions (Right) --}}
            <div class="flex-none flex items-center gap-4">
                @auth
                    <div class="dropdown dropdown-end">
                        <label tabindex="0"
                            class="btn btn-ghost flex items-center gap-3 px-2 hover:bg-base-200 rounded-full md:rounded-lg">
                            <span class="hidden md:block text-sm font-bold opacity-80">{{ auth()->user()->name }}</span>
                            <!-- Assuming you have a user-avatar component, keeping it as is -->
                            <x-user-avatar :user="auth()->user()" size="size-9" />
                        </label>
                        <ul tabindex="0"
                            class="menu menu-sm dropdown-content mt-3 z-1 p-2 shadow-2xl bg-base-100 border border-base-200 rounded-box w-52">
                            <li><a href="{{ route('profile.show', auth()->user()) }}" class="py-3 font-medium">Profile</a>
                            </li>
                            <li><a class="py-3 font-medium">Settings</a></li>
                            <div class="divider my-1 opacity-50"></div>
                            <li>
                                <form method="POST" action="/logout" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left py-3 text-error font-bold">Log
                                        Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost btn-sm font-bold">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm font-bold rounded-full px-6">Sign up</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Toasts / Alerts --}}
    @if (session('success'))
        <div class="toast toast-top toast-center z-100">
            <div class="alert alert-success animate-fade-out shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast toast-top toast-center z-100">
            <div class="alert alert-error animate-fade-out shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- 2. MAIN 3-COLUMN LAYOUT --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-6 flex gap-6 lg:gap-8 relative">

        {{-- LEFT SIDEBAR (Desktop Navigation) --}}
        <aside class="hidden md:flex flex-col w-64 shrink-0 gap-2 sticky top-22 h-[calc(100vh-6rem)]">

            <a href="{{ route('chirps.index') }}"
                class="btn btn-ghost justify-start text-lg font-normal hover:bg-base-200 rounded-full px-6 {{ request()->routeIs('chirps.index') ? 'bg-base-200 font-bold' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="mr-3">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                    <polyline points="9 22 9 12 15 12 15 22" />
                </svg>
                Home
            </a>

            <a href="#"
                class="btn btn-ghost justify-start text-lg font-normal hover:bg-base-200 rounded-full px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mr-3">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                Explore
            </a>

            <a href="#"
                class="btn btn-ghost justify-start text-lg font-normal hover:bg-base-200 rounded-full px-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="mr-3">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
                </svg>
                Notifications
            </a>

            @auth
                <a href="{{ route('profile.show', auth()->user()) }}"
                    class="btn btn-ghost justify-start text-lg font-normal hover:bg-base-200 rounded-full px-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="mr-3">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Profile
                </a>
            @endauth


        </aside>

        {{-- CENTER FEED (Main Content Slot) --}}
        <!-- This is where your page views (index.blade.php, etc) will be injected -->
        <div class="flex-1 min-w-0 max-w-2xl border-x border-base-200 min-h-screen pb-20">
            {{-- Dynamic Header for the feed --}}
            @if (isset($header))
                <div class="sticky top-16 z-40 bg-base-100/90 backdrop-blur-md p-4 border-b border-base-200 hidden md:block">
                    <h2 class="text-xl font-bold">{{ $header }}</h2>
                </div>
            @endif

            <div class="p-4 sm:p-6">
                {{ $slot }}
            </div>
        </div>

        {{-- RIGHT SIDEBAR (Trending / Suggestions) --}}
        <aside class="hidden lg:flex flex-col w-80 shrink-0 gap-6 sticky top-22 h-[calc(100vh-6rem)]">

            {{-- Search Bar --}}
            <div class="relative group">
                <input type="text" placeholder="Search..."
                    class="input input-bordered w-full rounded-full bg-base-200 focus:bg-base-100 pl-12 transition-colors border-none focus:ring-2 focus:ring-primary/50" />
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-4 top-3.5 h-5 w-5 text-base-content/50 group-focus-within:text-primary transition-colors"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            {{-- Who to Follow Widget --}}
            <div class="bg-base-100 rounded-2xl border border-base-200 overflow-hidden shadow-sm">
                <div class="p-4 bg-base-200/50 border-b border-base-200">
                    <h3 class="font-extrabold text-lg">Who to follow</h3>
                </div>

                <div class="flex flex-col">

                    {{-- Static Suggestion 1 --}}
                    <div
                        class="p-4 flex items-center justify-between hover:bg-base-200/50 transition-colors cursor-pointer">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div class="avatar">
                                <div
                                    class="w-10 h-10 rounded-full bg-neutral text-neutral-content flex items-center justify-center font-bold">
                                    JD
                                </div>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-bold text-sm truncate hover:underline">John Doe</span>
                                <span class="text-xs opacity-60 truncate">@johndoe</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-neutral rounded-full px-4 ml-2">Follow</button>
                    </div>

                    {{-- Static Suggestion 2 --}}
                    <div
                        class="p-4 flex items-center justify-between hover:bg-base-200/50 transition-colors cursor-pointer">
                        <div class="flex items-center gap-3 overflow-hidden">
                            <div class="avatar">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary text-primary-content flex items-center justify-center font-bold">
                                    SJ
                                </div>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-bold text-sm truncate hover:underline">Sarah Jenkins</span>
                                <span class="text-xs opacity-60 truncate">@sarahcodes</span>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-neutral rounded-full px-4 ml-2">Follow</button>
                    </div>


                </div>
                <button class="btn btn-ghost btn-sm w-full text-primary rounded-none h-12 hover:bg-base-200/50">Show
                    more</button>
            </div>

            {{-- Footer Links --}}
            <div class="px-4 text-xs opacity-60 flex flex-wrap gap-x-3 gap-y-1">
                <a href="#" class="hover:underline">Terms of Service</a>
                <a href="#" class="hover:underline">Privacy Policy</a>
                <a href="#" class="hover:underline">Cookie Policy</a>
                <span>© 2026 Micro-connect</span>
            </div>
        </aside>

    </main>

    {{-- 3. MOBILE BOTTOM NAVIGATION (Hidden on Desktop) --}}
    <div class="btm-nav md:hidden z-50 border-t border-base-200 bg-base-100/90 backdrop-blur-lg pb-safe">
        <a href="#" class="text-base-content active">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
            <span class="btm-nav-label text-[10px] font-medium mt-1">Home</span>
        </a>

        <a href="#" class="text-base-content/60 hover:text-base-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <path d="m21 21-4.3-4.3" />
            </svg>
            <span class="btm-nav-label text-[10px] font-medium mt-1">Search</span>
        </a>

        <a href="#" class="text-base-content/60 hover:text-base-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
            </svg>
            <span class="btm-nav-label text-[10px] font-medium mt-1">Activity</span>
        </a>

        <a href="#" class="text-base-content/60 hover:text-base-content">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                <circle cx="12" cy="7" r="4" />
            </svg>
            <span class="btm-nav-label text-[10px] font-medium mt-1">Profile</span>
        </a>
    </div>

    {{-- MOBILE FAB (Floating Action Button) - Hidden on Desktop --}}
    <button
        class="md:hidden fixed bottom-20 right-4 btn btn-primary btn-circle shadow-xl shadow-primary/40 z-40 h-14 w-14">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
    </button>
</body>

</html>
