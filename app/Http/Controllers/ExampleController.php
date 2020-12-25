<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;
use Symfony\Component\HttpFoundation\Response;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function test()
    {
        $basePath = base_path('public');
        
        $zhFont = $basePath . "/font/AdobeHeitiStd-Regular.otf";
        $enFont = $basePath . "/font/Helvetica Bold.ttf";
        $enSecFont = $basePath . "/font/Helvetica.ttf";

        $bgImage = $basePath . "/images/bg.jpg";
        $headImage = $basePath . "/images/head.jpg";
        $qrcodeImage = $basePath . "/images/qrcode.jpg";

        $image = Image::make($bgImage);

        $image->insert($headImage, 'bottom-right', 15, 10);
        
        $image->text('测试中文的字体', 100, 300, function($font) use($zhFont){
            $font->file($zhFont);
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
        });
        
        $image->text('2020-02-02', 100, 200, function($font) use($enSecFont){
            $font->file($enSecFont);
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
        });

        $image->text('10:00:00', 100, 100, function($font) use($enFont){
            $font->file($enFont);
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
        });

        $image->encode();

        return Response::create($image, 200, ['Content-Type' => 'image/jpeg']);
    }
}
