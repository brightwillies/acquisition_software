<?php

use App\Models\CheckPrice;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

if (!function_exists("generate_mask")) {
    function generate_mask()
    {
        return $uuid = (string) Str::orderedUuid();
    }
}
if (!function_exists("generate_random_password")) {
    function generate_random_password($min = 1111, $max = 9999999)
    {
        return rand($min, $max);
    }

}

if (!function_exists("generate_int_mask")) {
    function generate_int_mask($min = 1111, $max = 9999999)
    {
        return rand($min, $max);
    }

}

if (!function_exists("deleteItemOldImage")) {
    function deleteOldImage($filename, $folder)
    {
        $path = "/" . $folder . "/" . $filename;
        File::delete(public_path($path));
    }
}


if (!function_exists("generate_mask_string")) {
    function generate_mask_string($min = 1111, $max = 9999999)
    {
        return md5(uniqid(mt_rand($min, $max)));
    }
}

if (!function_exists("getMonth")) {
    function getMonth($name)
    {
        switch ($name) {
            case 1:
                return 'January';
                break;
            case 2:
                return 'February';
                break;
            case 3:
                return 'March';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'May';
                break;
            case 6:
                return 'June';
                break;
            case 7:
                return 'July';
                break;
            case 8:
                return 'August';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'October';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'December';
                break;

            default:
                # code...
                break;
        }
    }
}

function RespondQuote(
    CheckPrice $order

) {

    $message = "Hello $order->customer, $order->item_description be delivered at a cost of $order->total_fees . Thank you";
    sendSms($order->telephone_number, $message);

}

function CheckStatus(
    Order $order

) {
    switch ($order->status) {
        case 'assigned':
            $message = "Hello $order->customer, your order has been assigned to a rider. Thank you";
            sendSms($order->telephone_number, $message);
            break;
        case 'transit':
            $message = "Hello $order->customer, your item is in transit. Thank you.";
            sendSms($order->telephone_number, $message);
        case 'transit':
            $message = "Hello $order->customer, your package has been delivered successfully.Thank you";
            sendSms($order->telephone_number, $message);
            break;
        default:
            # code...
            break;
    }
}

function sendSms(
    // string $client_id,
    // string $client_secret,
    string $receiver,
    string $message

) {
    try {
        $client_user = 'dwapapabusiness@gmail.com';
        $client_password = 'Dwapapa@2023!!..';
        $sender = 'Dwapapa';
        // URL for sending message.
        $smsUrl = "http://api.smsonlinegh.com/sendsms.php";
        $user = urlencode($client_user);
        $password = urlencode($client_password);
        $message = urlencode($message);
        $sender = urlencode($sender);
        $type = 0;
        $destination = $receiver; // "0241726707,0504989952,0241492118";
        $params = "user={$user}&password={$password}&message={$message}" . "&type={$type}&sender={$sender}&destination={$destination}";
        $liveUrl = "{$smsUrl}?{$params}";
        return file_get_contents($liveUrl);
    } catch (Exception $e) {
        return null;
    }
}

function generateRandomCode()
{
    $currentYear = date('y'); // Get the current year in 2-digit format (e.g., 23 for 2023)
    $currentMonth = date('m'); // Get the current month in 2-digit format

    $randomPart = generateRandomString(4); // Generate a random 4-character string

    $randomCode = $currentYear . $currentMonth . $randomPart;
    $findItem = Order::where('tracking_id', $randomCode)->first();
    if (!$findItem) {
        return $randomCode;
    } else {
        return generateRandomCode();
    }

}

function generateRandomString($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $characterCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characterCount - 1)];
    }

    return $randomString;
}



if (!function_exists("uploadItemImage")) {
    function uploadItemImage($file, $name, $folder, $subfix = null)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = $file->getClientOriginalName();
        $originalName = Str::slug($name) . $subfix;
        $imageName = $originalName . '.' . $extension;
        $file->move(public_path($folder), $imageName);
        // Storage::disk('uploads')->put($imageName,$file);
        $url = url('/');
        $path = $url . '/' . $folder . '/' . $imageName;
        $result = new \stdClass();
        $result->filename = $imageName;
        $result->path = $path;
        $result->file_title = $fileName;
        return $result;
    }
}
