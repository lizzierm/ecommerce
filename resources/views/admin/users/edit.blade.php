<x-guest-layout>
    <x-authentication-card width="sm:max-w-2xl">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                {{-- Nombres --}}
                <div>
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" required autofocus autocomplete="name" />
                </div>
                {{-- Apellidos --}}
                <div>
                    <x-label for="last_name" value="Apellidos" />
                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="$user->last_name" required autocomplete="last_name" />
                </div>
                {{-- Tipo de documento --}}
                <div>
                    <x-label for="document_type" value="Tipo de documento" />
                    <x-select class="w-full" id="document_type" name="document_type">
                        @foreach (App\Enums\TypeOfDocuments::cases() as $item)
                            <option value="{{$item->value}}" @if($user->document_type == $item->value) selected @endif>{{$item->name}}</option>
                        @endforeach
                    </x-select>
                </div>
                {{-- Documento --}}
                <div>
                    <x-label for="document_number" value="Documento" />
                    <x-input id="document_number" class="block mt-1 w-full" type="text" name="document_number" :value="$user->document_number" required />
                </div>
                {{-- Correo electrónico --}}
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autocomplete="username" />
                </div>
                {{-- Teléfono --}}
                <div>
                    <x-label for="phone" value="Teléfono" />
                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$user->phone" required />
                </div>
                {{-- Roles --}}
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-lg font-semibold mb-4 text-black">Listado de roles</h4>
                        @foreach ($roles as $role)
                            <div>
                                <label class="text-black"> <!-- Aplica el color negro aquí -->
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'checked' : '' }} class="mr-1">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                

            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('admin.users.index') }}">
                    {{ __('Cancel') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
