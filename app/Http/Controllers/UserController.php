<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //show register/create form
    public function create(){
        return view('users.register');
    }

    //create new user
    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required', 'min:3'],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'confirmed', 'min:6'],
            //'role'=>'required|in:user,admin'       //dodano
        ]);
        //dodano:
        $user = new User([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> bcrypt($request->input('password'))
            //'role'=>$request->role      
        ]);
        $user->save();
        //return response()->json(['message'=>'Successfully Created user'],201);
        //return view('users.login');
  

        //hash password
        //$formFields['password']=bcrypt($formFields['password']);

        //create user
        //$user=User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'Korisnik stvoren i prijavljen!');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Odjavljeni ste!');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //authenticate user
    public function authenticate(Request $request){
        $formFields=$request->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Prijavljeni ste!');
        }

        return back()->withErrors(['email'=>'Nevažeće vjerodajnice!'])
        ->onlyInput('email');
    }
      
    //manage users
    public function manage() {
        return view('users.manage', [
            // 'users' => User::all()
            'users' => User::where('id','!=', Auth::id())->get()
        ]);
    }

    // Show all users
    public function index()
{
    // $users = User::userr()->get();
    $users = User::all();

    return view('users.index')->with('users', $users); // <-- add "s" to User
}   

    //Show single user
    public function show(User $user) {
        return view('users.show', [
            'user' => $user
        ]);
    }
     //show edit form
     public function edit(User $user){
        return view('users.edit', ['user'=>$user]);
    }


    

    //delete user
    public function destroy(User $user) {
        if(!Auth::check()) {
            abort(403, 'Unauthorized Action');
        }
        
        $user->delete();
        return redirect('/')->with('message', 'Uspješno obrisano!');
    }

    //update User Data
    public function update(Request $request, User $user) {
        // Make sure logged-in user is the owner
        if(!Auth::check()) {
            abort(403, 'Unauthorized Action');
        }
    
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
    
        $user->update($formFields);
    
        return back()->with('message', 'Korisnik uspješno ažuriran!');
    }
}
