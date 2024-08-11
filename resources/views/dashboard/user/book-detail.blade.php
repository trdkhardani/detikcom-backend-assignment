@include('template.header')

@include('template.navbar')

{{-- <h1 class="mb-3 text-center">{{ $title }}</h1> --}}
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">

            <h2 class="mb-3">{{ $book->book_title }}</h2>
            {{-- <p>Author: <a href="$books?author={{ $book->author->username }}" class="text-decoration-none">{{ $book->author->name }}</a> | Category: <a href="$books?category={{ $book->category->slug }}">{{ $book->category->category_name }}</a></p> --}}
            {{-- <h5>Author: {{ $book["author"] }}</h5> --}}
            @if($book->book_cover_path)
            <div style="max-height: 450px; overflow:hidden;">
                <img src="{{ asset('storage/' . $book->book_cover_path) }}" alt="{{ $book->category->category_name }}" class="img-fluid card-img-top">
            </div>

            @else
            <img src="https://source.unsplash.com/1200x400/?{{ $book->category->category_name }}" class="card-img-top mt-3" alt="{{ $book->category->category_name }}" class="img-fluid mt-3">
            @endif

            <article class="my-3 fs-5">
            {!! $book->body !!} {{--{!! $book->body !!} is berfungsi untuk menampilkan html yang ada di dalam database   --}}
            </article>


        <a href="/uploaded-books">Kembali</a>
        </div>
    </div>
</div>
</body>
