<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Vote for question') }}
        </h2>
    </x-slot>

    <x-container>

        <div class="mb-2 text-xl font-bold uppercase dark:text-gray-100">Lista de perguntas</div>

        <div class="space-y-4 dark:text-gray-200">

            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach

        </div>

    </x-container>

</x-app-layout>
