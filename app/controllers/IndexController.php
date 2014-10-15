<?php

class IndexController extends BaseController {

    /*
     * Show main page with list of android libraries
     */
    public function showIndex()
    {
        $this->data['page'] = 'libs';
        $oCats = Categories::all();
        // Select likes and group them by their categories - order them by their like count
        $oTopCats = Like::with('category')
            ->selectRaw('*, COUNT(category_id) AS likes')
            ->groupBy('category_id')
            ->orderByRaw('COUNT(category_id) DESC')
            ->take(5)
            ->get();

        $aLibs = Libraries::with('categories', 'likes')->select('*')->where('public','=', true)->limit(12)->orderBy('id', 'desc')->get();
        $libraries = $this->prepareLibrary($aLibs);


        $this->data["libraries"]        = $libraries;
        $this->data["categories"]       = $oCats;
        $this->data["oTopCategories"]   = $oTopCats;
        $this->data["oRandomLibs"]      = Libraries::where('public', '=', true)->limit(5)->orderByRaw('RAND()')->get();
        return View::make("index", $this->data);
    }

    /*
     * Shows the submit library page
     */
    public function showSubmit()
    {
        $this->data['oCategories'] = Categories::all();
        return View::make('submit', $this->data);
    }

    /*
     * Get more libraries and return json
     */
    public function loadMoreLibraries()
    {
        //Get all Libs
        $lastIndex  = Input::get('lastIndex');
        $aLibs      = Libraries::select('*')->where('public','=', true)->where('featured', '=', false)->skip($lastIndex)->limit(8)->orderBy('id', 'desc')->get()->toArray();
        $libraries  = $this->prepareLibrary($aLibs, $lastIndex);
        return json_encode($libraries);
    }

    /*
     * Search all libraries by name and return json for ajax loaded content
     */
    public function searchLibrary()
    {
        // Find all libraries that are public and where the search query is contained in
        $aLibs = Libraries::where('public','=', true)->where(function($sqlQuery) {
            $query = Input::get("query");
            $sqlQuery->where("title", "LIKE", "%" . $query . "%");
            $sqlQuery->orWhere("short_desc", "LIKE", "%" . $query . "%");
            $sqlQuery->orWhere("long_desc", "LIKE", "%" . $query . "%");
        })->get()->toArray();
        return json_encode($this->prepareLibrary($aLibs));
    }

    /*
     * Set the rating of a library
     */
    function rateLibrary($id, $stars)
    {
        $oLib = Libraries::find($id);
        $fRating = ( ($oLib->rated_times * $oLib->rating) + $stars) / ($oLib->rated_times + 1);
        $oLib->rating = $fRating;
        $oLib->rated_times += 1;
        $oLib->save();
        return json_encode(["rating" => round($fRating) ]);
    }

    /*
     * Prepare libraries
     */
    public static function prepareLibrary($aLibs)
    {
        $y = 0;
        $x = 0;
        $index = Input::get('lastIndex', 0);
        $libraries = [];
        foreach($aLibs as $lib)
        {
            if($x == 3) {
                $x = 0;
                $y++;
            }

            $lib["index"] = $index;

            if(strlen($lib["title"]) > 20)
                $lib["title"] = substr($lib["title"], 0, 20) . " " . substr($lib["title"], 20, strlen($lib["title"]));
            $lib["rating"] = round(floatval($lib["rating"]));
            $libraries[$y][$x] = $lib;
            $x++;
        }
        return $libraries;
    }




}