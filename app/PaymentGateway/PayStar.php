<?php

namespace App\PaymentGateway;

class PayStar extends Payment
{
    public function send($amounts, $description, $addressId)
    {
        $string = $amounts['paying_amount'].'#12345'.'#http://localhost:8000/payment-verify/payStar';
        $secret = '9A3EC03483556C73714510C507529DF70A1228C83477D1455E0511BD72C5AAB8A6715A414AA48B7C905FCEF45868BD26DA58196EF29C77C194C9F14A4B47456CC6454E9D50B388D6FC5AC91BB08B234A8060FDC85B1CEC32CA036DC907F8A4A635D9CBB9CAA31B42549B8D70B2CE5EDE8274FFB55DABFE92D76BC42D91696FAF';
        $data = array(
            'order_id' => "12345",
            'amount' => $amounts['paying_amount'],
            'callback' => "http://localhost:8000/payment-verify/payStar",
            'sign' => hash_hmac('SHA512', $string, $secret),
            'callback_method' => 1
        );

//        dd($data);

        $jsonData = $data;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://core.paystar.ir/api/pardakht/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "amount": '.$jsonData['amount'].',
                "order_id":"'.$jsonData['order_id'].'",
                "callback":"'.$jsonData['callback'].'",
                "sign":"'.$jsonData['sign'].'",
                "callback_method":'.$jsonData['callback_method'].'
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 0yovdk2l6e143',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        $err = curl_error($curl);
        $result = json_decode($response, true);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            try {
                if ($result["status"] == 1) {
                    $createOrder = parent::createOrder($addressId, $amounts, $result['data']["token"], 'payStar', $result['data']['ref_num'], $jsonData['sign']);
                    if (array_key_exists('error', $createOrder)) {
                        return $createOrder;
                    }
//
                    return ['success' => 'https://core.paystar.ir/api/pardakht/payment' .'?token='. $result['data']["token"]];
                } elseif ($result['status'] == -1) {
                    return ['error' => 'درخواست نامعتبر (خطا در پارامترهای ورودی)'];
                }elseif ($result['status'] == -2) {
                    return ['error' => 'درگاه فعال نیست'];
                }elseif ($result['status'] == -3) {
                    return ['error' => 'توکن تکراری است'];
                }elseif ($result['status'] == -4) {
                    return ['error' => 'مبلغ بیشتر از سقف مجاز درگاه است'];
                }
            }catch (\Exception $exception) {
                dd($exception);
            }
        }
    }

    public function verify($authority, $amount, $sign)
    {
        $string = $amount.'#'.request('ref_num').'#'.request('card_number').'#'.request('tracking_code');
        $secret  = '9A3EC03483556C73714510C507529DF70A1228C83477D1455E0511BD72C5AAB8A6715A414AA48B7C905FCEF45868BD26DA58196EF29C77C194C9F14A4B47456CC6454E9D50B388D6FC5AC91BB08B234A8060FDC85B1CEC32CA036DC907F8A4A635D9CBB9CAA31B42549B8D70B2CE5EDE8274FFB55DABFE92D76BC42D91696FAF';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://core.paystar.ir/api/pardakht/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "amount":' . $amount . ',
                "ref_num":"' . request('ref_num') . '",
                "sign": "'.hash_hmac('SHA512', $string, $secret).'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 0yovdk2l6e143',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
//        echo $response;
        curl_close($curl);
        $err = curl_error($curl);
        $result = json_decode($response, true);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if ($result['status'] == 1) {
                $updateOrder = parent::updateOrder($result['data']['ref_num']);
                if (array_key_exists('error', $updateOrder)) {
                    return $updateOrder;
                }
                \Cart::clear();
                return ['success' => 'تراکنش موفق. ref_num:' . $result['data']['ref_num']];
            } elseif ($result['status'] == -5) {
                return ['error' => 'شناسه ref_num معتبر نیست'];
            } elseif ($result['status'] == -6) {
                return ['error' => 'تراکنش قبلا وریفای شده است'];
            } elseif ($result['status'] == -7) {
                return ['error' => 'پارامترهای ارسال شده نامعتبر است'];
            } elseif ($result['status'] == -8) {
                return ['error' => 'تراکنش را نمیتوان وریفای کرد'];
            } elseif ($result['status'] == -9) {
                return ['error' => 'تراکنش وریفای نشد'];
            } elseif ($result['status'] == -99) {
                return ['error' => 'خطای سامانه'];
            }
        }
    }
}
