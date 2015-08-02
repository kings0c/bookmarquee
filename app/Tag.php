<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    
    protected $primaryKey = 'tag_id';
    
    protected $table = 'tags';
    
    protected $fillable = [
        'tag_id',
        'tag_name'
    ];
    
    protected $hidden = ['tag_id', 'tag_name'];
    
}