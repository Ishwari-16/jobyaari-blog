<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="fw-bold mb-2" style="color: #212529; font-size: 1.75rem;">Create Your JobYaari Account</h2>
        <p class="text-muted" style="font-size: 0.95rem;">Join and explore career opportunities.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="form-label fw-semibold" style="color: #212529;">Full Name</label>
            <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your full name" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('name')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold" style="color: #212529;">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('email')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label fw-semibold" style="color: #212529;">Password</label>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Create a password" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('password')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-semibold" style="color: #212529;">Confirm Password</label>
            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" style="padding: 0.75rem 1rem; border: 2px solid #e9ecef; border-radius: 10px;">
            @error('password_confirmation')
                <div class="text-danger mt-2 small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            <a class="text-decoration-none small" href="{{ route('login') }}" style="color: #0D6EFD;">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-gradient" style="padding: 0.75rem 2rem; font-weight: 600;">
                {{ __('Register') }}
            </button>
        </div>
    </form>

    <div class="text-center mt-4">
        <p class="text-muted small mb-0">
            Already have an account?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color: #0D6EFD;">Login</a>
        </p>
    </div>
</x-guest-layout>
