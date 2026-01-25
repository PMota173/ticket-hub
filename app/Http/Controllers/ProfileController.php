<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(UpdateProfileRequest $request)
    {
        $attributes = $request->validated();

        $user = auth()->user();

        if ($request->hasFile('avatar')) {

            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            // stores the image
            $path = $request->file('avatar')->store('avatars', 'public');

            // updates the attributes
            $attributes['avatar_path'] = $path;
        }
        unset($attributes['avatar']);

        $user->update($attributes);

        return redirect()->route('users.show', $user);
    }

    public function show(User $user)
    {
        $user->load(['teams' => function ($query) {
            $query->where('is_private', false);
        }]);

        return view('profile.show', compact('user'));
    }
}
