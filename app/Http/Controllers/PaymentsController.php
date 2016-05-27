<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\User;
use App\Models\Payment;

class PaymentsController extends Controller
{


	protected function validator(array $data)
    {
        return Validator::make($data, Payment::rules() );
    }

    public function registerPayment (Request $request) {

    	$data = $request->all();

    	if ( $this->validator( $data ) ) {
    		/* check for dead registers */
    		if ( !User::isDead( $data['user_id'] ) ) {
    			/* if user exist create de payment register */
    			$payment = Payment::create( $data );
				if( $payment ) {
		            return redirect('payment/index')->with('message', 'Payment created successfully');
		        } else {
		            return redirect()
		                ->back()
		                ->withInput()
		                ->with('message', 'Error registering the payment.');
		        }
    		}
    	}

    }

    public function editPayment (Request $request, $id) {

    	$payment = Payment::find( $id );
    	$data = $request->all();

    	if ( $this->validator( $data ) ) {

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

	public function getUserPayments ( $user_id ) {
		/* this get all registers plus the user model */
		$payments = Payment::where( 'user_id', $id )->with('user')->get();
		return view('cms/categories/create', ['payments' => $payments]);
	}

    
}
