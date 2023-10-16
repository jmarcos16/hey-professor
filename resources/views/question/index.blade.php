<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('My Questions') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form action="{{ route('question.store') }}" method="POST">

            <x-textarea name="question" label="Question" />

            <x-primary-button type="submit"> Ask </x-primary-button>

            <x-secondary-button type="reset"> Cancel </x-secondary-button>

        </x-form>

        <hr class="my-4 border-gray-400 border-dashed dark:border-gray-700">

        {{-- Listagem de perguntas --}}

        <div class="mb-2 text-xl font-bold uppercase dark:text-gray-100">
            My Questions
        </div>

        <div class="space-y-4 dark:text-gray-200">

            @foreach ($questions as $item)
                <x-question :question="$item" />
            @endforeach

        </div>

    </x-container>

</x-app-layout>
