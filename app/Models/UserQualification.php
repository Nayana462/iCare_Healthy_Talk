<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQualification extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
    use \Czim\Paperclip\Model\PaperclipTrait;
    use HasFactory;

    protected $fillable =['title', 'document' , 'from_date',  'to_date' , 'percentage', 'user_id'];
     protected $dates = [
        'created_at',
        'updated_at',
    ];

     protected $appends = ['document_url'];

    public function __construct( array $attributes = [] ) {
        $this->hasAttachedFile('document');
        parent::__construct($attributes);
    }

    public function getdocumentUrlAttribute() {
        return $this->document->url();
    }

}
