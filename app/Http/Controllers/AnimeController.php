<?php

namespace App\Http\Controllers;

use App\Models\AnimeModel;
use Exception;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function home(Request $request){
        
        if ($request->post() && $request->post('anime_id')) {
            $anime_id = $request->anime_id;
            $anime = AnimeModel::where('anime_id', $anime_id)->first();
            $newStatus = !$anime->is_favourite;
            AnimeModel::where('anime_id', $anime_id)->update(['is_favourite'=> $newStatus]);
            return redirect('home');
        }else{
            $anime_result = AnimeModel::get();
            return view('home', ['anime_result'=> $anime_result]);
        }

    }
    public function index(Request $request)
    {
        $data = AnimeModel::get();
        return view('animelist', ['data' => $data]);
    }
    public function save(Request $request)
    {
        if(!$request->post()){
            return view('animesave');
        }else{
            $message = 'Database error';
            $title = $request->post("title");
            $description = $request->post("description");
            $release_year = $request->post("release_year");
            $genre = $request->post("genre");
            $rating = $request->post("rating");

            $target_dir = "../uploads/anime/"; // One level up from this file
            $relative_path = "uploads/anime/";

            // Create the uploads directory if it doesn't exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Debug: check if folder is writable
            // if (!is_writable($target_dir)) {
            //     die("❌ Error: Upload folder is not writable! Please check folder permissions.");
            // }

            // $file = $request->file("cover_image");
            // $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            // // Debug: check for upload errors
            // if ($file["error"] !== UPLOAD_ERR_OK) {
            //     $errors = [
            //         UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds upload_max_filesize.",
            //         UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds MAX_FILE_SIZE in HTML form.",
            //         UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            //         UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            //         UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            //         UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            //         UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
            //     ];
            //     die("❌ Upload error: " . ($errors[$file["error"]] ?? "Unknown error (" . $file["error"] . ")"));
            // }

            // if (!in_array($file["type"], $allowed_types)) {
            //     die("❌ Invalid file type: " . $file["type"]);
            // }

            // // Generate a unique name
            // $unique_name = uniqid() . "_" . basename($file["name"]);
            // $target_file = $target_dir . $unique_name;
            // $db_file_path = $relative_path . $unique_name;

            // if (move_uploaded_file($file["tmp_name"], $target_file)) {
                // Upload success — insert into DB
                try{
                    $userAdded = AnimeModel::create([
                        'title' => $title,
                        'description' => $description,
                        'release_year' => $release_year,
                        'rating' => $rating,
                        'cover_image' => $db_file_path ?? '',
                        'genre' => $genre,
                    ]);
                }catch(Exception $e){
                    $message =  $e->getMessage();die;
                }
                if($userAdded){
                    set_message('New anime added successfully.', 'success');
                    return redirect('/anime');
                }
                set_message($message, 'danger');
                return redirect('/anime/save');
            // }
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        $anime = AnimeModel::where('anime_id', $request->id)->first();
        
        if(!empty($anime)){
            if(!empty($anime->cover_image)){
                $image_path = "../" . ltrim($anime->cover_image, "/");

                echo "DEBUG: Image path: <code>$image_path</code><br>";

                if (file_exists($image_path)) {
                    
                    unlink($image_path);
                } 
            }
            set_message('Anime Removed', 'success');
            AnimeModel::where('anime_id', $request->id)->delete();
        }
        return redirect('anime');
    }
    public function update(Request $request)
    {

        if(!$request->post()){
            $anime = AnimeModel::where('anime_id', $request->id)->first();
            return view('animeupdate', ['anime'=>$anime]);
        }else{
            $message = 'Database error';
            
            $id = $request->post("anime_id");
            $title = $request->post("title");
            $description = $request->post("description");
            $release_year = $request->post("release_year");
            $genre = $request->post("genre");
            $rating = $request->post("rating");

            $target_dir = "../uploads/anime/";
            $relative_path = "uploads/anime/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Start with existing image
            $cover_image = $request->post("existing_image");
            // if (!empty($request->file("cover_image")->originalName)) {
            //     $file = $request->file("cover_image");
            //     $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            //     if ($file->error !== UPLOAD_ERR_OK) {
            //         $errors = [
            //             UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds upload_max_filesize.",
            //             UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds MAX_FILE_SIZE in HTML form.",
            //             UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
            //             UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            //             UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            //             UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            //             UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload.",
            //         ];
            //         die("❌ Upload error: " . ($errors[$file->error] ?? "Unknown error"));
            //     }

            //     if (!in_array($file->mimeType, $allowed_types)) {
            //         die("❌ Invalid file type: " . $file->mimeType);
            //     }

            //     $unique_name = uniqid() . "_" . basename($file->originalName);
            //     $target_file = $target_dir . $unique_name;
            //     $cover_image = $relative_path . $unique_name;

            //     if (!move_uploaded_file($file->fileName, $target_file)) {
            //         die("❌ Failed to save uploaded image.");
            //     }
            // }

            try{
                    $userAdded = AnimeModel::where('anime_id',$id)->update([
                        'title' => $title,
                        'description' => $description,
                        'release_year' => $release_year,
                        'rating' => $rating,
                        'cover_image' => $cover_image ?? '',
                        'genre' => $genre,
                    ]);
                    if($userAdded){
                        set_message('Anime updated successfully.', 'success');
                        return redirect('/anime');
                    }
            }catch(Exception $e){
                $message =  $e->getMessage();die;
            }
            set_message($message, 'danger');
            return redirect('/anime/update/'.$request->id);
        }
    }
}