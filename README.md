**Task 1: Basic Syntax and Understanding**
### 1.1. Write a PHP script to display the current date and time in the following format: "Day-Month-Year Hours:Minutes:Seconds".

```PHP
<?=date('d-M-Y H:i:s') ?>
```

Or you can execute using your shell:

```BASH
php -r "print date('d-M-Y H:i:s');"
```

### 1.2. Explain the differences between "echo" and "print" in PHP.

Print only accepts one argument, while echo uses the variable length arguments using the (…) operator. Time complexities vary depending on how and what you pass to the two functions. Given complex arguments, a breakdown of time complexities is done in real-time at (https://phpbench.com/).

**Task 2: Strings and Arrays**
### 2.1. Write a PHP function that checks if a string is a palindrome or not.
This is a very simple palindrome checker. It is case-sensitive and does not ignore spaces.
```PHP
$isPalindrome = static function($str) {
    
    // Reverse the string
    $reverseStr = strrev($str);
    
    // Compare the original string with its reverse
    return $str === $reverseStr;
    
}
```
https://www.php.net/manual/en/function.strrev.php

### 2.2. Write a PHP script that removes duplicate elements from an array.

```PHP
$removeArrayDuplicates = static fn($array) => array_unique($array);
```
https://www.php.net/manual/en/function.array-unique.php

**Task 3: File Handling and Exceptions**
### 3.1. Write a PHP script to read a file, count the number of lines in it, and display the count.

The following php command can be used to count the number of lines in a file (README.md):

    php -r 'echo trim(`cat README.md | wc -l`);'

Cat will print a full file to stdout which is then piped to wc -l. 
This ensures wc will not print the filename in the corresponding output. 
This is just php running a [shell_exec](https://www.php.net/manual/en/function.shell-exec.php) using the [Execution Operator](https://www.php.net/manual/en/language.operators.execution.php).
PHP is not the best language for this task which is the shell `wc` is used, but a pure PHP example can be done.
For sufficiently large files, php can not load the full file into memory.
This only leaves us with the option of reading the file line by line using a file pointer.
```PHP
<?php

// Specify the file path
$filePath = $argv[1] ?? "README.md"; 

// Check if the file exists
if (file_exists($filePath)) {
    
    // Open the file for reading
    $file = fopen($filePath, "r");
    
    if ($file) {
        $lineCount = 0; // Initialize line count
        
        // Loop through the file line by line
        while (($line = fgets($file)) !== false) {
            
            $lineCount++;
            
        }
        
        // Close the file
        fclose($file);
        
        // Display the count
        echo "Number of lines in the file: $lineCount";
        
    } else {
    
        echo "Failed to open the file.";
    
    }
   
} else {
    
    echo "The file does not exist.";

}

```

### 3.2. Explain how you would handle exceptions in PHP. Provide an example.

There are two types of throwable issues in PHP: Exceptions and Errors. 
Both Errors and Exceptions extend the [Throwable](https://www.php.net/manual/en/class.throwable) interface. 
Both types of Throwable issues can be handled globally using the php internal [set_exception_handler](https://www.php.net/manual/en/function.set-exception-handler.php) and [set_error_handler](https://www.php.net/manual/en/function.set-error-handler.php) functions respectively.
What types of errors are thrown can be controlled using the [error_reporting](https://www.php.net/manual/en/function.error-reporting.php) function. Some errors are not catchable using `Try {} catch () {}` blocks, such as [E_DEPRECATED](https://www.php.net/manual/en/errorfunc.constants.php#errorfunc.constants.errorlevels) and must be handled with global handlers.
Other oddities should be noted [compile time vs runtime](https://stackoverflow.com/questions/59619285/deprecation-warning-not-catchable-in-php-7-4). 
Implementing a global handlers and try catch blocks should be done.

Let's look at an example of my [Throwable Handler](https://github.com/CarbonORM/CarbonPHP/blob/lts/carbonphp/error/ThrowableHandler.php).
If you do not have Composer installed globally you can use the [shell installer](https://getcomposer.org/doc/faqs/how-to-install-composer-programmatically.md) also provided in this repo.
```BASH
chmod +x ./downlaodComposer.sh
./downlaodComposer.sh
```

Update the configurations database username and password. The default is `root` and `password`.
This is located ./snackinterview/SnackCrate.php.
You can use this command ` cat ./snackinterview/SnackCrate.php | grep -n CarbonPHP::DB_USER` to find the line number or optionally use the following sed command to update the file.
You'll still need to modify the user and password (SnackUser & SnackPass) from the command below.

```BASH 
sed -i '' -E "s|CarbonPHP::DB_USER => '(.*)',|CarbonPHP::DB_USER => 'SnackUser',|g" ./snackinterview/SnackCrate.php
sed -i '' -E "s|CarbonPHP::DB_PASS => '(.*)',|CarbonPHP::DB_PASS => 'SnackPass',|g" ./snackinterview/SnackCrate.php
```

Once you have composer installed you can use it to install the dependencies and set up our [PSR-4 namespacing](https://www.php-fig.org/psr/psr-4/) for this project.
```BASH
./composer.phar install
```

Now we can run the example using php's built in web server. 
Note PHP's server does have a small memory leak, so it is not recommended for production or large projects.
```BASH
php -S 0.0.0.0:8000 error.php
```

Then visit http://localhost:8000/ in your browser. Some OS' support:

```BASH
open http://localhost:8000/
```


### 4.1. Write a PHP script using PDO to connect to a MySQL database and execute a SELECT query.

The following command will start a php server on port 8000 and serve the connect.php file.
This demonstrates a connection to a MySQL database using PDO.

```BASH
php -S 0.0.0.0:8000 connect.php
```


### 4.2. How would you prevent SQL injection in PHP? Provide an example.

SQL injection is easily prevented by using [prepared statements](https://www.php.net/manual/en/pdo.prepared-statements.php).
My project [CarbonPHP](https://github.com/CarbonORM/CarbonPHP) uses PDO and prepared statements by default and automates the process in a way that is seamless and simple to use.
[This file](https://github.com/CarbonORM/CarbonPHP/blob/lts/carbonphp/Rest.php) is largely responsible for the REST ORM PDO foundation.


**Task 5: PHP OOP Concepts**
### 5.1. Create a Library Book Management System
### Instructions:
Create a simple Library Book Management System in PHP using object-oriented programming principles. Your system should consist of a Book class and a Library class.

##### Book Class:

##### Usage:

Following [best practices](https://www.php-fig.org/psr/) we will use [composer](https://getcomposer.org/) to load our namespaces dynamically. 
Please ensure that `composer.phar install` has been run in this directory.

```BASH
php oopLibrary.php
```

##### Create a Book class with the following attributes and methods:
- Attributes: 
    - Title
    - Author
    - ISBN (International Standard Book Number)
    - Availability (boolean indicating whether the book is available for borrowing)
- Methods:
    - __construct($title, $author, $isbn): A constructor method to initialize the book's attributes. By default, a book should be marked as available.
    - getTitle(): Returns the book's title.
    - getAuthor(): Returns the book's author.
    - getISBN(): Returns the book's ISBN.
    - isAvailable(): Returns true if the book is available, false otherwise.
    - borrowBook(): Sets the book's availability to false when it's borrowed.
    - returnBook(): Sets the book's availability to true when it's returned.

##### Library Class:
Create a Library class with the following attributes and methods:
- Attributes: 
    - Name
    - Books (an array to store Book objects)
- Methods:
  - __construct($name): A constructor method to initialize the library's name.
  - addBook($book): Accepts a Book object and adds it to the library's collection of books.
  - findAvailableBooks(): Returns an array of all available books in the library. 
  - findBookByISBN($isbn): Takes an ISBN as an argument and returns the corresponding book object if it exists in the library, or null if not found.
  - borrowBook($isbn): Accepts an ISBN, finds the book, and borrows it (set its availability to false).
  - returnBook($isbn): Accepts an ISBN, finds the book, and returns it (set its availability to true). 

Instructions for the Assessment:
- Create the Book class as described above.
- Create the Library class as described above.
- Write a sample script that demonstrates the functionality of your Library Book Management System. This script should: 
    - Create instances of the Book class.
    - Create an instance of the Library class.
    - Add books to the library.
    - Borrow and return books.
    - Display available books in the library.

Ensure that your code is well-documented, follows best practices for OOP in PHP, and handles potential errors gracefully.










