<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::orderBy('created_at', 'desc')
            ->whereNull('deleted_at')
            ->get();
        return view('diary.index', compact('diaries'));
    }

    public function trash()
    {
        $diaries = Diary::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->get();
        return view('trash.index', compact('diaries'));
    }

    public function create()
    {
        $emojis = Reaction::all();
        return view('diary.create', compact('emojis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'emoji' => 'nullable|integer|exists:reactions,id',
        ]);

        $diary = new Diary();
        $diary->title = $request->input('title');
        $diary->content = $request->input('content');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('diary_images', 'public');
            $diary->image = $imagePath;
        }

        $selectedEmojiId = $request->input('emoji');
        $reaction = Reaction::find($selectedEmojiId);

        if ($reaction) {
            $diary->unicode_hex = $reaction->unicode_hex;
        }

        $diary->save();

        return redirect()->route('diary.index')->with('success', 'Diary berhasil ditambahkan');
    }

    public function edit($id)
    {
        $diary = Diary::findOrFail($id);
        $emojis = Reaction::all();
        return view('diary.edit', compact('diary', 'emojis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'emoji' => 'nullable|integer|exists:reactions,id',
        ]);

        $diary = Diary::findOrFail($id);
        $diary->title = $request->input('title');
        $diary->content = $request->input('content');
        $diary->updated_at = now();

        if ($request->hasFile('image')) {
            if ($diary->image) {
                Storage::disk('public')->delete($diary->image);
            }
            $imagePath = $request->file('image')->store('diary_images', 'public');
            $diary->image = $imagePath;
        }

        $selectedEmojiId = $request->input('emoji');
        $reaction = Reaction::find($selectedEmojiId);

        if ($reaction) {
            $diary->unicode_hex = $reaction->unicode_hex;
        }

        $diary->save();

        return redirect()->route('diary.index')->with('success', 'Diary berhasil diperbarui');
    }

    public function destroy($id)
    {
        $diary = Diary::findOrFail($id);
        $diary->delete();

        return redirect()->route('diary.index')->with('success', 'Diary berhasil dihapus');
    }

    public function restore($id)
    {
        Diary::withTrashed()->where('id', $id)->restore();

        return redirect()->route('diary.trash')->with('success', 'Diary berhasil dipulihkan');
    }

    public function forceDelete($id)
    {
        $diary = Diary::withTrashed()->findOrFail($id);
        if ($diary->image) {
            Storage::disk('public')->delete($diary->image);
        }
        $diary->forceDelete();

        return redirect()->route('diary.trash')->with('success', 'Diary berhasil dihapus secara permanen');
    }
}  
