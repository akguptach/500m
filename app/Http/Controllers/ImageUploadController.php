<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Example: Apply authentication middleware to all methods

        // Exclude specific routes from CSRF verification
        $this->middleware('web', ['except' => ['uploadImage']]);
    }


     public function upload(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $image = $request->file('upload');

                // Validate file type, size, etc. if necessary

                // Move the file to the 'public/images/media' directory
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/ckeditor'), $imageName);

                // Generate the URL for accessing the uploaded file
                $imageBasePath = asset('images/ckeditor/' . $imageName);

                // Prepare CKEditor 5 file upload response
                $response = [
                    'uploaded' => 1,
                    'fileName' => $imageName,
                    'url' => $imageBasePath
                ];

                // Return JSON response
                return response()->json($response);
            } else {
                throw new \Exception('No file uploaded.');
            }
        } catch (\Exception $e) {
            // Handle exceptions and return error response
            return response()->json(['error' => ['message' => $e->getMessage()]], 400);
        }
    }
}
