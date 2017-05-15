<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Word;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return View
     */
    public function admin() {
        $words = DB::table('words')->paginate(8);
        return view('admin', [
            'words' => $words
        ]);
    }

    /**
     *
     * @param Request $request
     * @return Redirect
     */
    public function addWord(Request $request) {

        $this->validate($request, [
            'word' => 'bail|required|unique:words|alpha_num|max:255',
        ]);

        $json;
        try {
            $json = json_decode(file_get_contents($this->getTranslationUrl($request->word, 'bg', 'en')), false);
        } catch (\Exception $e) {
            Session::flash('error', 'Unable to translate word, please try again!');
            return redirect('/admin/');
        }

        $word = new Word;
        $word->word = $request->word;
        $word->translation = $json->translationText;
        $word->save();

        Session::flash('message', 'New word has been added!');
        return redirect('/admin/');
    }

    /**
     * Update word
     * 
     * @param Request $request
     * @param Word $word
     * @return Redirect
     */
    public function updateWord(Request $request, Word $word) {

        $this->validate($request, [
            'word' => 'bail|required|unique:words|alpha_num|max:255',
        ]);

        try {
            $json = json_decode(file_get_contents($this->getTranslationUrl($request->word, 'bg', 'en')), false);
            $word->translation = $json->translationText;
        } catch (\Exception $e) {
            Session::flash('error', 'Unable to translate word, please try again!');
            return redirect('/admin/');
        }
        $word->word = $request->word;
        $word->update();
        Session::flash('message', "Word has been updated");
        return redirect('/admin/');
    }

    /**
     * 
     * @param Request $request
     * @param Word $word
     * @return Redirect
     */
    public function deleteWord(Request $request, Word $word) {
        $word->delete();
        Session::flash('message', 'Word deleted!');
        return redirect('/admin/');
    }

    /**
     * 
     * @param Request $request
     * @return Redirect
     */
    public function translateFromFile(Request $request) {

        $this->validate($request, [
            'csv' => 'required|file|max:1024|mimes:csv,txt,text'
        ]);

        $file = $request->file('csv');
        $wordsAddedCount = 0;
        $wordsWithErrors = 0;
        foreach (file($file) as $line) {
            $line = trim($line);
            $validator = Validator::make(
                            ['word' => $line], ['word' => 'required|unique:words|alpha_num|max:255']
            );
            if ($validator->passes()) {
                $json = json_decode(file_get_contents($this->getTranslationUrl($line, 'bg', 'en')), false);
                $word = new Word;
                $word->word = $line;
                $word->translation = $json->translationText;
                $word->save();
                $wordsAddedCount++;
            } else {
                $wordsWithErrors++;
            }
        }
        if ($wordsWithErrors > 0) {
            Session::flash('error', "$wordsWithErrors words have been skipped due to errors.");
        }
        Session::flash('message', "$wordsAddedCount words have been added");
        return redirect('/admin/');
    }

    /*
     * Returns a url to the translation REST api
     * Default translation from English to Bulgarian
     * @Return string
     */
    public function getTranslationUrl($word, $to = 'bg', $from = 'en') {
        $url = "http://www.transltr.org/api/translate?text=$word&to=$to&from=$from";
        return $url;
    }

}
