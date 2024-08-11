<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['book_id'];
    protected $primaryKey = 'book_id';

    protected $with = ['category', 'user'];

    public function scopeFilter($query, array $filters) //fungsi scopeFilter berfungsi untuk search berdasarkan category
    {
        $query->when($filters['category'] ?? false, function($query, $category)
        {
            return $query->whereHas('category', function($query) use ($category)
            {
                $query->where('category_id', $category);
            });
            //akan dijalankan ketika di dalam request ada category-nya
        });

        // filter by user
        $query->when($filters['user'] ?? false, fn($query, $user) =>
            $query->whereHas('user', fn($query) =>
                $query->where('username', $user)));
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
