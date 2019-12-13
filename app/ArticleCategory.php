<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use ModelTree, AdminBuilder;
    protected $table = 'article_category';
    public $timestamps = false;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('pid');
        $this->setOrderColumn('sort');
        $this->setTitleColumn('name');
    }
}
