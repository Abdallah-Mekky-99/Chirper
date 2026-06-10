<x-layout>
    <x-slot:title>
        Verify Email
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100 shadow-sm border border-base-200">
                <div class="card-body flex flex-col items-center text-center">
                    
                    <!-- Icon Section -->
                    <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>

                    <!-- Heading -->
                    <h1 class="text-2xl font-bold mb-2">Verify Your Email</h1>
                    
                    <!-- Explanation -->
                    <p class="text-sm text-base-content/70 mb-6 leading-relaxed">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                    </p>


                    <!-- Actions -->
                    <div class="flex flex-col gap-3 w-full">
                        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm w-full font-semibold">
                                Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="/logout" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-ghost btn-sm w-full font-semibold">
                                Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout>
