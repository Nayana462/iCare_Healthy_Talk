<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
   use \Czim\Paperclip\Model\PaperclipTrait;
    use HasFactory;
    protected $table = 'categories';
     protected $fillable =['title' , 'icon' , 'banner'];
     protected $dates = [
        'created_at',
        'updated_at',
    ];

     protected $appends = ['icon_url','banner_url'];

    public function __construct( array $attributes = [] ) {
        $this->hasAttachedFile('icon');
        $this->hasAttachedFile('banner');
        parent::__construct($attributes);
    }

    public function geticonUrlAttribute() {
        return $this->icon->url();
    }

    public function getbannerUrlAttribute() {
        return $this->banner->url();
    }
}

