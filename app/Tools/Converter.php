<?php

namespace App\Tools;
use AmrShawky\LaravelCurrency\Facade\Currency;

class Converter
{
    /**
     * Convert USD to authenticated user currency
     * @param  float $amount
     * @param  string $to, from
     *
     * @return float
     */
    // public static function currencyConverter_($amount, $to, $from = 'USD')
    // {
    //     $content = file_get_contents(
    //         "https://api.exchangerate.host/convert?from=$from&to=$to&amount=$amount"
    //     );

    //     $respost = json_decode($content, true);
    //     $price = $respost['result'];

    //     return number_format($price, 2);
    // }

    public static function currencyLatestPrice()
    {
        $content = file_get_contents('https://api.exchangerate.host/latest');

        $respost = json_decode($content, true);

        return $respost['rates'];
    }

    // public static function currencyConverter__($amount, $to, $from = 'USD')
    // {
    //     $result = Currency::convert()
    //         ->from($from)
    //         ->to($to)
    //         ->amount($amount)
    //         ->get();

    //     return number_format($result, 2);
    // }
    // public static function currencyLatestPrice()
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => 'https://api.apilayer.com/exchangerates_data/latest?&base=USD',
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: text/plain',
    //             'apikey: 4q9PiWU98i1Fk3AW6YZZTlRfOmtDcwcI',
    //         ],
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //     ]);

    //     $response = curl_exec($curl);
    //     $respost = json_decode($response, true);

    //     curl_close($curl);
    //     return $respost['rates'];
    // }

    // public static function currencyConverter($amount, $to, $from = 'USD')
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, [
    //         CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/convert?to=$to&from=$from&amount=$amount",
    //         CURLOPT_HTTPHEADER => [
    //             'Content-Type: text/plain',
    //             'apikey: 4q9PiWU98i1Fk3AW6YZZTlRfOmtDcwcI',
    //         ],
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'GET',
    //     ]);

    //     $response = curl_exec($curl);
    //     $respost = json_decode($response, true);
    //     // print_r($respost['result']);

    //     curl_close($curl);
    //     return number_format($respost['result'], 2);
    // }

    /**
     * Returns the currency code
     * @param  $currencySymbol
     *
     * @return string
     */
    public static function getSymbol($currencySymbol)
    {
        return $currencySymbol;
    }

    public static function convert_into_base64($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION); #Get product image type
        $data = file_get_contents($path); #Get the product image
        $imageBase64 = "data:image/$type;base64," . base64_encode($data); #Convert product image to base64
        return "$imageBase64";
    }
    /**
     * Get the price of the monero in the last 60 minutes
     * @param string $currency
     *
     * @return float
     */
    public static function moneroLastPrice()
    {
        #Get the last price in 60 minutes and set the cache
        // $price = \Cache::remember('xmr_last_price', 3600, function () {
        //     $content = file_get_contents(
        //         'https://min-api.cryptocompare.com/data/price?fsym=XMR&tsyms=USD'
        //     );
        //     $respost = json_decode($content, true);

        //     return $respost['USD'];
        // });

       // return $price;
         return 147.84;
    }

    /**
     * Takes the Monero price in real time and divides it by the value (USD) that is being passed as a parameter
     * @param float $amount
     *
     * @return float
     */
    public static function moneroConverter($amount)
    {
        $content = file_get_contents(
            'https://min-api.cryptocompare.com/data/price?fsym=XMR&tsyms=USD'
        );
        $respost = json_decode($content, true);
        $moneroPrice = $respost['USD'];

        return number_format($amount / $moneroPrice, 5);
        // return number_format($amount / 147.84, 5);
    }

    /**
     * takes the price from the seller's fee, converts it to Monero and holds that amount for one hour.
     *
     * @return float
     */
    public static function getSellerFee()
    {
        $sellerFee = \Cache::remember('seller_fee', 3600, function () {
            return self::moneroConverter(config('general.seller_fee'));
        });

        return $sellerFee;
    }

    public static function getMinBidFee()
    {
        $minbidFee = \Cache::remember('minbid_fee', 3600, function () {
            return self::moneroConverter(config('general.minbid_fee'));
        });

        return $minbidFee;
    }

    public static function generateQRCode($address)
    {
        return 'https://www.bitcoinqrcodemaker.com/api/?style=monero&prefix=on&address=' .
            $address;
    }
}