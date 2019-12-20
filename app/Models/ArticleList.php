<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleCategory;
use App\Models\ArticleZan;

class ArticleList extends Model
{
    //
    protected $table = 'article_list';

    public function post()
    {
        return $this->belongsTo(ArticleCategory::class,'catid');
    }
    public function zan()
    {
        return $this->hasMany(ArticleZan::class,'aid')->where('article_zan.status',1);
    }
}
