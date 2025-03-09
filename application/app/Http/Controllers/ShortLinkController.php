<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $urls = ShortLink::all();
        return view('short_links.index', compact('urls'));
    }

    public function create()
    {
        return view('short_links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url',
            'short_url' => 'nullable|unique:short_links,short_url',
            'title' => 'nullable|string|max:255',
        ]);

        $url = new ShortLink();
        $url->original_url = $request->original_url;
        $url->short_url = $request->short_url ?: Str::random(6); //Generate short link.
        $url->title = $request->title;
        $url->save();

        return redirect()->route('short_links.index');
    }

    public function edit(ShortLink $shortLink)
    {
        return view('short_links.edit', compact('shortLink'));
    }

    public function update(Request $request, ShortLink $shortLink)
    {
        $request->validate([
            'original_url' => 'required|url',
            'short_url' => 'nullable|unique:short_links,short_url,' . $shortLink->id,
            'title' => 'nullable|string|max:255',
        ]);

        $shortLink->original_url = $request->original_url;
        $shortLink->short_url = $request->short_url ?: $shortLink->short_url;
        $shortLink->title = $request->title;
        $shortLink->save();

        return redirect()->route('short_links.index');
    }

    public function destroy(ShortLink $shortLink)
    {
        $shortLink->delete();
        return redirect()->route('short_links.index');
    }

    public function redirect($shortUrl)
    {
        $url = ShortLink::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('clicks'); // Increment counter.
        return redirect($url->original_url);
    }

}
