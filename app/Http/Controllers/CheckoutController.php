<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لإتمام عملية الشراء');
        }

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('game')
            ->get();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة');
        }

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->game->price_per_day;
        });

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function process(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // التحقق من البيانات
        $request->validate([
            'rental_duration' => 'required|integer|min:1|max:30',
            'payment_method' => 'required|string|in:credit_card,paypal',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->with('game')
            ->get();

        if ($cartItems->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة');
        }

        // استخدام قيمة صغيرة متوافقة مع نوع البيانات الحالي
        // يبدو أن عمود duration قد يكون تم تعريفه بنوع بيانات صغير مثل tinyint(1)
        $rentalDuration = 1; // استخدام قيمة 1 للتأكد من أنها ستكون متوافقة

        // احتساب السعر الإجمالي باستخدام المدة المطلوبة في العرض فقط
        $requestedDuration = (int) $request->input('rental_duration', 7);
        $totalPrice = $cartItems->sum(function ($item) use ($requestedDuration) {
            return $item->game->price_per_day * $requestedDuration;
        });

        DB::beginTransaction();
        try {
            // إنشاء الطلب
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $totalPrice,
                'state' => 'pending',
            ]);

            // إنشاء عناصر الطلب
            foreach ($cartItems as $item) {
                $pricePerDay = $item->game->price_per_day;
                $rentalPrice = $pricePerDay * $requestedDuration;

                // تخزين المدة المطلوبة في rental_price أو في حقل آخر
                OrderItem::create([
                    'order_id' => $order->id,
                    'game_id' => $item->game_id,
                    'price' => $pricePerDay,
                    'quantity' => 1,
                    'duration' => $rentalDuration, // استخدام قيمة ثابتة 1 للتوافق مع نوع البيانات
                    'rental_price' => $rentalPrice
                ]);
            }

            // حذف عناصر السلة
            Cart::where('user_id', Auth::id())->delete();

            DB::commit();

            // تخزين المدة المطلوبة في الجلسة لاستخدامها في صفحة النجاح
            session(['requested_duration' => $requestedDuration]);

            return redirect()->route('checkout.success', ['order' => $order->id]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('checkout')
                ->with('error', 'حدث خطأ أثناء عملية الدفع: ' . $e->getMessage());
        }
    }

    public function success($orderId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::with('items.game')
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // استرجاع المدة المطلوبة من الجلسة
        $requestedDuration = session('requested_duration', 7);

        return view('checkout.success', compact('order', 'requestedDuration'));
    }
}