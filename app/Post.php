<?php

namespace App;

use App\Events\PostCreated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
    	'created' => PostCreated::class
    ];

    public function owner () {
    	return $this->belongsTo(User::class);
    }

    public function prepareForDisplay () {
        $this->displayableContent = str_replace("\r\n", "<br>", htmlspecialchars($this->description));
    }
}
