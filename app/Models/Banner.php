<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
   use \Czim\Paperclip\Model\PaperclipTrait;
    use HasFactory;

    protected $table = 'banners';
     protected $fillable =['title', 'banner'];
     protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['banner_url'];
     public function __construct( array $attributes = [] ) {
        $this->hasAttachedFile('banner');
        parent::__construct($attributes);
    }

     public function getbannerUrlAttribute() {
        return $this->banner->url();
    }


}
