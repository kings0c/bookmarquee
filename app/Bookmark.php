<?php
namespace App;

//use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model {
    
    protected $primaryKey = "bookmark_id";
    
    protected $table = 'bookmarks';
    
    protected $fillable = [
        'owner_id',
        'title',
        'url',
        'content',
        'colour'
    ];
    
    protected $hidden = ['bookmark_id', 'owner_id', 'created_at', 'updated_at'];
    
}