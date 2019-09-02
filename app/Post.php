<?php

namespace App;

use App\Events\PostCreated;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Post extends Eloquent
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
