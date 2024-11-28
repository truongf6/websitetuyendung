<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Payment_History;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function history(){
        $payments = Payment_History::where('user_id',Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('vnpay.history',compact('payments'),[
            'title' => 'Lịch sử thanh toán'
        ]);
    }
    public function Payment(Request $request)
    {
        $checkout = new Payment_History();
        $checkout->order_code =  substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
        $checkout->user_id = Auth::id();
        $checkout->amount_money = $request->amount_money;
        $user = User::find(Auth::user()->id);
        $user->money += $checkout->amount_money;
        $user->save();
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.complete', ['code' => $checkout->order_code, 'amount_money' => $request->amount_money]);
        $vnp_TmnCode = "17AY5EOG";
        $vnp_HashSecret = "1GJ1Z7RJW93EQMSV7NANEDLF8TXUBSKX";
        $code_cart = rand(00, 9999);
        $vnp_TxnRef = $code_cart;
        $vnp_OrderInfo = "Thanh toán đơn hàng test";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount =  $request->amount_money * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $checkout->save();
        header('Location: ' . $vnp_Url);
        die();
    }

    public function complete(Request $request, $code)
    {
        $maCode = $code;
        $amount_money = $request->query('amount_money');
        if ($maCode) {
            $checkout = Payment_History::where("order_code", $maCode)->first();
            if ($checkout) {
                if ($request->isMethod('get') && $request->filled('vnp_ResponseCode')) {
                    $checkout->BankCode = $request->input('vnp_BankCode');
                    $checkout->TransactionNo = $request->input('vnp_TransactionNo');
                    $checkout->vnp_BankTranNo = $request->input('vnp_BankTranNo');
                    $checkout->vnp_ResponseCode = $request->input('vnp_ResponseCode');
                    $checkout->save();
                    if($request->input('vnp_BankTranNo') == null) {
                        $check = false;
                    }
                }
            }
            if($request->input('vnp_BankTranNo') == null){
                return redirect()->route('home');
            }else{
                return view('vnpay.complete', compact("checkout", "amount_money"),[
                    'title' => 'Thanh toán thành công!'
                ]);
            }
        }
    }
}
