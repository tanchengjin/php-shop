<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function setLang(string $lang)
    {
        if (in_array($lang, ['en', 'zh'])) {
            Session::put('lang', $lang);
        }
        return redirect()->back();
    }
}
