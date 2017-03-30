<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScrabbleController extends Controller
{
    // GET /words
    // public function index(){
    
    //     return 'View all the books...';
    // }

    //GET /scrabble/{$word?}
    public function show($word = null){
        # query the database for all books that match the title

        # return the book
        return view('scrabble.show')->with([
            'word' => $word,
        ]);
    }

    public function score($score = null){
        return view('scrabble.score')->with([
            'score' => $score,
        ]);
    }

    /**
	* GET
    * /lookup
	*/
    public function lookup(Request $request) {
        
        //dump($request);

        $word = $request->input('searchTerm');
        $caseSens = $request->input('searchTerm');
        
    # Start with an empty array of search results; books that
    # match our search query will get added to this array
    $searchResults = [];

    # Store the searchTerm in a variable for easy access
    # The second parameter (null) is what the variable
    # will be set to *if* searchTerm is not in the request.
    $searchTerm = $request->input('searchTerm', null);

    # Only try and search *if* there's a searchTerm
    if($searchTerm) {

        # Open the books.json data file
        # database_path() is a Laravel helper to get the path to the database folder
        # See https://laravel.com/docs/5.4/helpers for other path related helpers
        $dictionaryRawData = file_get_contents(database_path().'/dictionary.json');

        # Decode the book JSON data into an array
        # Nothing fancy here; just a built in PHP method
        $words = json_decode($dictionaryRawData, true);

        # Loop through all the book data, looking for matches
        # This code was taken from v1 of foobooks we built earlier in the semester
        foreach($words as $title => $word) {

            # Case sensitive boolean check for a match
            if($request->has('caseSensitive')) {
                $match = $title == $searchTerm;
            }
            # Case insensitive boolean check for a match
            else {
                $match = strtolower($title) == strtolower($searchTerm);
            }

            # If it was a match, add it to our results
            if($match) {
                $searchResults[$title] = $word;
            }

        }
    }

    # Return the view, with the searchTerm *and* searchResults (if any)
    return view('scrabble.lookup')->with([
        'searchTerm' => $searchTerm,
        'caseSensitive' => $request->has('caseSensitive'),
        'searchResults' => $searchResults
    ]);

        // # Boolean to see if the request contains data for a particular field
        // dump($request->has('searchTerm')); # Should be true
        // dump($request->fullUrl());
        // dump($request->path());
        // dump($request->isMethod('post'));
        
    }
}
