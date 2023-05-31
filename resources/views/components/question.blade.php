@props([
    'question' => '',
])

<div class="flex justify-between items-center rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-200">
    <span>{{ $question->question }}</span>
    <span>

        <x-form action="{{route('question.vote', $question)}}" method="post">
            <button type="submit" class="flex items-center space-x-1 text-green-500 ">
                <x-icons.thumbs-up class="w-5 h-5 cursor-pointer hover:text-green-300" />
                <span>{{$question->likes}}</span>
            </button>
        </x-form>


        <a href="#" class="flex items-center space-x-1 text-red-500 ">
            <x-icons.thumbs-down class="w-5 h-5 hover:text-red-300 cursor-pointer" />
            <span>{{$question->unlikes}}</span>
        </a>
    </span>
</div>
