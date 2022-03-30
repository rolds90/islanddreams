<x-guest-layout>
    <x-slot name="css">
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
        </x-slot>

        <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-3" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="loginnow">
                    <div class="places">
                        <h1>Login to your account</h1>
                        <hr>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <x-label for="email" :value="__('Email')" />
                        <div class="form-group">
                            <i class="fa fa-user"></i>
                            <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
                        <x-label for="password" :value="__('Password')" />
                        <div class="form-group">
                            <i class="fa fa-key"></i>
                            <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                        </div>
                        <div class="form-check">
                            <x-checkbox id="remember_me" name="remember" />
                        
                            <label class="form-check-label" for="remember_me">
                                {{ __('Remember Me') }}
                            </label>

                            @if (Route::has('password.request'))
                            <a class="text-muted me-3 float-right" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            @endif
                        </div>
                        <x-button class="btn btn-primary btn-block">
                            {{ __('Log in') }}
                        </x-button>
                    </form>
                </div>
            </form>
        </div>
    </x-auth-card>

    <x-slot name="script">
    </x-slot>
</x-guest-layout>
