<?php

namespace App;

class Post
{
    protected array $comments = [];

    public function addComment(Comment $comment): void
    {
        $this->comments[] = $comment;
    }

    public function countComments(): int
    {
        return count($this->comments);
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}