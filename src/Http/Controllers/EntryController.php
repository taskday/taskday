<?php

namespace Taskday\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Taskday\Http\Requests\StoreEntryRequest;

class EntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEntryRequest  $request
     * @return Response
     */
    public function store(StoreEntryRequest $request)
    {
        $data = $request->validated();

        $entry = Auth::user()->createEntry($data['title']);

        return redirect()->back();
    }
}
