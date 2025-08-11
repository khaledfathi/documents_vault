<?php
declare(strict_types= 1);

namespace App\Shared\Infrastructure\Models; 

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        "file",
        "document_id",
    ];
    //

    public function document (){
        return $this->belongsTo(Document::class);
    }
}
