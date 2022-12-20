<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Ar galėtumėte prieš tęsdami patvirtinti savo el. pašto adresą spustelėdami nuorodą, kurią ką tik išsiuntėme jums el. paštu? Jei negavote el. laiško, mielai atsiųsime kitą.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div style="padding-top:5px;" class="mb-2 font-medium text-sm text-green-600">
                {{ __('Nauja patvirtinimo nuoroda buvo išsiųsta el. pašto adresu, kurį nurodėte profilio nustatymuose.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-jet-button type="submit">
                        {{ __('Persiųsti patvirtinimo laišką') }}
                    </x-jet-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('profile.show') }}"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                    style="margin-left:20px;"
                >
                    {{ __('Readaguoti profilį') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button  style="margin-left:20px;" type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 ml-2">
                        {{ __('Atsijungti') }}
                    </button>
                </form>
            </div>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>
