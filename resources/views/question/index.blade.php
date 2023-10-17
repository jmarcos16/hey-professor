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
            Drafts
        </div>

        <div class="space-y-4 dark:text-gray-200">

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', true) as $question)
                        <x-table.tr>
                            <x-table.td>{{ $question->question }}</x-table.td>
                            <x-table.td>

                                <form action="{{ route('question.publish', $question) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <x-primary-button type="submit"> Publish </x-primary-button>
                                </form>

                                <form action="{{ route('question.destroy', $question) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button type="submit"> Delete </x-primary-button>
                                </form>

                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>

        </div>

        <hr class="my-4 border-gray-400 border-dashed dark:border-gray-700">

        <div class="mb-2 text-xl font-bold uppercase dark:text-gray-100">
            My Questions
        </div>

        <div class="space-y-4 dark:text-gray-200">

            <x-table>
                <x-table.thead>
                    <tr>
                        <x-table.th>Question</x-table.th>
                        <x-table.th>Actions</x-table.th>
                    </tr>
                </x-table.thead>
                <tbody>
                    @foreach ($questions->where('draft', false) as $question)
                        <x-table.tr>
                            <x-table.td>{{ $question->question }}</x-table.td>
                            <x-table.td>Delete</x-table.td>
                        </x-table.tr>
                    @endforeach
                </tbody>
            </x-table>

        </div>

    </x-container>

</x-app-layout>
