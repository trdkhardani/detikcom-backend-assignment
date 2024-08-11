@include('template.header')

@include('template.navbar')

<h1 class="mb-3 text-center">{{ $title }}</h1>

@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
{{-- User Uploaded Books --}}
@if ($books->count())
    <div class="container">
        <div class="row">
            @foreach ($books as $book)
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
                                    Kategori:
                                    <a href="/books?category={{ $book->category->category_id }}"
                                        class="text-decoration-none">{{ $book->category->category_name }}</a>
                                    | {{ $book->created_at->diffForHumans() }} {{-- diffForHumans() adalah fungsi untuk menampilkan waktu yang sudah berlalu --}}
                                    | Jumlah: {{ $book->book_total }}
                                </small>
                            </p>
                            {{-- <p class="card-text">{{ $book->excerpt }}</p> --}}
                            <a href="/book/{{ $book->book_id }}" class="btn btn-primary">Lihat Buku</a>
                            <a href="/edit-book/{{ $book->book_id }}" class="btn btn-warning">Edit Buku</a>
                            <form action="/delete-book/{{ $book->book_id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin mengapus buku {{ $book->book_title }}?')">Hapus Buku</span></button>
                              </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center fs-4 text">Buku Tidak Ditemukan</p>
@endif

<div class="d-flex justify-content-center">
    {{ $books->links() }} {{-- ini adalah fungsi untuk membuat pagination --}}
</div>

<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        background-size: cover;
        background-position: center;
        object-fit: contain;
    }

    .card {
        border: 1px solid #ddd;
        margin-bottom: 20px;
    }
</style>
</body>
