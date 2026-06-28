<?php

namespace App\Http\Controllers;

use App\Models\Sinners;
use App\Models\IDs;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class IDsController extends Controller implements HasMiddleware
{
    // Call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    // Display all IDs
    public function list(): View
    {
        $items = IDs::orderBy('name', 'asc')->get();

        return view('ids.list', [
            'title' => 'IDs',
            'items' => $items,
        ]);
    }

    // Display new ID form
    public function create(): View
    {
        $sinners = Sinners::orderBy('name', 'asc')->get();

        return view('ids.form', [
            'title' => 'Add ID',
            'ids' => new IDs(),
            'sinners' => $sinners,
        ]);
    }

    // Create new ID entry
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'sinner_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);

        $ids = new IDs();
        $ids->name = $validatedData['name'];
        $ids->sinner_id = $validatedData['sinner_id'];
        $ids->description = $validatedData['description'];
        $ids->price = $validatedData['price'];
        $ids->year = $validatedData['year'];
        $ids->display = (bool) ($validatedData['display'] ?? false);
        $ids->save();

        return redirect('/ids');
    }

    // Display ID edit form
public function update(IDs $ids): View
{
    $sinners = Sinners::orderBy('name', 'asc')->get();

    return view('ids.form', [
        'title' => 'Edit ID',
        'ids' => $ids,
        'sinners' => $sinners,
    ]);
}

    // Update ID data
    public function patch(
        IDs $ids,
        Request $request
    ): RedirectResponse {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:256',
            'sinner_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);

        $ids->name = $validatedData['name'];
        $ids->sinner_id = $validatedData['sinner_id'];
        $ids->description = $validatedData['description'];
        $ids->price = $validatedData['price'];
        $ids->year = $validatedData['year'];
        $ids->display = (bool) ($validatedData['display'] ?? false);
        $ids->save();

        return redirect('/ids/update/' . $ids->id);
    }

    // delete IDs
    public function delete(IDs $ids): RedirectResponse
    {
        $ids->delete();
        return redirect('/IDs');
    }
}