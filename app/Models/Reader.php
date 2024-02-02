<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reader extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'email', 'address', 'password', 'phone'];

    /**
     * The books that belong to the Reader
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'checkout', 'reader_id', 'book_id');
    }
}
