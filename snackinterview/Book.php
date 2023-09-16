<?php

namespace SnackInterview;

// this is largely a poor way of doing OOP in PHP
// I prefer static context and static methods to encourage functional programming
final class Book
{

    private string $title;
    private string $author;
    private string $isbn;

    private bool $isAvailable = true;

    public function __construct(string $title, string $author, string $isbn)
    {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getISBN(): string
    {
        return $this->isbn;
    }

    public function isAvailable() : bool {
        return $this->isAvailable;
    }

    public function borrowBook() : void {
        $this->isAvailable = false;
    }

    public function returnBook() : void {
        $this->isAvailable = true;
    }

}