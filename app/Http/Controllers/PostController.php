<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
      
        $client = new \GuzzleHttp\Client();

        
        $url = 'https://teratail.com/api/v1/questions';

       
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
       
        $questions = json_decode($response->getBody(), true);
        
        
        return view('index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
        
     }