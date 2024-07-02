<x-guest-layout>
    <x-authentication-card width="sm:max-w-2xl">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                {{-- Nombre --}}
                <div>
                    <x-label for="name" value="{{ __('Nombre') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>
                {{-- Apellido --}}
                <div>
                    <x-label for="last_name" value="{{ __('Apellido') }}" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autocomplete="last_name" />
                </div>
                {{-- Tipo de Documento --}}
                <div>
                    <x-label for="document_type" value="{{ __('Tipo de Documento') }}" />
                    <x-select id="document_type" class="block mt-1 w-full" name="document_type">
                        @foreach (App\Enums\TypeOfDocuments::cases() as $item)
                            <option value="{{ $item->value }}">{{ $item->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                {{-- Número de Documento --}}
                <div>
                    <x-label for="document_number" value="{{ __('Número de Documento') }}" />
                    <x-input id="document_number" class="block mt-1 w-full" type="text" name="document_number" :value="old('document_number')" required autocomplete="document_number" />
                </div>
                {{-- Correo Electrónico --}}
                <div>
                    <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
                {{-- Teléfono --}}
                <div>
                    <x-label for="phone" value="{{ __('Teléfono') }}" />
                    <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                </div>
                {{-- Contraseña --}}
                <div>
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
                {{-- Confirmar Contraseña --}}
                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('admin.users.index') }}">
                    {{ __('Cancelar') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Guardar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
