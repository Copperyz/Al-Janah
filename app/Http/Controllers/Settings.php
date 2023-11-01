<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Settings extends Controller
{
  public function setLocale($locale)
  {
    if (!in_array($locale, ['en', 'fr', 'de', 'pt', 'ar'])) {
      abort(400);
    } else {
        session()->put('locale', $locale);
    }

    App::setLocale($locale);
    return redirect()->back();
  }
}