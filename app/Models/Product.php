<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const TABLE         = 'products';
    
    const NAME          = 'name';
    const DESCRIPTION   = 'description';
    const AUTHOR_ID     = 'author_id';
    const CREATED_AT    = 'created_at';

    const RELATION_AUTHOR  = 'author';
    const AUTHOR_NAME      = 'author_name';

    protected $fillable = [
        self::NAME,
        self::DESCRIPTION,
        self::CREATED_AT,
        self::AUTHOR_ID
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, self::AUTHOR_ID, 'id', 'users');
    }
}
