<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\OrderController;
use App\Providers\shoppingCart;

/* use class paypal SDK  */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Amount;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\PaymentExecution;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct(){
        $payPalConfig= Config::get('paypal');

        print_r($payPalConfig);

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret'],
            )
        );
    }

    public function payWithPaypal(){
        // After Step 2

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal(ShoppingCartController::ShowTotalShoppingCart($shopping_cart_id)/3779);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $callBackUrls = url('paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callBackUrls)
            ->setCancelUrl($callBackUrls);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            
            return redirect()->away($payment->getApprovalLink());
        }
        catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING

            return redirect('home/shoppingcart')
                ->with('mensaje_error','Error No se pudo conectar a PSE');
        }
    }
    public function payPalStatus(Request $request){
        $paymentID = $request->input('paymentId');
        $token = $request->input('token');
        $PayerID = $request->input('PayerID');

        if(!$paymentID || !$token || !$PayerID){
            return redirect('home/shoppingcart')
                ->with('mensaje_error','Error No se pudo procesar el pago de PSE');
        }

        $payment = Payment::get($paymentID, $this->apiContext);
        
        $execution = new PaymentExecution();
        $execution->setPayerId($PayerID);

        $result = $payment->execute($execution, $this->apiContext);

        if($result->getState() === 'approved'){
            $status = $result->getState();
            ShoppingCartController::PaidCart($status);
            OrderController::createOrder();

            \Session::forget('shopping_cart_id');
            return redirect('home/shoppingcart')
                ->with('mensaje','Se realizo el pago con PSE con exito');
        }

        return redirect('home/shoppingcart')
        ->with('mensaje_error','Lo sentimos, no se pudo pagar atravez de PSE');
    }   
}