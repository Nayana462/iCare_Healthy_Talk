<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model implements \Czim\Paperclip\Contracts\AttachableInterface
{
      use \Czim\Paperclip\Model\PaperclipTrait;
    use HasFactory;
    protected $table = 'user_profile';
     protected $fillable=['fullname','phone','country','state','city' , 'address' , 'dob',
     'gender','user_id' , 'is_popular' , 'image'];

      protected $dates = [
        'email_verified_at',
        'phone_verified_at',
        'created_at',
        'updated_at',
    ];

    protected $appends = ['image_url'];
     public function __construct( array $attributes = [] ) {
        $this->hasAttachedFile('image');
        parent::__construct($attributes);
    }

     public function getimageUrlAttribute() {
        return $this->image->url();
    }


    public function UserProfile()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function doctorCategories1(){
         return $this->hasMany('App\Models\DoctorCategories','doctor_id');
    }
        public  function userQualifications()
    {
         return $this->hasMany('App\Models\UserQualification','user_id');
    }

}
