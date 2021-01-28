<div>
    <h1 class="ml-6 text-2xl font-bold">{{ __('auth.login-btn') }}</h1>
    <div class="w-full px-6 py-8 mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">
                    {{ __('Whoops! Something went wrong.') }}
                </div>

                <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input label="{{ __('auth.email') }}" id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input label="{{ __('auth.password') }}" name="password" type="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('auth.remember-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('auth.forgot-password') }}
                    </a>
                @endif

                <button type="submit" class="ml-3 btn-primary">
                    {{ __('auth.login-btn') }}
                </button>
            </div>
        </form>
    </div>
</div>