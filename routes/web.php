<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\SomeController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'auth'],function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   // Route::view(uri: 'profile', view:'profile')->(name: 'profile');
   Route::view('profile', 'profile')->name('profile');
   //Route::put('profile', 'ProfileController@update')->name('profile.update');
   
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');


});
 
    
    require __DIR__.'/auth.php';

    
    
    //fetch all user
    //$user=DB::select("select * from users");
    //$user=DB::table("users")->get();
    //$users=User::where('id',1)->first();
    //$users=User::all();
    //$users=User::get();
    // $users=User::find(13);


    //create a new user
    // $user=DB::insert('insert into users(username,email,password) values (?,?,?)',['harmy1','harmy1@gmail.com','147852369']);
    // $user=DB::table("users")->insert([
    //     'username' => 'harmy2',
    //     'email' => 'harmy2@gmail.com',
    //     'password' => '1234567890'
    // ]);
    // $user=User::create([
    //      'username' => 'harmyyyy',
    //      'email' => 'harmy5@gmail.com',
    //      'password' =>'1234567890'
    // ]);
    
    //update a value
    //$users = DB::update("update users set username = 'parv' where id = 4");
    //$users=DB::table("users")->where('id',5)->update(['username'=>'parrv']);
    // $user=User::find(6);
    // $user->update(['username'=>'parrv']);

    //delete a user
   //$users = DB::delete('delete from users where id=4');
   //$users =DB::table("users")->where('id',5)->delete();
        // $user=User::find(1);
        // $user->delete();

        
        //dd($user);
       //dd($users->username);

 
//Route::view("about",'about');
//Route::view("contact",'contact');

