<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleList;

class ArticleZan extends Model
{
    //
    protected $table = 'article_zan';

    public function post()
    {
        return $this->belongsTo(ArticleList::class,'aid');
    }
}
