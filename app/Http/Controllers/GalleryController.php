<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $gender = $request->query('gender', 'all');

        $images = [
            ['url' => 'images/women1.jpg', 'gender' => 'women'],
            ['url' => 'images/women2.jpg', 'gender' => 'women'],
            ['url' => 'images/women3.jpg', 'gender' => 'women'],
            ['url' => 'images/women4.jpg', 'gender' => 'women'],
            ['url' => 'images/women5.jpg', 'gender' => 'women'],
            ['url' => 'images/women6.jpg', 'gender' => 'women'],
            ['url' => 'images/women7.jpg', 'gender' => 'women'],
            ['url' => 'images/women8.jpg', 'gender' => 'women'],
            ['url' => 'images/women9.jpg', 'gender' => 'women'],
            ['url' => 'images/women10.jpg', 'gender' => 'women'],
            ['url' => 'images/women11.jpg', 'gender' => 'women'],
            ['url' => 'images/women12.jpg', 'gender' => 'women'],
            ['url' => 'images/women13.jpg', 'gender' => 'women'],
            ['url' => 'images/women14.jpg', 'gender' => 'women'],
            ['url' => 'images/women15.jpg', 'gender' => 'women'],
            ['url' => 'images/women16.jpg', 'gender' => 'women'],
            ['url' => 'images/women17.jpg', 'gender' => 'women'],
            ['url' => 'images/women18.jpg', 'gender' => 'women'],
            ['url' => 'images/men1.jpg', 'gender' => 'men'],
            ['url' => 'images/men2.jpg', 'gender' => 'men'],
            ['url' => 'images/men3.jpg', 'gender' => 'men'],
            ['url' => 'images/men4.jpg', 'gender' => 'men'],
            ['url' => 'images/men5.jpg', 'gender' => 'men'],
            ['url' => 'images/men6.jpg', 'gender' => 'men'],
            ['url' => 'images/men7.jpg', 'gender' => 'men'],
            ['url' => 'images/men8.jpg', 'gender' => 'men'],
            ['url' => 'images/men9.jpg', 'gender' => 'men'],
            ['url' => 'images/men10.jpg', 'gender' => 'men'],
            ['url' => 'images/men11.jpg', 'gender' => 'men'],
            ['url' => 'images/men12.jpg', 'gender' => 'men'],
            ['url' => 'images/men13.jpg', 'gender' => 'men'],
            ['url' => 'images/men14.jpg', 'gender' => 'men'],
            ['url' => 'images/men15.jpg', 'gender' => 'men'],     
            ['url' => 'images/men16.jpg', 'gender' => 'men'],
            ['url' => 'images/men17.jpg', 'gender' => 'men'],
            ['url' => 'images/men18.jpg', 'gender' => 'men']
        ];

        if ($gender != 'all') {
            $images = array_filter($images, function ($img) use ($gender) {
                return $img['gender'] === $gender;
            });
        }

        return view('gallery', [
            'images' => $images,
            'gender' => $gender
        ]);
    }
}

