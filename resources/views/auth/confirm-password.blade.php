<div>
    <h1 class="ml-6 text-2xl font-bold">{{ __('auth.login-btn') }}</h1>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

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

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mt-4">
            <x-input label="{{ __('auth.password') }}" name="password" type="password" required autocomplete="password" />
        </div>

        <div class="flex justify-end mt-4">
            <button type="submit" class="btn-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</div>
