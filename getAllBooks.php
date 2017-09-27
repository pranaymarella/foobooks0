<?php

require('helpers.php');

$booksJson = file_get_contents('books.json');

// the true parameter will give us back an array object
$books = json_decode($booksJson, true);

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
} else {
    $keyword = '';
}

if (isset($_GET['caseSensitive'])) {
    $caseSensitive = true;
} else {
    $caseSensitive = false;
}

$hasResults = true;
$caseSensitiveChecked = '';

if ($keyword == '') {
    return $books;
}

foreach ($books as $title => $book) {
    if ($caseSensitive) {
        $match = $title == $keyword;
    } else {
        $match = strtolower($title) == strtolower($keyword);
    }

    if (!$match) {
        unset($books[$title]);
    }
}

if (count($books) == 0) {
    $hasResults = false;
} else {
    $hasResults = true;
}

if ($caseSensitive) {
    $caseSensitiveChecked = 'CHECKED';
} else {
    $caseSensitiveChecked = '';
}

#dump($books);

#dump($books['The Bell Jar']['author']);
