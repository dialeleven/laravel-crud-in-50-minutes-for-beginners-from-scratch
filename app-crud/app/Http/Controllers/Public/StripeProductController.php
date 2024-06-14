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
         $products = $this->stripe->products->all();

         return view('public.index', ['products' => $products]);

         return response()->json([
               'success' => true,
               'data' => $products,
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
}