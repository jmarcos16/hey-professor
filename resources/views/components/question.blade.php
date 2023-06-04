@props([
    'question' => '',
])

<div class="flex justify-between items-center rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-200">
    <span>{{ $question->question }}</span>
    <span>

        <x-form action="{{route('question.like', $question)}}" method="post">
            <button type="submit" class="flex items-center space-x-1 text-green-500 ">
                <x-icons.thumbs-up class="w-5 h-5 cursor-pointer hover:text-green-300" />
                <span>{{$question->votes_sum_like ?? 0}}</span>
            </button>
        </x-form>

        <x-form action="{{route('question.unlike', $question)}}" method="post">
            <button type="submit" class="flex items-center space-x-1 text-red-500 ">
                <x-icons.thumbs-down class="w-5 h-5 hover:text-red-300 cursor-pointer" />
                <span>{{$question->votes_sum_unlike ?? 0}}</span>
            </button>
        </x-form>
    </span>
</div>
