<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sinners;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SinnersController extends Controller
{
    public function list(): View
    {
        $items = Sinners::orderBy('name', 'asc')->get();

        return view(
            'sinners.list', 
            [
            'title' => 'Sinners',
            'items'=> $items,
            ]
        );
    }

    public function create(): View
    {
        return view(
            'sinners.form',
            [
                'title' => 'Add a sinner',
                'sinners' => new Sinners()
            ]
        );
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        $sinners = new Sinners();
        $sinners->name = $validatedData['name'];
        $sinners->save();

        return redirect('/sinners');
    }

    public function update(sinners $sinners): View
    {
        return view(
            'sinners.form',
            [
                'title'=> 'Edit sinners',
                'sinners' => $sinners
            ]
        );
    }

    public function patch(Sinners $sinners, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        $sinners->name = $validatedData['name'];
        $sinners->save();

        return redirect('/sinners');

    }

    public function delete(sinners $sinners): RedirectResponse
    {
        $sinners->delete();
        return redirect('/authors');
    }
}
