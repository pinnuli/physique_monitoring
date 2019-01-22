<?php

namespace App\Model\Message;

use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    protected $table = 'topic_types';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['id', 'name', 'type_key', 'type_desc'];

    public function scopeDeleted_at($query,$deleted_at=1)
    {
          return $query->where('deleted_at',$deleted_at);
    }
}
