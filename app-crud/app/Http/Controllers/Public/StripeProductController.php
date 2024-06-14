<?php
namespace App\Http\Controllers\Public; // ! ensure the namespace reflects the directory structure

use App\Http\Controllers\Controller; // ! Import the base Controller class
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeProductController extends Controller
{
   protected $stripe;

   public function __construct()
   {
      Stripe::setApiKey(env('STRIPE_SECRET'));

      $stripe_secret = env('STRIPE_SECRET');

      $this->stripe = new StripeClient(config('services.stripe.secret'));
   }

   public function index()
   {
      try {
         // Fetch all products from Stripe
         $products = $this->stripe->products->all(['limit' => 100]);
         $prices = $this->stripe->prices->all(['limit' => 100]);

         // Combine products and prices
         $product_data = [];
         
         foreach ($products->data as $product) {
             $product_prices = array_filter($prices->data, function ($price) use ($product) {
                 return $price->product === $product->id;
             });

             $product_data[] = [
                 'product' => $product,
                 'prices' => $product_prices
             ];
         }
         
         // return data to view
         return view('public.index', ['product_data' => $product_data]);


         // * output raw JSON data (if desired)
         return response()->json([
            'success' => true,
            'data' => $product_data,
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
               'success' => false,
               'message' => $e->getMessage(),
         ], 500);
      }
   }

   
   public function prices() {
      try {
         // Fetch all products from Stripe
         $prices = $this->stripe->prices->all();

         return response()->json([
               'success' => true,
               'data' => $prices,
         ], 200);
      } catch (\Exception $e) {
         return response()->json([
               'success' => false,
               'message' => $e->getMessage(),
         ], 500);
      }
   }


   public function checkout(Request $request)
   {
      //$stripePriceId = 'price_1PQjfzP3S64d6hFrQX9lay43'; // only banana works for some reason
      $quantity = 1;

      // get stripe_price_id from query string parameters
      $stripePriceId = $request->get('stripe_price_id');
  
      // set Stripe API key
      Stripe::setApiKey(env('STRIPE_SECRET'));
  
      try {
          $session = Session::create([
              'payment_method_types' => ['card'],
              'line_items' => [[
                  'price' => $stripePriceId,
                  /*
                  'price_data' => [
                      'currency' => 'usd',
                      'unit_amount' => $quantity * 1000,
                      'product_data' => [
                          'name' => 'Deluxe Album',
                      ],
                  ],
                  */
                  'quantity' => $quantity,
              ]],
              'mode' => 'payment',
              'success_url' => route('checkout-success'),
              'cancel_url' => route('checkout-cancel'),
          ]);
  
          return new RedirectResponse($session->url);
      } catch (\Exception $e) {
          return back()->withErrors(['error' => $e->getMessage()]);
      }
   }


   public function checkoutWithAuth()
   {
      $stripePriceId = 'price_deluxe_album';
      $quantity = 1;
      return $request->user()->checkout([$stripePriceId => $quantity], [
         'success_url' => route('checkout-success'),
         'cancel_url' => route('checkout-cancel'),
      ]);
   }
}