<?php
namespace App\Cp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Image;
class ImageProcessor{


    /**
     * asset file path
     *
     * @return $path
     */
    public static function filePath(){

        $path['admin_profile'] = [
            'path'=>'assets/images/admin/profile',
            'size'=>'35x35'
        ];
        $path['user_profile'] = [
            'path'=>'assets/images/user/profile',
            'size'=>'35x35'
        ];
        $path['flags'] = [
            'path'=>'assets/images/general/flags',
            'size'=>'25x20'
        ];
        $path['mail_footer'] = [
            'path'=>'assets/images/general/mailFooter',
            'size'=>'150x150'
        ];
        $path['category'] = [
            'path'=>'assets/images/general/category',
            'size'=>'100x100'
        ];

        $path['pages'] = [
            'path'=>'assets/images/general/pages',
            'size'=>'1305x500'
        ];
        $path['blog'] = [
            'path'=>'assets/images/general/blog',
            'size'=>'900x450'
        ];
        $path['newsLatter'] = [
            'path'=>'assets/images/general/newsLatter',
            'size'=>'666x200'
        ];
        $path['links'] = [
            'path'=>'assets/images/general/links',
            'size'=>'220x125'
        ];
        /* ads section start */
        $path['floating'] = [
            'path'=>'assets/images/general/ads',
            'size'=>'300x200'
        ];
        $path['banner_right'] = [
            'path'=>'assets/images/general/ads',
            'size'=>'315x450'
        ];
        $path['blog_right'] = [
            'path'=>'assets/images/general/ads',
            'size'=>'315x350'
        ];
        $path['banner_ads'] = [
            'path'=>'assets/images/general/ads',
            'size'=>'1305x150'
        ];
        /* ads section end */


        $path['frontend'] = [
        'path'=>'assets/images/frontend',
        ];

        $path['favicon'] = [
        'path' => 'assets/images/general/favIcon',
        'size' => '16x16',
        ];
        $path['logo'] = [
            'path' => 'assets/images/general/webLogo',
            'size' => '250x60',
        ];
        
        $path['country'] = [
            'path'=>'assets/images/general/country',
            'size'=>'100x100'
        ];
        $path['service_category'] = [
            'path'=>'assets/images/general/service_category',
            'size'=>'100x100'
        ];
        $path['service'] = [
            'path'=>'assets/images/general/service',
            'size'=>'100x100'
        ];
        $path['package'] = [
            'path'=>'assets/images/general/package',
            'size'=>'100x100'
        ];
        $path['manual_payment'] = [
            'path'=>'assets/images/general/manual_payment',
            'size'=>'100x100'
        ];
        $path['support_ticket'] = [
            'path'=> 'assets/images/general/support_ticket',
        ];

        return $path;
    }

    /**
     * upload  a specific file
     *
     * @param $file ,$keyName
     */
     public static function uploadFile($file, $keyName){


        $fileInfo =  self::filePath()[$keyName];

        $location =  $fileInfo['path'];
        if(!file_exists($location)){
              mkdir($location, 0755, true);
        }

        $filename =uniqid().time().'.'.$file->getClientOriginalExtension();

        $image = Image::make(file_get_contents($file));

        $image->save($location.'/'.$filename);
        return $filename;
    }

    /**
     * delete a specific file
     *
     * @param $file ,$keyName
     */
    public static function deleteFile($file, $keyName){
        $fileInfo =  self::filePath()[$keyName];
        $location =  $fileInfo['path'];
        if(file_exists($location.'/'.$file) && is_file($location.'/'.$file)){
            @unlink($location.'/'.$file);
        }
    }

    /**
     * make default image by size
     *
     * @param $size
     */
    public static function createImage($size){
        $width = explode('x',$size)[0];
        $height = explode('x',$size)[1];
        $image = imagecreate($width, $height);
        $fontFile = realpath('assets/backend-assets/font').DIRECTORY_SEPARATOR.'RobotoMono-Regular.ttf';
        if($width > 100 && $height > 100){
            $fontSize = 30;
        }else{
            $fontSize = 5;
        }
        $text = $width . 'X' . $height;
        $backgroundcolor = imagecolorallocate($image, 237, 241, 250);;
        $textcolor    = imagecolorallocate($image, 107, 111, 130);
        imagefill($image, 0, 0, $textcolor);
        $textsize = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textsize[4] - $textsize[0]);
        $textHeight = abs($textsize[5] - $textsize[1]);
        $xx = ($width - $textWidth) / 2;
        $yy = ($height + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $xx, $yy, $backgroundcolor , $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }




}
