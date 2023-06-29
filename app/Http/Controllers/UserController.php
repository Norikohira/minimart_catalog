<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const LOCAL_STORAGE_FOLDER = 'public/images/';

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function profile()
    {
        $user = Auth::user(); 
        return view('products.profile')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'mimes:jpg,jpeg,png,gif|max:1048' // フィールド名を 'image' から 'photo' に修正する
        ]);

        $user = User::findOrFail($id); // 正しい変数名に修正する
        
        // 新しい写真がある場合
        if ($request->hasFile('photo')) { // $request->photo から $request->hasFile('photo') に修正する
            // 以前の画像を削除
            $this->deletePhoto($user->photo);

            // 新しい画像を保存
            $user->photo = $this->savePhoto($request);
        }

        $user->save();
        return redirect()->back();
    }

    private function savePhoto($request)
    {
        // Change the name of the image to the CURRENT TIME to avoid overwriting
        $image_name = time() . "." . $request->photo->extension();

        // Save the image inside the local storage ~~ storage/app/public/images
        $request->photo->storeAs(self::LOCAL_STORAGE_FOLDER, $image_name);
        // storeAs(destination, file_name) ~~ used to store the uploaded file/image
        
        return $image_name;
    }

    private function deletePhoto($image_name)
    {
        $image_path = self::LOCAL_STORAGE_FOLDER . $image_name;
        
        if(Storage::disk('local')->exists($image_path)){
            Storage::disk('local')->delete($image_path);
        }
    }

}
