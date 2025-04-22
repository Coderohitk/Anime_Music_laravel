<?php

namespace App\Http\Controllers;

use App\Models\CharacterModel;
use Exception;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $data = CharacterModel::get();
        return view('characterslist', ['data' => $data]);
    }
    public function save(Request $request)
    {
        if(!$request->post()){
            return view('characterssave');
        }else{
            $message = 'Database error';
            
            $name = $request->name;
            $anime_id = $request->anime_id;
            $role = $request->role;
            $description = $request->description;
            $voice_actor_english = $request->voice_actor_english;
            $voice_actor_japanese = $request->voice_actor_japanese;
        

            // $target_dir = "../uploads/characters/covers/";
            // $relative_path = "/uploads/characters/covers/";

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
                    $userAdded = CharacterModel::create([
                        'name' => $name,
                        'anime_id' => $anime_id,
                        'description' => $description,
                        'role' => $role,
                        'image_url' => $image_url ?? '',
                        'voice_actor_english' => $voice_actor_english,
                        'voice_actor_japanese' => $voice_actor_japanese,
                    ]);
                }catch(Exception $e){
                    $message =  $e->getMessage();die;
                }
                if($userAdded){
                    set_message('New character added successfully.', 'success');
                    return redirect('/characters');
                }
                set_message($message, 'danger');
                return redirect('/characters/save');
            // }
        }
    }
    public function delete(Request $request)
    {
        $id = $request->id;

        $character = CharacterModel::where('character_id', $request->id)->first();
        
        if(!empty($character)){
            if(!empty($character->cover_image)){
                $image_path = "../" . ltrim($character->cover_image, "/");

                echo "DEBUG: Image path: <code>$image_path</code><br>";

                if (file_exists($image_path)) {
                    
                    unlink($image_path);
                } 
            }
            set_message('Music Removed', 'success');
            CharacterModel::where('character_id', $request->id)->delete();
        }
        return redirect('characters');
    }
    public function update(Request $request)
    {
        if(!$request->post()){
            $character = CharacterModel::where('character_id', $request->id)->first();
            return view('charactersupdate', ['character'=>$character]);
        }else{
            $message = 'Database error';
            
            
            $id = $request->post("character_id");
            $name = $request->name;
            $anime_id = $request->anime_id;
            $description = $request->description;
            $voice_actor_english = $request->voice_actor_english;
            $voice_actor_japanese = $request->voice_actor_japanese;
            $role = $request->role; // New field
            

            // $target_dir = "../uploads/characters/covers/";
            // $relative_path = "/uploads/characters/covers/";
        
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
                    $characterAdded = CharacterModel::where('character_id',$id)->update([
                        'name' => $name,
                        'anime_id' => $anime_id,
                        'description' => $description,
                        'role' => $role,
                        'image_url' => $image_url ?? '',
                        'voice_actor_english' => $voice_actor_english,
                        'voice_actor_japanese' => $voice_actor_japanese,
                    ]);
                    if($characterAdded){
                        set_message('Character updated successfully.', 'success');
                        return redirect('/characters');
                    }else{
                        set_message('Character not updated.', 'danger');
                        return redirect('/characters/update/'.$request->id);
                    }
            }catch(Exception $e){
                $message =  $e->getMessage();
            }
            set_message($message, 'danger');
            return redirect('/characters/update/'.$request->id);
        }
    }
}