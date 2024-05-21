<?php
class CategoryModel extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCategories()
    {
        return $this->select("SELECT * FROM category");
    }

}