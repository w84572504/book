<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use ModelTree, AdminBuilder;
    protected $table = 'article_category';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }
    public function getFaList(){
        $list = App\ArticleCategory::all();
    }
}
