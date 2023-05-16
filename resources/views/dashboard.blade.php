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

    </x-container>

</x-app-layout>
