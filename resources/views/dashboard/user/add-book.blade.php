@include('template.header')

@include('template.navbar')

<div class="container container-add-book">
    <h1 class="h3 mb-3 fw-normal text-center">Tambah Buku Baru</h1>
    <form action="/add-book" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id">
                {{-- Asumsi Anda sudah memiliki $categories yang di-pass dari controller --}}
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}"
                        {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}</option>
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
                id="book_title" placeholder="Judul Buku" required value="{{ old('book_title') }}">
            <label for="book_title">Judul Buku</label>
            @error('book_title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <label for="book_cover_path">Cover Buku</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input type="file" name="book_cover_path"
                class="form-control @error('book_cover_path') is-invalid @enderror" id="book_cover_path" onchange="previewImage()" required>
                <img id="bookCoverPreview" style="width: 100%; height: auto; margin-top: 10px;" src="#" alt="Preview Cover Buku" hidden>
                @error('book_cover_path')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <textarea name="book_description" class="form-control @error('book_description') is-invalid @enderror"
                id="book_description" placeholder="Deskripsi Buku" required>{{ old('book_description') }}</textarea>
            <label for="book_description">Deskripsi Buku</label>
            @error('book_description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="number" name="book_total" class="form-control @error('book_total') is-invalid @enderror"
                id="book_total" placeholder="Jumlah Buku" required value="{{ old('book_total') }}">
            <label for="book_total">Jumlah Buku</label>
            @error('book_total')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="file" name="book_path" class="form-control @error('book_path') is-invalid @enderror"
                id="book_path" required>
            <label for="book_path">File Buku (PDF)</label>
            @error('book_path')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-3 bg-warning btn-outline-warning text-white"
            type="submit">Tambah Buku</button>
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
    document.getElementById('book_cover_path').addEventListener('change', function(event) {
        const output = document.getElementById('bookCoverPreview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        output.hidden = false; // Menampilkan elemen img
    });
    </script>

</body>
