<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_id', 'user_id',  'data', 'updated_at', 'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
		'created_at' => 'datetime',
    ];
	public function comment() {
		return $this->belongsTo('App\Comment');
	}
	public function user() {
		return $this->belongsTo('App\User');
	}
}
