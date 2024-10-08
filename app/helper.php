<?php

use Carbon\Carbon;
use Intervention\Image\Facades\Image;



if (!function_exists('whats_send')) {
    function whats_send($mobile, $message, $country_code)
    {

        // dd("ss");
        // 
        $mobile = $country_code . $mobile;
        // dd($mobile);
        $params = array(
            'token' => 'rouxlvet3m3jl0a3',
            'to' => $mobile,
            'body' => $message
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ultramsg.com/instance31865/messages/chat",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        // dd($err);
        curl_close($curl);
        return $response;
    }
}

if (!function_exists('send_sms_code_msg')) {
    function send_sms_code_msg($msg, $phone, $country_code)
    {
        $phone = $country_code . $phone;
        $url = "http://62.150.26.41/SmsWebService.asmx/send";
        $params = array(
            'username' => 'Electron',
            'password' => 'LZFDD1vS',
            'token' => 'hjazfzzKhahF3MHj5fznngsb',
            'sender' => '7agz',
            'message' => $msg,
            'dst' => $phone,
            'type' => 'text',
            'coding' => 'unicode',
            'datetime' => 'now'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $result = curl_exec($ch);

        if (curl_errno($ch) !== 0) {
            error_log('cURL error when connecting to ' . $url . ': ' . curl_error($ch));
        }

        // dd($result);
        curl_close($ch);

        // if ($result) {

        //   $status = "success";


        // } else {

        //  // echo $response;
        // }
        // return $status;

    }
}

if (!function_exists('send_sms_code')) {
    function send_sms_code($msg, $phone, $country_code)
    {

        // dd("Ff");
        $response = whats_send($phone, $msg, $country_code);
        //  dd($ff);
        return $response;

        //  send_sms_code_msg($msg, $phone, $country_code);
    }
}
/**
 * Upload Files
 * @path =>physical path to save files in
 * @image => name of file image in database
 * @realname =>real name file in db
 * @model => $model where to save files in
 * @request => the file input request which holds the file uploading 
 */

// if (!function_exists('UploadFiles')) {

//     function UploadFiles($path, $image, $realname, $model, $request)
//     {

//         $thumbnail = $request;
//         $destinationPath = $path;
//         $filerealname = $thumbnail->getClientOriginalName();
//         $filename = $model->id . time() . '.' . $thumbnail->getClientOriginalExtension();
//         // $destinationPath = asset($path) . '/' . $filename;
//         $thumbnail->move($destinationPath, $filename);
//         // $thumbnail->resize(1080, 1080);
//         //  $thumbnail = Image::make(public_path() . '/'.$path.'/' . $filename);
//         //Storage::move('public')->put($destinationPath, file_get_contents($thumbnail));

//         $model->$image = asset($path) . '/' . $filename;
//         $model->$realname = asset($path) . '/' . $filerealname;

//         $model->save();
//     }
// }



// function getLatLongFromUrl($url)
// {

//     $shortenerDomains = [
//         'bit.ly',
//         'goo.gl',
//         't.co',
//         'tinyurl.com',
//         'ow.ly',
//         'buff.ly',
//         'is.gd',
//         'tiny.cc',
//         'maps.app.goo.gl',
//         // 'gis.paci.gov.kw'
//     ];

//     // Parse the domain from the URL
//     $host = parse_url($url, PHP_URL_HOST);
//     if (in_array($host, $shortenerDomains) == true) {
//         $ch = curl_init();
//         // dd($ch);
//         curl_setopt($ch, CURLOPT_URL, $url);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
//         curl_exec($ch);
//         $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
//         curl_close($ch);
//     }

//     $pattern = '/@([-+]?[\d]*\.?[\d]+),([-+]?[\d]*\.?[\d]+)/';
//     preg_match($pattern, $url, $matches);
//     // dd($matches);
//     if (isset($matches[1]) && isset($matches[2])) {
//         return [
//             'latitude' => $matches[1],
//             'longitude' => $matches[2]
//         ];
//     }

//     return null;
// }


// function UploadFilesWithoutReal($path, $image, $model, $request)
// {

//     $thumbnail = $request;
//     $destinationPath = $path;
//     $filename = time() . '.' . $thumbnail->getClientOriginalExtension();
//     $thumbnail->move($destinationPath, $filename);

//     $model->$image = asset($path) . '/' . $filename;

//     $model->save();
// }
// function UploadFilesIM($path, $image, $model, $request)
// {

//     // dd($request);

//     $imagePaths = [];
//     $thumbnail = $request;
//     $destinationPath = $path;
//     foreach ($thumbnail as $key => $item) {
//         if (is_object($item)) {
//             $filename = $key . time() . '.' . $item->getClientOriginalExtension();
//             $item->move($destinationPath, $filename);
//             $imagePaths[] = asset($path) . '/' . $filename;
//         } else {
//             $imagePaths[] = $item;
//         }
//     }
//     // dd($model->image);
//     $model->$image = implode(',', $imagePaths);

//     $model->save();
// }


// function showUserDepartment()
// {
//     // Retrieve the authenticated user
//     $user = Auth::user();

//     // Access the department name
//     // dd($user->department);
//     $departmentName = $user->department != null ? ($user->department->name != null ? $user->department->name : 'القسم الرئيسي') : '';

//     return $departmentName;
// }






function formatTime($time)
{
    $to = Carbon::createFromFormat('H:i:s', $time)->format('h:i A');
    $toDay = str_replace(['AM', 'PM'], ['ص', 'م'], $to);
    return $toDay;
}



