<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function getShow()
  {
    $user = auth()->user();
    //dd($user['id']);
    return view('pages.admin.profile.show', compact('user'));
  }

  public function getEdit() {

    $user = auth()->user();
    return view('pages.admin.profile.edit', compact('user'));
  }

  public function postUpdate(Request $request, User $user)
  {
    $image = $request->file('image');
    $path_image = $image->store('profile', "public");
    
    
    $user->image = $path_image;
    $user->name = $request['name'];
    $user->lastname = $request['lastname'];
    $user->gender = $request['gender'];
    $user->email = $request['email'];

    $user->save();

    return redirect()->route('Admin-ProfileGetShow');
  }




  public function postDestroy($id)
  {
    $user = User::find($id);

    if ($user) {
      $user->delete();
    }

    return view('pages.admin.profile.show');
  }
}
