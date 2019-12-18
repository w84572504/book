<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleCategory;

class ArticleList extends Model
{
    //
    protected $table = 'article_list';

    public function post()
    {
        return $this->belongsTo(ArticleCategory::class,'catid');
    }
}
