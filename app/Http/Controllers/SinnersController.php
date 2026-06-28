<?php

namespace App\Http\Controllers;

use App\Models\Sinners;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class SinnersController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Sinners::orderBy('name', 'asc')->get();

        return view('sinners.list', [
            'title' => 'Sinners',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('sinners.form', [
            'title' => 'Add a sinner',
            'sinners' => new Sinners(),
        ]);
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sinners = new Sinners();
        $sinners->name = $validatedData['name'];
        $sinners->save();

        return redirect('/sinners');
    }

    public function update(Sinners $sinners): View
    {
        return view('sinners.form', [
            'title' => 'Edit sinner',
            'sinners' => $sinners,
        ]);
    }

    public function patch(
        Sinners $sinners,
        Request $request
    ): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $sinners->name = $validatedData['name'];
        $sinners->save();

        return redirect('/sinners');
    }

    public function delete(Sinners $sinners): RedirectResponse
    {
        $sinners->delete();

        return redirect('/sinners');
    }
}