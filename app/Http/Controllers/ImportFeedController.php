<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImportFeedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $url = config('app.blog_feed_url');
        $response = Http::acceptJson()->get($url);
        $postsToInsert = [];

        if($response->ok())
        {
            $designatedUser = User::where(['name'=>'Admin'])->limit(1)->first();
            $responseContent = $response->json();
            
            if(!empty($responseContent['data']))
            {
                foreach($responseContent['data'] as $content)
                {
                    $postsToInsert[] = [
                        'id' => (string) Str::uuid(),
                        'title'=> $content['title'],
                        'user_id'=> $designatedUser->id,
                        'description'=> $content['description'], 
                        'publication_date'=> $content['publication_date']
                    ];
                }
            }
            
            DB::table('posts')->upsert($postsToInsert, ['title'], []);
        }
    }
}
