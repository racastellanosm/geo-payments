<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FavoritesController extends Controller
{
    public function registerFavorites (Request $request) {

    	$data = $request->all();

		/* check for dead registers */
		if ( !User::isDead( $data['user_id'] ) ) {
			/* if user exist create de payment register */
			$favorite = Favourite::create( $data );
			if( $favorite ) {
	            return redirect('favorite/index')->with('message', 'favorite created successfully');
	        } else {
	            return redirect()
	                ->back()
	                ->withInput()
	                ->with('message', 'Error registering the favorite.');
	        }
		}
    }

    public function editPayment (Request $request, $id) {

    	$payment = Favourite::find( $id );
    	$data = $request->all();

		$payment->fill( $data );

		if( $payment->save() ) {
            return redirect('payment/index')->with('message', 'Payment updated successfully');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'Error updating the payment.');
        }
    }

}
