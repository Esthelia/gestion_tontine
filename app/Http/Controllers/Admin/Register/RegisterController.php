<?php

namespace App\Http\Controllers\Admin\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    public function getShow()
    {

        return view('pages.admin.register.show');
    }



    public function postStore(RegisterRequest $request)
    {
    try { 

        $image = $request->file('image');
        $path_image = $image->store('register', "public");
        
        $user = new User();
        $user->firstOrCreate([
            'uuid' => Uuid::uuid4(),
            'image' => $path_image,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('Auth-RegisterGetShow')->with('success', 'Utilisateur créé avec succès !, Connectez-vous Maintenant');

    } catch (\Exception $e) {    
        
        return back()->withErrors(['error' => 'Email ou mot de passe incorrect.'. $e->getMessage()]);
      }
    }

    public function getEdit(User $user) {

        return view('pages.admin.register.edit', compact('user'));
      }
    
    public function postUpdate(Request $request, User $user)
    {
        $image = $request->file('image');
        $path_image = $image->store('register', "public");

        $user->image = $path_image;
        $user->name = $request['name'];
        $user->lastname = $request['lastname'];
        $user->gender = $request['gender'];
        $user->email = $request['email'];
        $user->password = Hash::make($request->password);
        
        $user->save();

        return redirect()->route('Admin-ProfileGetShow');
    }

    public function postDestroy($id )
    {
        $user = User::findOrFail($id);

        if ($user) {
        $user->delete();
        }

        return redirect()->route('Admin-ProfileGetShow');
        
    }
}
