<?php

namespace App\Model\Message;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    protected $table = 'topic_replies';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function scopeDeleted_at($query,$deleted_at=1)
    {
          return $query->where('deleted_at',$deleted_at);
    }
}
