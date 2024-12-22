<?php
class CategoryController {
    private $category;

    public function __construct($db) {
        $this->category = new Category($db);
    }

    public function getCategories() {
        return $this->category->readAll();
    }
}