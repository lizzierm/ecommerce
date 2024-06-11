<x-guest-layout>
    
    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
        {{ session('status') }}
    </div>
    @endif

    <section class="flex flex-col md:flex-row h-screen items-center">

        <div class="bg-indigo-600 hidden lg:block w-full md:w-1/2 xl:w-2/3 h-screen">
            <img src="{{asset('/img/imagen2.jpg')}}" alt="" class="w-full h-full object-cover">
        </div>

        <div class="bg-blue-200 w-full md:max-w-md lg:max-w-full md:mx-auto xl:w-1/3 h-screen px-6 lg:px-16 xl:px-12
          flex items-center justify-center">

            <div class="w-full h-100">


                <h1 class="text-black md:text-2xl font-bold leading-tight mt-12 text-center">Inicio de Sesión</h1>


                <form class="mt-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label class="block text-gray-900">{{ __('Correo Electrónico') }}</label>
                        <input type="email" name="email" id="email" placeholder="Introduce tu correo electrónico"
                            class="w-full px-4 py-3 rounded-lg mt-2 border focus:border-blue-500
                            focus:bg-white focus:outline-none text-black" style="background-color: white;" autofocus autocomplete="email" required>
                    </div>

                    <div class="mt-4 relative">
                        <label class="block text-gray-900">{{ __('Contraseña') }}</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="Introduce tu contraseña"
                                minlength="6" class="w-full px-4 py-3 rounded-lg mt-2 border focus:border-blue-500
                                focus:bg-white focus:outline-none text-black" style="background-color: white;" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-4 py-8 flex items-center focus:outline-none" onclick="togglePassword()">
                                <i id="password-toggle-icon" class="far fa-eye text-gray-400"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-blue-700 focus:text-blue-700">
                            {{ __('¿Olvidaste tu contraseña?') }}</a>
                        @endif
                    </div>
                    <button type="submit" class="w-full block bg-indigo-500 hover:bg-indigo-400 focus:bg-indigo-400 text-white font-semibold 
                        px-4 py-3 mt-6">
                        {{ __('Iniciar') }}
                    </button>

                </form>

               <hr class="my-6 border-gray-300 w-full">
                @if (Route::has('register'))
                <p class="mt-8 text-gray-600">{{ __('¿Necesitas una cuenta?') }}
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                        {{ __('Crear nueva cuenta') }}
                    </a>
                </p> 
                @endif


            </div>
        </div>

    </section>
</x-guest-layout>

<script>
    function togglePassword() {
        var passwordInput = document.getElementById('password');
        var passwordToggleIcon = document.getElementById('password-toggle-icon');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggleIcon.classList.remove('far', 'fa-eye');
            passwordToggleIcon.classList.add('far', 'fa-eye-slash');
        } else {
            passwordInput.type = "password";
            passwordToggleIcon.classList.remove('far', 'fa-eye-slash');
            passwordToggleIcon.classList.add('far', 'fa-eye');
        }
    }
</script>
