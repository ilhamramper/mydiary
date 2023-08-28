<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;

class EmojiController extends Controller
{
    public function index()
    {
        $emojis = Reaction::orderBy('created_at', 'desc')->get();
        return view('emoji.index', compact('emojis'));
    }

    public function create()
    {
        return view('emoji.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'unicode_hex' => 'required|unique:reactions,unicode_hex',
        ]);

        $unicodeHex = $validatedData['unicode_hex'];

        $emoji = Reaction::create([
            'unicode_hex' => $unicodeHex,
            'emoji' => html_entity_decode('&#' . hexdec(str_replace('U+', '', $unicodeHex)) . ';'),
        ]);

        return redirect()->route('emoji.index')->with('success', 'Emoji berhasil ditambahkan');
    }

    public function checkEmoji($unicodeHex)
    {
        $existingEmoji = Reaction::where('unicode_hex', $unicodeHex)->exists();
        return response()->json(['exists' => $existingEmoji]);
    }

    public function destroy($id)
    {
        $emoji = Reaction::findOrFail($id);
        $emoji->delete();

        return redirect()->route('emoji.index')->with('success', 'Emoji berhasil dihapus');
    }
}
