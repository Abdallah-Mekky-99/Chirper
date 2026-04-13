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
                        <x-form-field name='email' label='Email' placeholder='JohnDoe@example.com' type='email'/>

                        <!-- Password -->
                        <x-form-field name='password' label='Password' placeholder='••••••••' type='password'/>

                        <!-- Remember me -->
                        <div class="form-control mt-4">
                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox"
                                       name="remember"
                                       class="checkbox">
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
                    <p class="text-center text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="link link-primary">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
