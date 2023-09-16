<?php


// Composer autoload
use CarbonPHP\Abstracts\ColorCode;
use CarbonPHP\Interfaces\iColorCode;
use SnackInterview\Book;
use SnackInterview\Library;

if (false === ($loader = include $autoloadFile = 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {

    print "<h1>Failed loading Composer at ($autoloadFile). Please run <b>composer install</b>.</h1>";

    die(1);

}

$captureValidInput = static function (string $prompt): string {

    $count = 0;

    do {

        $userInput = readline($count ? 'Try again. ' . $prompt : $prompt);

        $count++;

    } while ($userInput === '');

    return $userInput;

};

// no need to dynamic ref since we're only using one instance of library.
new Library('Snack Library');

$helpMenu = [
    'help' => 'This menu (default)',
    'create' => 'Create a new user',
    'get' => 'Get a list of books',
    'borrow' => 'Borrow a book',
    'return' => 'Return a book',
    'exit' => 'Exit the program'
];


$userInput = '';

do {

    ColorCode::colorCode(print_r($helpMenu, true));

    $userInput = readline('Enter a command: ');

    switch ($userInput) {

        default:
        case 'help':
            ColorCode::colorCode('Hire me!');
            break;

        case 'create':

            $book = new Book(
                title: $captureValidInput('Enter a title: '),
                author: $captureValidInput('Enter an author: '),
                isbn: $captureValidInput('Enter an ISBN: '));

            Library::addBook($book);

            break;

        case 'get':

            $availableBooks = Library::findAvailableBooks();

            if (count($availableBooks)) {

                ColorCode::colorCode('Available books:');

                foreach ($availableBooks as $book) {

                    ColorCode::colorCode($book->getTitle() . ', ' . $book->getAuthor() . ' #' . $book->getISBN(), iColorCode::CYAN);

                }

            } else {

                ColorCode::colorCode('No available books.', iColorCode::YELLOW);

            }

            break;

        case 'borrow':

            $isbn = $captureValidInput('Enter an ISBN: ');

            Library::borrowBook($isbn);

            break;

        case 'return':

            $isbn = $captureValidInput('Enter an ISBN: ');

            Library::returnBook($isbn);

            break;

        case 'exit':

            ColorCode::colorCode('Have a great day!', iColorCode::GREEN);

            break;

    }

} while ($userInput !== 'exit');