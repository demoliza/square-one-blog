<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TraitUuid;

class Post extends Model
{
    use TraitUuid;
    protected $guarded = [];
}
