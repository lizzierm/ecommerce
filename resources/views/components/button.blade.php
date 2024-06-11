<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-yellow-400 dark:bg-yellow-200 border border-transparent rounded-full font-bold text-base text-white dark:text-gray-800 font-sans tracking-normal hover:bg-yellow-500 dark:hover:bg-yellow-300 focus:bg-yellow-500 dark:focus:bg-yellow-300 active:bg-yellow-600 dark:active:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    <span>{{ $slot }}</span>
</button>
