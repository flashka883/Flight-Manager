<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->name = $request->get('name');
        $user->description = $request->get('description');
        if ($request->get('email')) {
            $user->email = $request->get('email');
        }
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        if ($request->get('avatar')) {
            $imageName = $this->updateImage($request->get('avatar'), $user->avatar);
            $user->avatar = $imageName;
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' =>  $e->getMessage()
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Profile successfully updated'
        ]);
    }

    public function updateImage($image, $previousImage)
    {
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = md5(rand(11111, 99999)) . '_' . time() . '.' . 'png';

        $path = public_path('/images/avatars/') . $imageName;
        $input = File::put($path, base64_decode($image));
        $image = Image::make($path)->resize(300, 300);
        $result = $image->save($path);

        if ($previousImage != 'default.png') {
            unlink(public_path('/images/avatars/' . $previousImage));
        }

        return $imageName;
    }
}
