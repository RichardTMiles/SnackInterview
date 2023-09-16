<?php

namespace SnackInterview;

use CarbonPHP\Abstracts\ColorCode;
use CarbonPHP\Interfaces\iColorCode;

class Library
{
    public static string $name;

    /**
     * Using PHPDOC to define the type of the array
     * This helps your editor know what type of data is in the array
     * @var Book[]
     */
    public static array $books = [];

    public function __construct(string $name)
    {
        self::$name = $name;
    }

    public static function addBook(Book $book): void
    {
        self::$books[] = $book;
    }

    /**
     * @return Book[]
     */
    public static function findAvailableBooks() : array {

        $availableBooks = [];

        foreach (self::$books as $book) {

            if ($book->isAvailable()) {

                $availableBooks[] = $book;

            }

        }

        return $availableBooks;

    }

    public static function findBookByISBN(string $isbn) : ?Book {

        foreach (self::$books as $book) {

            if ($book->getISBN() === $isbn) {

                return $book;

            }

        }

        return null;

    }

    public static function borrowBook(string $isbn) : void {

        $book = self::findBookByISBN($isbn);

        if ($book) {

            if ($book->isAvailable()) {

                $book->borrowBook();

                ColorCode::colorCode("Book with ISBN $isbn borrowed.");

            } else {

                ColorCode::colorCode("Book with ISBN $isbn is not available.", iColorCode::RED);

            }

        } else {

            ColorCode::colorCode("Book with ISBN $isbn not found.", iColorCode::RED);

        }

    }

    public static function returnBook(string $isbn) : void {

        $book = self::findBookByISBN($isbn);

        if ($book) {

            if (!$book->isAvailable()) {

                $book->returnBook();

                ColorCode::colorCode("Book with ISBN $isbn returned.");

            } else {

                ColorCode::colorCode("Book with ISBN $isbn is already available.", iColorCode::RED);

            }

        } else {

            ColorCode::colorCode("Book with ISBN $isbn not found.", iColorCode::RED);

        }

    }

}