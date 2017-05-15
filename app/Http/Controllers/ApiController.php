<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Word;

class ApiController extends Controller {

    private $statusError = "error";
    private $statusSuccess = "success";
    private $statusFail =  "fail";

    /**     * 
     * @param string $status
     * @param array $data
     * @param string $message
     * @param int $code
     * @return JSON
     */
    public function buildJsonResponse($status, $data = [], $message = '', $code = 200) {
        if ($status === $this->statusSuccess || $status === $this->statusFail ) {
            return response()->json([
                        "status" => $status,
                        "data" => $data
                            ], $code);
        } else {
            return response()->json([
                        "status" => $status,
                        "message" => $message,
                        "data" => $data
                            ], $code);
        }
    }
    /**
     * 
     * @param Request $request
     * @param string $word
     * @return Json
     */
    public function getWordInfo(Request $request, $word) {
        $word;
        try {
            $word = Word::where('word', $word)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return $this->buildJsonResponse($this->statusError, [], 'Word not found in database', 404);
        } catch (\Exception $e){
            return $this->buildJsonResponse($this->statusError, [], 'Service Unavailable', 500);
        }
        return $this->buildJsonResponse($this->statusSuccess, $word, '', 200);
    }
        
    /**
     * 
     * @param Request $request
     * @param int $limit
     * @param string $order
     * @return json
     */
    public function getAllWords(Request $request, $limit = 5, $order = 'ASC') {

        $words = [];
        try {
            $words = DB::table('words')
                    ->orderBy('id', $order)
                    ->take($limit)
                    ->get();
        } catch (\Exception $e) {
            return $this->buildJsonResponse($this->statusError, [], 'Unable to retrieve words', 404);
        }
        return $this->buildJsonResponse($this->statusSuccess, $words, '', 200);
    }

}
