<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

class Document extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
    ];
    //

    public function files() {
        return $this->hasMany(File::class  );
    }

    public function scopeWithFileCount(Builder $query):Builder {
        return $query->withCount('files');
    }

    public function scopeWithFiles(Builder $query) {
        return $query->with('files')->withFileCount();
    }

    public function scopeWithCategoryName(Builder $query) {
        return $query->join('categories', 'documents.category_id', '=', 'categories.id')
                     ->select('documents.*', 'categories.name as category_name')->withFiles();
    }


}
