<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Str;

class FetchFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch posts from feed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
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

            return 0;
        }
    }
}
