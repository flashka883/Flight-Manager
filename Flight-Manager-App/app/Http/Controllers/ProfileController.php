<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

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

        if (!$user) {
            return back()->withErrors(['msg' => 'You should be logged in to procceed.']);
        }

        if ($user->name != $request->get('name')) {
            $user->name = $request->get('name');
        }
        if ($user->first_name != $request->get('first_name')) {
            $user->first_name = $request->get('first_name');
        }
        if ($user->last_name != $request->get('last_name')) {
            $user->last_name = $request->get('last_name');
        }
        if ($user->last_name != $request->get('last_name')) {
            $user->last_name = $request->get('last_name');
        }
        if ($user->address != $request->get('address')) {
            $user->address = $request->get('address');
        }
        if ($user->phone != $request->get('phone')) {
            $user->phone = $request->get('phone');
        }
        if ($user->egn != $request->get('egn')) {
            $isDuplicate = User::where('egn', $request->get('egn'))->first();
            if ($isDuplicate) {
                return back()->withErrors(['msg' => 'The egn is taken']);
            }

            $user->egn = $request->get('egn');
        }
        if ($user->email != $request->get('email')) {
            $isDuplicate = User::where('email', $request->get('email'))->first();
            if ($isDuplicate) {
                return back()->withErrors(['msg' => 'The email is taken']);
            }
            $user->email = $request->get('email');
        }
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }
        // if ($request->get('avatar')) {
        //     $imageName = $this->updateImage($request->get('avatar'), $user->avatar);
        //     $user->avatar = $imageName;
        // }

        try {
            $user->save();
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Could not save profile.']);
        }

        return back()->with(['msg' => 'Profile successfully updated.']);
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
