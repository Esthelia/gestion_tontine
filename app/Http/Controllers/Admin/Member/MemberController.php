<?php

namespace App\Http\Controllers\Admin\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
  public function getShow() {
    
  try {  
      $user = auth()->user();
      $members = Member::where('user_id', $user->id)->get();
      return view('pages.admin.member.show', compact('members'));
      
      } catch (\Exception $e) {    
          
        return back()->withErrors(['error' => 'Une erreur est survenue:.'. $e->getMessage()]);
      }  
  }

  public function getIndex($id) {

    $member = Member::find($id);
    return view('pages.admin.member.detail', compact('member'));

  }


  public function getCreate() {
     
    $members = Member::all();
     return view('pages.admin.member.create', compact('members'));  
  }


  public function postStore(Request $request) {

    //     $image = $request->file('image');
    //     $path_image = $image->store('member', "public");
        
    //     $member = new Member();
    //     $member->firstOrCreate([
    //         'user_id' => Auth::id(),
    //         'contribution_id' => $request->contribution_id ?? 0,
    //         'image' => $path_image,
    //         'fullname' => $request->fullname,
    //         'phone' => $request->phone,
    //         'geo_location' => $request->geo_location,
    //         'gender' => $request->gender,
    //     ]);


    // return redirect()->route('Admin-MemberGetShow');







    // Validation des données du formulaire
    $request->validate([
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Type et taille maximale de l'image
      'fullname' => 'required|string|max:255',
      'phone' => 'required|string|regex:/^\+?[0-9]{10,15}$/', // Numéro de téléphone valide
      'geo_location' => 'required|string|max:255',
      'gender' => 'required|in:homme,femme', // Assurez-vous que le genre est valide
      'contribution_id' => 'nullable|exists:contributions,id', // Vérifiez que l'ID de contribution existe si fourni
  ], [
      'image.required' => 'L\'image est obligatoire.',
      'image.image' => 'Le fichier doit être une image.',
      'image.mimes' => 'L\'image doit être de type jpeg, png, jpg, ou gif.',
      'image.max' => 'L\'image ne doit pas dépasser 2 Mo.',
      'fullname.required' => 'Le nom complet est obligatoire.',
      'fullname.string' => 'Le nom complet doit être une chaîne de caractères.',
      'fullname.max' => 'Le nom complet ne peut pas dépasser 255 caractères.',
      'phone.required' => 'Le numéro de téléphone est obligatoire.',
      'phone.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
      'phone.regex' => 'Le numéro de téléphone doit être valide (10 à 15 chiffres).',
      'geo_location.required' => 'La localisation géographique est obligatoire.',
      'geo_location.string' => 'La localisation géographique doit être une chaîne de caractères.',
      'geo_location.max' => 'La localisation géographique ne peut pas dépasser 255 caractères.',
      'gender.required' => 'Le genre est obligatoire.',
      'gender.in' => 'Le genre doit être "homme", "femme".',
      'contribution_id.exists' => 'L\'ID de contribution fourni n\'existe pas.',
  ]);

  // Traitement de l'image
  $image = $request->file('image');
  $path_image = $image->store('member', 'public');
  
  // Création ou mise à jour du membre
  $member = new Member();
  $member->firstOrCreate([
      'user_id' => Auth::id(),
      'contribution_id' => $request->contribution_id ?? 0,
      'image' => $path_image,
      'fullname' => $request->fullname,
      'phone' => $request->phone,
      'geo_location' => $request->geo_location,
      'gender' => $request->gender,
  ]);

  // Redirection ou réponse après la création du membre
  return redirect()->route('Admin-MemberGetShow')->with('success', 'Membre ajouté avec succès.');
  }

  public function getEdit(Member $member) {

    return view('pages.admin.member.edit', compact('member'));
  }

  public function postUpdate(Request $request, Member $member)
  {
      $image = $request->file('image');
      $path_image = $image->store('cars', "public");

      $member->image = $path_image;
      $member->fullname = $request['fullname'];
      $member->phone = $request['phone'];
      $member->geo_location = $request['geo_location'];
      $member->gender = $request['gender'];
      
      $member->save();

      return redirect()->route('Admin-MemberGetShow');
  }

  public function postDestroy($id )
  {
      $member = Member::findOrFail($id);

      if ($member) {
      $member->delete();
      }

      return redirect()->route('Admin-MemberGetShow');
  }
}
