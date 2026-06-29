<?php

namespace App\Http\Controllers;

use App\Models\Sinners;
use App\Models\IDs;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\IDsRequest;

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

    // Validate and save ID data
    private function saveIDsData(IDs $ids, IDsRequest $request): void
    {
        $validatedData = $request->validated();

        $ids->fill($validatedData);
        $ids->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            // šeit varat pievienot kodu, kas nodzēš veco bildi, ja pievieno jaunu
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();

            $ids->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $ids->save();
    }

    // Create new ID entry
    public function put(IDsRequest $request): RedirectResponse
    {
        $ids = new IDs();

        $this->saveIDsData($ids, $request);

        return redirect('/ids');
    }

    // Update ID data
    public function patch(IDs $ids, IDsRequest $request): RedirectResponse
    {
        $this->saveIDsData($ids, $request);

        return redirect('/ids/update/' . $ids->id);
    }

    // Delete IDs
    public function delete(IDs $ids): RedirectResponse
    {
        if ($ids->image) {
            unlink(getcwd() . '/images/' . $ids->image);
        }

        $ids->delete();

        return redirect('/ids');
    }
}