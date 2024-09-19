<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;


use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\FaqService;
use Illuminate\Support\Facades\Response;

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
    public function subscription(Request $request)
    {
        if (isset($_GET) && !empty($_GET['columns'])) {
            return response($this->MediaService->subscription());
        } else {
            return view('style/subscription');
        }
    }
    public function  subscriptionDelete(Request $request)
    {
        $ids = $request->input('id');
        $DeleteEmail = Subscription::findOrFail($ids);
        if ($DeleteEmail->delete()) {
            return response()->json(['success' => true, 'message' => 'Subscription deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete subscription.']);
        }
    }


    public function subscriptionExport(Request $request)
{

    $from = $request->from;
    $to = $request->to;

    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=subscription.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    );

    if($from && $to)
        $enquery = Subscription::whereBetween('created_at', [$from, $to])->get();
    elseif($from)
        $enquery = Subscription::whereDate('created_at', '>=', $from)->get();
    elseif($to)
        $enquery = Subscription::whereDate('created_at', '<=', $to)->get();
    else
        $enquery = Subscription::get();
    

    $columns = array('Email','Created');
    $callback = function() use ($enquery, $columns)
    {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);
        foreach($enquery as $row) {
            fputcsv($file, array($row->email, $row->created_at));
        }
        fclose($file);
    };
    return Response::stream($callback, 200, $headers);
}


}