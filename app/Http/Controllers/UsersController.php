<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\User;
use App\Models\Payment;
use App\Models\Favourite;

use Validator;

class UsersController extends Controller
{
    
	protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
	        'age' => 'required|numeric|min:18',
        ]);
    }


	public function store (Request $request) {

		/* get requested data */
		$data = $request->all();

		if ( $this->validator ( $data ) ) {
			/* if validation pases insert user into database */
			$user = User::create( $data );
			if( $user ) {
	            return redirect('users/index')->with('message', 'User created successfully');
	        } else {
	            return redirect()
	                ->back()
	                ->withInput()
	                ->with('message', 'Error registering the user.');
	        }
		} 
	}

	public function edit (Request $request, $id) {

		$user = User::find( $id );
		$data = $request->all();

		if ( $this->validator ( $data ) ) {
			
			$user ->fill( $data );

			if( $user->save() ) {
	            return redirect('users/index')->with('message', 'User updated successfully');
	        } else {
	            return redirect()
	                ->back()
	                ->withInput()
	                ->with('message', 'Error updating the user.');
	        }
		} 
	}


	public function delete ( $id ) {

		$user = User::find( $id )->delete();
		return redirect('users/index')->with('message', 'User deleted successfully');

	}


}
