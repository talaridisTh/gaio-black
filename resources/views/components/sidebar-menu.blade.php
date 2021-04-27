<aside {{ $attributes->merge(['class' => 'py-12  sm:px-6 lg:px-8 flex border-r-2 dark:border-gray-500']) }}>
    <ul class="text-gray-600 space-y-5 dark:text-white font-semibold  ">
        <li>
            <a href="{{route('users.index')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Χρηστες</a>
        </li>
        <li>
            <a href="{{route('storage.index')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Αποθήκη</a>
        </li>
        <li>
            <a href="{{route('storage.add')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Καταχώρηση ΔΑ προς Αθήνα</a>
        </li>
        <li>
            <a href="{{route('storage.remove')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Καταχώρηση πωλήσεων </a>
        </li>
        <li>
            <a href="{{route('information.index')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Αρχειο ΔΑ προς Αθηνα</a>
        </li>
        <li>
            <a href="{{route('sales.index')}}"
               class="dark:hover:text-gray-400 dark:text-white hover:text-gray-900 text-gray-500 transition ease-in duration-200">Αρχειο πωλήσεων</a>
        </li>
    </ul>


</aside>