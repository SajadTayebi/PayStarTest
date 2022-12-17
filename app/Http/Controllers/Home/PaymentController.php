<?php

namespace App\Http\Controllers\Home;

use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\PaymentGateway\Pay;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\PaymentGateway\PayStar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'payment_method' => 'required',
            'card_number' => 'required'
        ]);

        if (Auth::user()->card_number != $request->card_number){
            alert()->error('شماره کارت وارد شده با شماره کارت ثبت شده مطابقت ندارد.', 'خطا')->persistent('حله');
            return redirect()->back();
        }

        if ($validator->fails()) {
            alert()->error('مشکلی در ثبت سفارش وجود دارد', 'دقت کنید')->persistent('حله');
            return redirect()->back();
        }

        $checkCart = $this->checkCart();
        if (array_key_exists('error', $checkCart)) {
            alert()->error($checkCart['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }

        $amounts = $this->getAmounts();
        if (array_key_exists('error', $amounts)) {
            alert()->error($amounts['error'], 'دقت کنید');
            return redirect()->route('home.index');
        }


        if ($request->payment_method == 'payStar') {
            if ($request->payment_method == 'payStar') {
                $payStarGateway = new PayStar();
                $payStarGatewayResult = $payStarGateway->send($amounts, 'خرید تستی', $request->address_id);
                if (array_key_exists('error', $payStarGatewayResult)) {
                    alert()->error($payStarGatewayResult['error'], 'دقت کنید')->persistent('حله');
                    return redirect()->back();
                } else {
                    return redirect()->to($payStarGatewayResult['success']);
                }
            }
        }

        alert()->error('درگاه پرداخت انتخابی اشتباه میباشد', 'دقت کنید');
        return redirect()->back();
    }

    public function paymentVerify(Request $request, $gatewayName)
    {
        if ($gatewayName == 'payStar') {
            $amounts = $this->getAmounts();
            $sign = Transaction::where('ref_num', $request->ref_num)->first()->sign;
            if (array_key_exists('error', $amounts)) {
                alert()->error($amounts['error'], 'دقت کنید');
                return redirect()->route('home.index');
            }

            if (isset($request->card_number) && isset($request->tracking_code)) {
                $payStarGateway = new PayStar();
                $payStarGatewayResult = $payStarGateway->verify($request->ref_num, $amounts['paying_amount'], $sign);
            }else{
                alert()->error('تراکنش ناموفق');

                return redirect()->route('home.index');
            }

            if (array_key_exists('error', $payStarGatewayResult)) {
                alert()->error($payStarGatewayResult['error'], 'دقت کنید')->persistent('حله');
                return redirect()->back();
            } else {
                alert()->success($payStarGatewayResult['success'], 'با تشکر');
                return redirect()->route('home.index');
            }
        }

        alert()->error('مسیر بازگشت از درگاه پرداخت اشتباه می باشد', 'دقت کنید');
        return redirect()->route('home.orders.checkout');
    }

    public function checkCart()
    {
        if (\Cart::isEmpty()) {
            return ['error' => 'سبد خرید شما خالی می باشد'];
        }

        foreach (\Cart::getContent() as $item) {
            $variation = ProductVariation::find($item->attributes->id);

            $price = $variation->is_sale ? $variation->sale_price : $variation->price;

            if ($item->price != $price) {
                \Cart::clear();
                return ['error' => 'قیمت محصول تغییر پیدا کرد'];
            }

            if ($item->quantity > $variation->quantity) {
                \Cart::clear();
                return ['error' => 'تعداد محصول تغییر پیدا کرد'];
            }

            return ['success' => 'success!'];
        }
    }

    public function getAmounts()
    {
        if (session()->has('coupon')) {
            $checkCoupon = checkCoupon(session()->get('coupon.code'));
            if (array_key_exists('error', $checkCoupon)) {
                return $checkCoupon;
            }
        }

        return [
            'total_amount' => (\Cart::getTotal()),
            'delivery_amount' => cartTotalDeliveryAmount(),
            'coupon_amount' => session()->has('coupon') ? session()->get('coupon.amount') : 0,
            'paying_amount' => cartTotalAmount()
        ];
    }
}
