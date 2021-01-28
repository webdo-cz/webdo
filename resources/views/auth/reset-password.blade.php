<div>
    <h1 class="ml-6 text-2xl font-bold">{{ __('auth.reset-password') }}</h1>
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

        

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input label="{{ __('auth.email') }}" id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input label="{{ __('auth.password') }}" name="password" type="password" required autocomplete="current-password" />
            </div>

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input label="{{ __('auth.email') }}" id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input label="{{ __('auth.password') }}" name="password" type="password" required autocomplete="password" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input label="{{ __('auth.password-confirmation') }}" name="password_confirmation" type="password" required autocomplete="password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-3 btn-primary">
                    {{ __('auth.reset-password') }}
                </button>
            </div>
        </form>
    </div>
</div>
