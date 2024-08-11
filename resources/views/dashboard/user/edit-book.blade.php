@include('template.header')

@include('template.navbar')

<div class="container container-add-book">
    <h1 class="h3 mb-3 fw-normal text-center">Edit Buku {{ $book->book_title }}</h1>
    <form action="/edit-book/{{ $book->book_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                @foreach ($categories as $category)
                    @if (old('category_id', $book->category_id) == $category->category_id)
                        <option value="{{ $category->category_id }}" selected>{{ $category->category_name }}</option>
                    @else
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                    @endif
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="book_title" class="form-control @error('book_title') is-invalid @enderror"
                id="book_title" placeholder="Judul Buku" required value="{{ old('book_title', $book->book_title) }}">
            <label for="book_title">Judul Buku</label>
            @error('book_title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">

            <input type="file" name="book_cover_path" class="form-control @error('book_cover_path') is-invalid @enderror" id="book_cover_path" onchange="previewImage()">
            <label for="book_cover_path">Cover Buku</label>
            @if ($book->book_cover_path)
                <!-- Jika ada cover buku -->
                <img id="bookCoverPreview" src="{{ asset('storage/' . $book->book_cover_path) }}" alt="{{ $book->category->category_name }}" class="img-fluid mt-3 card-img-top">
            @else
                <!-- Jika tidak ada cover buku -->
                <img id="bookCoverPreview" src="https://source.unsplash.com/1200x400/?{{ $book->category->category_name }}" alt="{{ $book->category->category_name }}" class="img-fluid mt-3 card-img-top">
            @endif
            @error('book_cover_path')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>


        <div class="form-floating mb-3">
            <textarea name="book_description" class="form-control @error('book_description') is-invalid @enderror"
                id="book_description" placeholder="Deskripsi Buku" required>{{ old('book_description', $book->book_description) }}</textarea>
            <label for="book_description">Deskripsi Buku</label>
            @error('book_description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="book_total" class="form-control @error('book_total') is-invalid @enderror"
                id="book_total" placeholder="Jumlah Buku" required value="{{ old('book_total', $book->book_total) }}">
            <label for="book_total">Jumlah Buku</label>
            @error('book_total')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="file" name="book_path" value="{{ asset('storage/' . $book->book_path) }}" class="form-control @error('book_path') is-invalid @enderror"
                id="book_path">
            <label for="book_path">File Buku (PDF)</label>
            @error('book_path')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-3 bg-warning btn-outline-warning text-white"
            type="submit">Perbarui Buku</button>
    </form>
</div>

<style>
    <style>.form-control,
    .form-select,
    .btn {
        max-width: 300px;
    }

    .form-group,
    .form-floating {
        margin-bottom: 20px;
    }

    .form-group:first-child {
        margin-bottom: 40px;
    }

    .container-add-book {
        width: 50%;
        margin: 0 auto;
    }
</style>

<script>
    function previewImage() {
        const file = document.querySelector('#book_cover_path').files[0];
        const preview = document.querySelector('#bookCoverPreview');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.hidden = false; // Memastikan preview tidak hidden
            };

            reader.readAsDataURL(file);
        }
    }
</script>


</body>
