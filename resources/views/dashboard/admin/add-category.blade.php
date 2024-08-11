@include('template.header')

@include('template.navbar')
<div class="container-add-category">
<h1 class="text-center">{{ $title }}</h1>
<form action="/admin/add-category" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <div class="form-floating mb-3">
            <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror"
                id="category_name" placeholder="Kategori Buku" required
                value="{{ old('category_name') }}">
            <label for="category_name">Kategori</label>
            @error('category_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <button class="w-100 btn btn-lg btn-primary mt-3 bg-warning btn-outline-warning text-white" type="submit">Tambah
        Kategori</button>
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

    .container-add-category {
        width: 50%;
        margin: 0 auto;
    }
</style>
</body>
