@extends('layout.app')
@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>
    <form action="{{ route('book.index') }}" method="GET" class="mb-4 flex items-center space-x-2">
        <input type="text" placeholder="Serch by title" class="input h-10" name="title" value="{{ request('title') }}">
        <input type="hidden" name="filter" value="{{ request('filter') }}">
        <button class="bg-green-500 text-white font-bold py-2 px-4 rounded h-10">Serch</button>
        <a href="{{ route('book.index') }}" class="bg-red-500 h-10 text-white font-bold py-2 px-4 rounded">Clear</a>
    </form>
    <div class="filter-container mb-4">
        @php
            $filters = [
                '' => 'Latest',
                'popular_last_month' => 'Popular Last Month',
                'popular_last_6months' => 'Popular Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Last Month',
                'highest_rated_6months' => 'Highest Rated Last 6 Months',
            ];
        @endphp
        @foreach ($filters as $key => $label)
            <a href="{{ route('book.index', array_merge(request()->query(), ['filter' => $key])) }}"
                class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('book.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
                                <x-star-rating :rating="$book->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count ?? 0 }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('book.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>
@endsection
