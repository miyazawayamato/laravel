<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class ProfController extends Controller
{
//
    //プロフィール編集
    public function edit()
    {
        $id = Auth::id();
        $user = User::find($id);
        return view('profedit', ['user' => $user]);
    }
    
    public function nameEdit(Request $request)
    {
        $id = Auth::id();
        
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->save();
        
        return redirect()->route('p.edit');
    }
    
    public function profEdit(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            'prof' => 'max:300|string'
        ]);
        
        $user = User::findOrFail($id);
        $user->prof = $request->prof;
        $user->save();
        
        return redirect()->route('p.edit');
    }
    
    public function imageEdit(Request $request)
    {
        
        $id = Auth::id();
        $request->validate([
            'imagepass' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000', 'required']
        ]);
        
        // $path = $request->file('imagepass')->store('public/images');
        $path = $request->file('imagepass')->store('profimage', 's3');
        
        $user = User::findOrFail($id);
        $user->imagepass = $path;
        $user->save();
        
        //現在のあるなら削除
        if (!empty($request->curimage)) {
            
            Storage::delete($request->curimage);
        }
        
        return redirect()->route('p.edit');
    }
    
    public function imageDelete(Request $request)
    {
        $id = Auth::id();
        
        //現在のあるなら削除
        if (!empty($request->curimage)) {
            
            Storage::delete($request->curimage);
            $user = User::findOrFail($id);
            $user->imagepass = NULL;
            $user->save();
        }
        return redirect()->route('p.edit');
    }
    
}
