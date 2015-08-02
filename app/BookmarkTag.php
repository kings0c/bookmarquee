<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BookmarkTag extends Model {
    
    protected $primaryKey = null;
    public $incrementing = false;
    
    protected $table = 'bookmarks_tags';
    
    protected $fillable = [
        'bookmark_id',
        'tag_id'
    ];
    
    protected $hidden = ['bookmark_id', 'owner_id'];
    
}