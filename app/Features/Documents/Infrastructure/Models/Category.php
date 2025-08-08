<?php
declare(strict_types= 1);

namespace App\Features\Documents\Infrastructure\Models; 

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name"];

    public static function defaultCategoryId()
    {
        return 1; 
    }
}
