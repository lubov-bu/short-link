<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\GetOriginalLinkRequest;
use App\Services\Link\LinkService;

class LinkController extends Controller
{
    public function __construct(
        private readonly LinkService $linkService
    ) {
    }

    public function createLink(CreateLinkRequest $request)
    {
        $userId = auth()->user() ? auth()->user()->id : null;

        $link = $this->linkService->createLink($request->get('link'), $userId);

        return response()->json(['shortLink' => $link]);
    }

    public function getOriginalLink(GetOriginalLinkRequest $request)
    {
        $link = $this->linkService->getOriginalLink($request->toDto());
        if (is_null($link)) {
            abort(404);
        }

        return redirect()->away($link->original_link);
    }
}
