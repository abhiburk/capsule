<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Capsule;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index()
    {
        $publicCapsules = Capsule::where('visibility', true)->withCount('letters')->paginate(6);
        $myCapsules = auth()->user()->capsules()->count();
        $myLetters = auth()->user()->letters()->count();
        return view('home', compact('publicCapsules', 'myCapsules', 'myLetters'));
    }
}
