<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScrabbleController extends Controller
{
    # GET /
    # home page
    public function word(Request $request) {
             
        # Return the view
        return view('scrabble.word')->with([
            'inputWord' => $request->input('inputWord'),
            'lookupDefinition' => $request->input('lookupDefinition'),
        ]);
    }

    # GET /score
    # lookup word and parse for scoring
    public function score(Request $request){
        # Validate the request data
        $this->validate($request, [
            'inputWord' => 'required|alpha',
        ]);

        $word = $request->input('inputWord', null);
        $lookupDefinition = $request->input('lookupDefinition', 'off');

        # convert to uppercase for dictionary search
        if($word != null){
            $word = strtoupper($word);
        }

        $letters = [];
        $definition = '';
        
        # retrieve definition
        if($word && $lookupDefinition == 'on'){
            $dictRaw = file_get_contents(database_path().'/dictionary.json');
            $dict = json_decode($dictRaw, true);
            if(!empty($dict[$word])){
                $definition = $dict[$word];
            }
            else{
                $definition = 'none';
            }
        }

        # parse letters
        if($word != null){
            $letters = str_split($word, 1);
        }

        # determine eligibilty for bingo bonus
        $bingoBonus = false;
        if(count($letters) >= 7){
            $bingoBonus = true;
        }
        return view('scrabble.score')->with([
            'word' => $word,
            'definition' => $definition,
            'letters' => $letters,
            'bingoBonus' => $bingoBonus,
        ]);
    }

    # POST /result
    # calculate and return the score based on inputs
    public function result(Request $request){
        # Validate the request data
        $this->validate($request, [
            'bonusLetter' => 'required',
            'bonusWord' => 'required',          
        ]);
        
        $score = 0;
        $bonusLetter = $request -> input('bonusLetter');
        $wordBonus = $request->input('bonusWord', 'none');
        $bingoBonus = $request->input('bingo', 'off');
        
         $letterValue = [
            'A' => 1,
            'B' => 3,
            'C' => 3,
            'D' => 2,
            'E' => 1,
            'F' => 4,
            'G' => 2,
            'H' => 4,
            'I' => 1,
            'J' => 8,
            'K' => 5,
            'L' => 1,
            'M' => 3,
            'N' => 1,
            'O' => 1,
            'P' => 3,
            'Q' => 10,
            'R' => 1,
            'S' => 1,
            'T' => 1,
            'U' => 1,
            'V' => 4,
            'W' => 4,
            'X' => 8,
            'Y' => 4,
            'Z' => 10
        ];
        
        $letterCount = count($bonusLetter);

        # calculate individual tile contributions
        for ($i = 0; $i < $letterCount; $i++){
            foreach($bonusLetter[$i] as $letter => $bonus){
                if($bonus == "None"){
                    $tile_value = $letterValue[$letter];
                    $tile_value_after_bonus = $tile_value;
                    $bonusLetter[$i]["tileValue"] = $tile_value;
                    $bonusLetter[$i]["total"] = $tile_value_after_bonus;
                    $bonusLetter[$i]["letter"] = $letter;
                    $score +=  $tile_value_after_bonus;
                }
                if($bonus == "Double"){
                    $tile_value = $letterValue[$letter];
                    $tile_value_after_bonus = $tile_value * 2;
                    $bonusLetter[$i]["tileValue"] = $tile_value;
                    $bonusLetter[$i]["total"] = $tile_value_after_bonus;
                    $bonusLetter[$i]["letter"] = $letter;
                    $score +=  $tile_value_after_bonus;
                }
                if($bonus == "Triple"){
                    $tile_value = $letterValue[$letter];
                    $tile_value_after_bonus = $tile_value * 3;
                    $bonusLetter[$i]["tileValue"] = $tile_value;
                    $bonusLetter[$i]["total"] = $tile_value_after_bonus;
                    $bonusLetter[$i]["letter"] = $letter;
                    $score +=  $tile_value_after_bonus;
                }
                else{
                    $errors = "Error: invalid letter bonus supplied";
                }
            }
        }
        
        $score_from_letters = $score;

        # calculate word bonus contribution
        if($wordBonus == "Double"){
            $wordBonusContribution = $score;
            $score *= 2;
        }
        elseif($wordBonus == "Triple"){
            $wordBonusContribution = $score * 2;
            $score *= 3;
        }
        else{
            $wordBonusContribution = 'None';
        }

        # calculate bonus for using all 7 tiles
        if($bingoBonus == 'on'){
            $score += 50;
        }

        # return the calculated results
        return view('scrabble.result')->with([
            'score' => $score,
            'score_from_letters' => $score_from_letters,
            'bonusLetter' => $bonusLetter,
            'wordBonus' => $wordBonus, 
            'wordBonusContribution' => $wordBonusContribution,
            'bingoBonus' => $bingoBonus,
        ]);
    }

}
