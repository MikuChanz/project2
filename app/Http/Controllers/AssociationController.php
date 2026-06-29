<?php

namespace App\Http\Controllers;

use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class AssociationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Association::orderBy('name', 'asc')->get();

        return view('association.list', [
            'title' => 'Associations',
            'items' => $items,
        ]);
    }

    public function create(): View
    {
        return view('association.form', [
            'title' => 'Add association',
            'association' => new Association(),
        ]);
    }

    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $association = new Association();
        $association->name = $validatedData['name'];
        $association->save();

        return redirect('/associations');
    }

    public function update(Association $association): View
    {
        return view('association.form', [
            'title' => 'Edit association',
            'association' => $association,
        ]);
    }

    public function patch(
        Association $association,
        Request $request
    ): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $association->name = $validatedData['name'];
        $association->save();

        return redirect('/associations');
    }

    public function delete(Association $association): RedirectResponse
    {
        $association->delete();

        return redirect('/associations');
    }
}