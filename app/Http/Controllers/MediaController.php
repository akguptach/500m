<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Services\FaqService;

class MediaController extends Controller
{
    public function __construct(protected MediaService $mediaservice)
    {
        $this->MediaService = $mediaservice;
    }

    public function index()
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->MediaService->getMedia());
        } else {
            return view('style/media');
        }
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:png,jpg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images/media'), $imageName);
            $imageBasePath = asset('images/media/' . $imageName);
            $media = new Media();
            $media->image = $imageBasePath;
            $media->save();
            return redirect()->back()->with('success', 'Image uploaded successfully!');
        }
        return redirect()->back()->with('error', 'No image uploaded!');
    }

   
    public function deleteMedia(Request $request)
    {
        $ids = $request->input('id');
        $mediaToDelete = Media::where('id', $ids)->get();
        foreach ($mediaToDelete as $media) {
            $imageName1 = $media->image;
            $imageName = str_replace(dirname($imageName1) . '/', '', $imageName1);
            $filePath = public_path('images/media/' . $imageName);

            if (File::exists($filePath)) {
                File::delete($filePath); // Delete the file from the server
            }
            $media->delete();
        }
        return response()->json(['success' => true, 'message' => 'Media deleted successfully.']);
    }
}
