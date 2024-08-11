@include('template.header')

@include('template.navbar')

{{-- JS untuk filter bar agar langsung ke kategori yang dipilih tanpa klik submit --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.querySelector('.form-select');
        selectElement.addEventListener('change', function() {
            if (this.value === "") {
                window.location.href = '/books'; // Redirect ke /books tanpa parameter
            } else {
                this.form.submit(); // Submit form dengan parameter category
            }
        });
    });
</script>


<h1 class="mb-3 text-center">{{ $title }}</h1>


{{-- Filter Bar --}}
<div class="row justify-content-center mb-3">
    <div class="col-md-4">
        <form action="/books" method="get">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="filterLabel">Filter</span>
                </div>
                <select class="form-select" name="category" aria-label="Filter by Category"
                    aria-describedby="filterLabel">
                    <option value="" selected>Semua</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}"
                            {{ request('category') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>

</div>
{{-- End Filter Bar --}}

{{-- Latest Book --}}
@if ($books->count())
    <div class="card mb-3">
        @if ($books[0]->book_cover_path)
            <div style="max-height: 450px; overflow:hidden;">
                <img src="{{ asset('storage/' . $books[0]->book_cover_path) }}"
                    alt="{{ $books[0]->category->category_name }}" class="img-fluid">
            </div>
        @else
            <img src="https://source.unsplash.com/1200x400/?{{ $books[0]->category->category_name }}"
                class="card-img-top" alt="{{ $books[0]->category->category_name }}">
        @endif

        <div class="card-body text-center">
            <h3 class="card-title"><a href="/book/{{ $books[0]->book_id }}"
                    class="text-decoration-none text-dark">{{ $books[0]->book_title }}</a></h3>
            <p>
                <small class="text-muted">
                    Pengunggah: <a href="/books?user={{ $books[0]->user->username }}"
                        class="text-decoration-none">{{ $books[0]->user->user_name }}</a> | Kategori: <a
                        href="/books?category={{ $books[0]->category->category_id }}"
                        class="text-decoration-none">{{ $books[0]->category->category_name }}</a>
                    {{ $books[0]->created_at->diffForHumans() }}
                </small>
            </p>
            {{-- <p class="card-text">{{ $books[0]->excerpt }}</p> --}}

            <a href="/book/{{ $books[0]->book_id }}" class="text-decoration-none btn btn-primary">Lihat Buku</a>
        </div>
        {{-- END Latest Book --}}




        {{-- Other Book --}}
        <div class="container">
            <div class="row">
                @foreach ($books->skip(1) as $book)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute px-3 px-2" style="background-color: rgba(0,0,0,0.7)"><a
                                    href="/books?category={{ $book->category->category_id }}"
                                    class="text-white text-decoration-none">{{ $book->category->category_name }}</a>
                            </div>
                            @if ($book->book_cover_path)
                                <img src="{{ asset('storage/' . $book->book_cover_path) }}"
                                    alt="{{ $book->category->category_name }}" class="card-img-top">
                            @else
                                <img src="https://source.unsplash.com/500x500/?{{ $book->category->category_name }}"
                                    class="card-img-top" alt="{{ $book->category->category_name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->book_title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        Pengunggah: <a href="/books?user={{ $book->user->username }}"
                                            class="text-decoration-none">{{ $book->user->user_name }}</a> | Kategori:
                                        <a href="/books?category={{ $books[0]->category->category_id }}"
                                            class="text-decoration-none">{{ $books[0]->category->category_name }}</a>
                                        {{ $book->created_at->diffForHumans() }} {{-- diffForHumans() adalah fungsi untuk menampilkan waktu yang sudah berlalu --}} </small>
                                </p>
                                {{-- <p class="card-text">{{ $book->excerpt }}</p> --}}
                                <a href="/book/{{ $book->book_id }}" class="btn btn-primary">Lihat Buku</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center fs-4 text">Buku Tidak Ditemukan</p>
@endif
{{-- End Other Book --}}

<div class="d-flex justify-content-center">
    {{ $books->links() }} {{-- ini adalah fungsi untuk membuat pagination --}}
</div>
</body>
