<div>
    <h1 class="ml-6 text-2xl font-bold">{{ __('auth.forgot-password') }}</h1>
    <div class="w-full px-6 py-8 mt-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <a href="{{ route('login') }}" class="text-sm font-bold text-light-blue-400 hover:text-light-blue-500">Zpět na přihlášení</a>
        <div class="my-4 text-sm text-gray-600">
            {{ __('auth.forgot-password-text') }}
        </div>
        
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

        

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input label="{{ __('auth.email') }}" id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-3 btn-primary">
                    {{ __('auth.send') }}
                </button>
            </div>
        </form>
    </div>
</div>

