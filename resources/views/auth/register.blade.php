<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Create Account</h1>

                    <form action="/register" method="POST">
                        @csrf

                        <!-- Name -->
                        <x-form-field name="name" label="Name" placeholder="John Doe" type="text"/>

                        <!-- Email -->
                        <x-form-field name="email" label="Email" placeholder="JohnDoe@example.com" type="email"/>

                        <!-- Password -->
                        <x-form-field name="password" label="Password" placeholder="••••••••" type="password"/>

                        <!-- Password Confirmation -->
                        <x-form-field name="password_confirmation" label="Confirm Password" placeholder="••••••••" type="password"/>

                        <!-- submit button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Register
                            </button>
                        </div>

                    </form>

                    <div class="divider">OR</div>
                    <p class="text-center text-sm">
                        Already have an account?
                        <a href="/login" class="link link-primary">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
