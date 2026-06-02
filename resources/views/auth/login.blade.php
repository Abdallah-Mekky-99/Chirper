<x-layout>
    <x-slot:title>
        Sign In
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Welcome Back</h1>

                    <form action="/login" method="POST">
                        @csrf

                        <!-- Email -->
                        <x-form-field name='email' label='Email' placeholder='JohnDoe@example.com' type='email' />

                        <!-- Password -->
                        <x-form-field name='password' label='Password' placeholder='••••••••' type='password' />

                        <!-- Remember me -->
                        <div class="form-control mt-4">
                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox" name="remember" class="checkbox">
                                <span class="label-text ml-2">Remember me</span>
                            </label>
                        </div>

                        <!-- submit button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Sign In
                            </button>
                        </div>

                    </form>

                    <div class="divider">OR</div>

                    <!-- Google Button -->
                    <div class="form-control mb-4">
                        <a href="{{ route('google-auth') }}"
                            class="btn btn-outline btn-sm w-full gap-2 border-base-300 hover:bg-base-200 hover:text-base-content hover:border-base-400 font-medium normal-case">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                    fill="#4285F4" />
                                <path
                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                    fill="#34A853" />
                                <path
                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"
                                    fill="#FBBC05" />
                                <path
                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"
                                    fill="#EA4335" />
                            </svg>
                            Continue with Google
                        </a>
                    </div>

                    <p class="text-center text-sm text-base-content/60">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="link link-primary font-semibold">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
