<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function getAllUsers(){
        return User::all('id','firstname','lastname','mobile','postcode','email');
    }

    public function getUser(User $user){

    }

    public function createUser(Request $request){
        $user = new User();
        return $user->create($request->all());


    }

    public function updateUser(Request $request){

        // instantiate User model
        $user = new User;

        //$this->validator($request->all());
        // find and update the user
        $user = $user->findOrFail($request->id);
        $updateStatus = $user->update([
            'firstname' => $request->firstname,
            'lastname'  => $request->lastname,
            'mobile'    => $request->mobile,
            'postcode'  => $request->postcode,
            'email'     => $request->email,
        ]);

        // Check if update is successful
        //if($updateStatus)

        // return only selected columns
        return $user;

    }

    public function deleteUser(Request $request){
        $users = $request->all();
        foreach($users as $user){
            $user = (object)$user;
            $user->id;

            $deleteStatus = $this->delete($user->id);
            if(!$deleteStatus){ // if false return BadRequest
                return BadRequestHttpException::class;
            }
        }

        $countUsers = count($users);
        $statement = ( $countUsers > 1) ? "$countUsers users" : "user";
        return ["status"    =>  "Successfully deleted ".$statement] ;

    }

    private function delete($id){
        try {
            $user = new User;
            $user->findOrFail($id)->delete();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function validator(array $data){
        return Validator::make($data,[
            'firstname' =>  'required|string|max:255',
            'lastname'  =>  'required|string|max:255',
            'mobile'    =>  'required|string|max:20',
            'postcode'  =>  'string|max:255',
            'email'     =>  'unique:users|email',
        ]);
    }

}
