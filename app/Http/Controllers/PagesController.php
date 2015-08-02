<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class PagesController extends BaseController {
    
    public $appName; //Name of our app
    
    public function __construct() {
        //parent::__construct(); //Controller is abstract, has no constructor
        $this->appName = config('app.app_name');
    }
    
    public function home() {
        $data = array(
            'pageTitle' => $this->appName,
            'appName' => $this->appName
        );
        return view('welcome')->with($data);
    }

    public function dashboard() {
        $data = array(
            'pageTitle' => $this->appName . " - Dashboard",
            'appName' => $this->appName
        );
        return view('dashboard')->with($data);
    }
}
