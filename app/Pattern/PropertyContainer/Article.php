<?php

namespace App\Pattern\PropertyContainer;

class Article extends PropertyContainer
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private int $category_id;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->category_id = $categoryId;
    }
}