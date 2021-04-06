<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLang($language){
        App::setLocale($language);
        Session::put("language",$language);
        return redirect()->back();
    }
}
