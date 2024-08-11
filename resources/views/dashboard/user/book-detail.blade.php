@include('template.header')
@include('template.navbar')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="mb-3">{{ $book->book_title }}</h2>

            @if ($book->book_cover_path)
                <div class="text-center" style="max-height: 450px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $book->book_cover_path) }}" alt="{{ $book->category->category_name }}"
                        class="img-fluid card-img-top">
                </div>
            @else
                <img src="https://source.unsplash.com/1200x400/?{{ $book->category->category_name }}"
                    class="card-img-top mt-3" alt="{{ $book->category->category_name }}" class="img-fluid mt-3">
            @endif

            <div class="mt-4">
                <h3>Deskripsi Buku:</h3>
                <p class="my-3 fs-5">{{ $book->book_description }}</p>
            </div>

            <div class="mt-3">
                <h3>Jumlah Buku:</h3>
                <p>{{ $book->book_total }} buah tersedia</p>
            </div>

            <div class="mt-4">
                <h2>Buku (PDF)</h2>
                <embed src="{{ asset('storage/' . $book->book_path) }}" type="application/pdf" width="100%"
                    height="600">
            </div>

            @if (Auth()->user()->user_role === 'admin')
                <a href="/books" class="btn btn-primary mt-4">Kembali</a>
                <a href="/edit-book/{{ $book->book_id }}" class="btn btn-warning mt-4">Edit</a>
                <form action="/delete-book/{{ $book->book_id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger mt-4"
                        onclick="return confirm('Apakah anda yakin ingin mengapus buku {{ $book->book_title }}?')">Hapus
                        Buku</span></button>
                </form>
            @else
                <a href="/uploaded-books" class="btn btn-primary mt-4">Kembali</a>
            @endif
        </div>
    </div>
</div>
</body>
