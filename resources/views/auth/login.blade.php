<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-6">
        <h2 class="fw-bold mb-2" style="color: #212529; font-size: 1.75rem;">Welcome Back to JobYaari</h2>
        <p class="text-muted" style="font-size: 0.95rem;">Sign in to access your account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold" style="color: #212529;">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('email')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold" style="color: #212529;">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('password')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="d-flex align-items-center">
                <input id="remember_me" type="checkbox" class="form-check-input me-2" name="remember" style="border-radius: 6px;">
                <span class="text-muted small">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            @if (Route::has('password.request'))
                <a class="text-decoration-none small" href="{{ route('password.request') }}" style="color: #0D6EFD;">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn btn-gradient" style="padding: 0.75rem 2rem; font-weight: 600;">
                {{ __('Log in') }}
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <p class="text-muted small mb-0">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: #0D6EFD;">Register</a>
        </p>
    </div>
</x-guest-layout>
