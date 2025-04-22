<?php

namespace App\Http\Controllers;

use App\Models\MusicModel;
use Exception;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = MusicModel::get();
        return view('musiclist', ['data' => $data]);
    }
    public function save(Request $request)
    {
        if(!$request->post()){
            return view('musicsave');
        }else{
            $message = 'Database error';
            
            $title = $request->title;
            $artist = $request->artist;
            $album = $request->album;
            $genre = $request->genre;
            $release_year = (int) $request->release_year;

            // $target_dir = "../uploads/music/covers/";
            // $relative_path = "/uploads/music/covers/";

            // if (!is_dir($target_dir)) {
            //     mkdir($target_dir, 0777, true);
            // }

            // $file = $_FILES["cover_image"];
            // $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];

            // if ($file["error"] !== UPLOAD_ERR_OK) {
            //     die("❌ Upload error: " . $file["error"]);
            // }

            // if (!in_array($file["type"], $allowed_types)) {
            //     die("❌ Invalid file type: " . $file["type"]);
            // }

            // $unique_name = uniqid() . "_" . basename($file["name"]);
            // $target_file = $target_dir . $unique_name;
            // $cover_image = $relative_path . $unique_name;

            // if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            //     die("❌ Failed to save uploaded image.");
            // }
                try{
                    $userAdded = MusicModel::create([
                        'title' => $title,
                        'artist' => $artist,
                        'release_year' => $release_year,
                        'album' => $album,
                        'cover_image' => $db_file_path ?? '',
                        'genre' => $genre,
                    ]);
                }catch(Exception $e){
                    $message =  $e->getMessage();die;
                }
                if($userAdded){
                    set_message('New music added successfully.', 'success');
                    return redirect('/music');
                }
                set_message($message, 'danger');
                return redirect('/music/save');
            // }
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        $music = MusicModel::where('music_id', $request->id)->first();
        
        if(!empty($music)){
            if(!empty($music->cover_image)){
                $image_path = "../" . ltrim($music->cover_image, "/");

                echo "DEBUG: Image path: <code>$image_path</code><br>";

                if (file_exists($image_path)) {
                    
                    unlink($image_path);
                } 
            }
            set_message('Music Removed', 'success');
            MusicModel::where('music_id', $request->id)->delete();
        }
        return redirect('music');
    }
    public function update(Request $request)
    {

        if(!$request->post()){
            $music = MusicModel::where('music_id', $request->id)->first();
            return view('musicupdate', ['music'=>$music]);
        }else{
            $message = 'Database error';
            
            $id = $request->post("music_id");
            $title = $request->title;
            $artist = $request->artist;
            $album = $request->album;
            $genre = $request->genre;
            $release_year = (int) $request->release_year;

            // $target_dir = "../uploads/music/covers/";
            // $relative_path = "/uploads/music/covers/";
        
            // if (!is_dir($target_dir)) {
            //     mkdir($target_dir, 0777, true);
            // }
        
            // $cover_image = $_POST["existing_image"];
        
            // if (!empty($_FILES["cover_image"]["name"])) {
            //     $file = $_FILES["cover_image"];
            //     $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        
            //     if ($file["error"] !== UPLOAD_ERR_OK) {
            //         die("❌ Upload error: " . $file["error"]);
            //     }
        
            //     if (!in_array($file["type"], $allowed_types)) {
            //         die("❌ Invalid file type: " . $file["type"]);
            //     }
        
            //     $unique_name = uniqid() . "_" . basename($file["name"]);
            //     $target_file = $target_dir . $unique_name;
            //     $cover_image = $relative_path . $unique_name;
        
            //     if (!move_uploaded_file($file["tmp_name"], $target_file)) {
            //         die("❌ Failed to upload new cover image.");
            //     }
            // }

            try{
                    $userAdded = MusicModel::where('music_id',$id)->update([
                        'title' => $title,
                        'artist' => $artist,
                        'release_year' => $release_year,
                        'album' => $album,
                        'cover_image' => $cover_image ?? '',
                        'genre' => $genre,
                    ]);
                    if($userAdded){
                        set_message('Music updated successfully.', 'success');
                        return redirect('/music');
                    }
            }catch(Exception $e){
                $message =  $e->getMessage();die;
            }
            set_message($message, 'danger');
            return redirect('/music/update/'.$request->id);
        }
    }
}