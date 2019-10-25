<?php


namespace App\Service\Search;


use Psr\Container\ContainerInterface;

class ArticleSearch extends ElasticSearch
{
    public function __construct($id)
    {
        $this->index = 'gin';
        $this->type = 'Article';
        $this->id = $id;
    }

    public function create(array $data)
    {
        return $this->create($data);
    }
}