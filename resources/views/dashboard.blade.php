<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form action="{{ route('question.store') }}" method="POST">

            <x-textarea name="question" label="Question" />

            <x-primary-button type="submit"> Ask </x-primary-button>

            <x-secondary-button type="reset"> Cancel </x-secondary-button>

        </x-form>

        <hr class="border-gray-400 dark:border-gray-700 border-dashed my-4">

        {{-- Listagem de perguntas --}}

        <div class="dark:text-gray-100 text-xl mb-2 uppercase font-bold">Lista de perguntas</div>

        <div class="dark:text-gray-200 space-y-4">

            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach

        </div>

    </x-container>

</x-app-layout>
