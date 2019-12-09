<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Models\Gutenbergable;

class BlogPost extends Model
{
    use Gutenbergable;
}
