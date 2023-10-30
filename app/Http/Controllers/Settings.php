<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Settings extends Controller
{
  public function setLocale($locale)
  {
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
  }
}
