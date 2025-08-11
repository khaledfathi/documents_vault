<?php
declare(strict_types= 1);

namespace App\Shared\Infrastructure\Models; 

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name" , "description"];

    public static function defaultCategoryId()
    {
        return 1; 
    }
}
