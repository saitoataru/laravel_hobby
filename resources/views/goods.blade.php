<x-app-layout>
    <!--ヘッダー[START]-->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <div class="flex space-x-4">
            <div>
                <form action="{{ route('book_index') }}" method="GET" class="w-full max-w-lg">
                    <x-button class="bg-gray-100 text-gray-900">{{ __('Dashboard') }}</x-button>
                </form>
            </div>
            <div>
                <form action="{{ route('good') }}" method="GET" class="w-full max-w-lg">
                    <x-button class="bg-gray-100 text-gray-900">{{ __('商品一覧') }}</x-button>
                </form>
            </div>
            <div>
                <form action="{{ route('comment') }}" method="GET" class="w-full max-w-lg">
                    <x-button class="bg-gray-100 text-gray-900">{{ __('質問一覧') }}</x-button>
                </form>
            </div>
        </div>
        </h2>
    </x-slot>
    <!--ヘッダー[END]-->
    
    <!--compenent部分[start]-->
    <div class="flex flex-wrap">
        @if(count($books)>0)
            @foreach($books as $book)
            <div class="rounded border bg-yellow-500 p-3 w-1/3">
            <x-goods id="{{$book->id}}">
                <x-slot name="time">{{$book->updated_at}}</x-slot>
                <x-slot name="title">{{$book->item_name}}</x-slot>
                <x-slot name="number">{{$book->item_name}}</x-slot>
            </x-goods>
            </div>
            
            @endforeach
        @endif
    </div>
    <!--compenent部分[end]-->
    
    </div>
</x-app-layout>
    