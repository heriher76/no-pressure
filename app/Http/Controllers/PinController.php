<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepinRequest;
use App\Http\Requests\UpdatepinRequest;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Pin;
use Inertia\Inertia;

class PinController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'pins' => Pin::all()->map( function ($pin) {
                return [
                    'title' => $pin->title,
                    'description' => $pin->description,
                    'user_name' => $pin->User->name
                ];
            })
        ]);
    }

    public function store(StorepinRequest $request)
    {
        Pin::create([
            'user_id' => Auth::user()->id,
            'title' => $request->pinTitle,
            'description' => $request->pinDescription,
        ]);

        
        return to_route('pins');
    }

    public function show(StorepinRequest $request)
    {
        return Inertia::render('Pins/Show', [
            'pin' => Pin::where('user_id', Auth::user()->id)->where('id', $request->id)->get()->map(function($pin){
                return [
                    'id' => $pin->id,
                    'title' => $pin->title,
                    'description' => $pin->description,
                    'user_name' => $pin->User->name,
                    'created_at' => date($pin->created_at),
                    'updated_at' => date($pin->updated_at)
                ];
            })
        ]);
    }

    public function edit(StorepinRequest $request)
    {
        return Inertia::render('Pins/Edit', [
            'pin' => Pin::where('user_id', Auth::user()->id)->where('id', $request->id)->get()->map(function($pin){
                return [
                    'id' => $pin->id,
                    'title' => $pin->title,
                    'description' => $pin->description,
                    'user_name' => $pin->User->name,
                    'created_at' => date($pin->created_at),
                    'updated_at' => date($pin->updated_at)
                ];
            })
        ]);
    }

    public function update(UpdatepinRequest $request)
    {
        $title = '';
        $description = '';

        $pins = Pin::where('user_id', Auth::user()->id)->where('id', $request->pinId)->get();

        if($request->pinTitle == '') {
            $title = $pins[0]['title'];
        } else { 
            $title = $request->pinTitle;
        }

        if($request->pinDescription == '') {
            $description = $pins[0]['description'];
        } else { 
            $description = $request->pinDescription;
        }


        Pin::where('id', $request->pinId)->update([
            'title' => $title,
            'description' => $description,
            'updated_at' => now(),
        ]);
    }

    public function destroy(StorepinRequest $request)
    {
        Pin::where('id', $request->id)->delete();
        return to_route('pins');
    }

    public function pins()
    {   
        return Inertia::render('Pins', [
            'pins' => Pin::where('user_id', Auth::user()->id)->get()->map(function($pin){
                return [
                    'id' => $pin->id,
                    'title' => $pin->title,
                    'description' => $pin->description,
                    'user_name' => $pin->User->name,
                    'created_at' => $pin->created_at,
                    'updated_at' => $pin->updated_at
                ];
            })
        ]);
    }
}
