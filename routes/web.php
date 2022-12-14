<?php

use App\Http\Requests\PostFormRequest;
use App\Models\Announcement;
use App\Models\Order;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/charts', function () {

    return view('charts');
});

Route::get('/stats', function () {

    return view('stats',);
});

Route::get('/announcement', function () {

    $announcement = Announcement::first();

    abort_if(!$announcement->isActive, 404);

    return view('announcement', [
        'announcement' => $announcement,
    ]);
});

Route::get('/announcement/edit', function () {

    $announcement = Announcement::first();

    return view('edit-announcement', [
        'announcement' => $announcement,
    ]);
});

Route::patch('/announcement/update', function (Request $request) {

    $fields = $request->validate([
        'isActive' => 'required',
        'bannerText' => 'required',
        'bannerColor' => 'required',
        'titleText' => 'required',
        'titleColor' => 'required',
        'content' => 'required',
        'buttonText' => 'required',
        'buttonColor' => 'required',
        'buttonLink' => 'required|url',
        'imageUpload' => 'file|image|max:20000',
        'imageUploadFilePond' => 'string|nullable',
    ]);

    if($request->imageUpload){

        $requestImage = $request->file('imageUpload');
        $image =  Image::make($requestImage);
        $image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $path =  config('filesystems.disks.public.root').'/images/'.$requestImage->hashName();

        $image->save($path);

        $fields =  array_merge($fields, ['imageUpload' => $requestImage->hashName()]);
    }

    if($request->imageUploadFilePond) {

        $newFileName = Str::after($request->imageUploadFilePond, 'tmp/');
        Storage::disk('public')->move($request->imageUploadFilePond, "images/$newFileName");
        $fields = array_merge($fields, ['imageUploadFilePond' => "images/$newFileName"]);

    }

    $announcement = Announcement::first();

    $announcement->update($fields);

    return back()->with('success_message', 'Announcement was updated!');
});

Route::post('/upload', function(Request$request){

    if($request->imageUploadFilePond) {

        $path = $request->file('imageUploadFilePond')->store('tmp', 'public');
    }

    return $path;
});

Route::get('/posts', function () {
    return view('posts.index', [
        'posts' => Post::latest()->get(),
    ]);
});

Route::get('/posts/create', function () {
    return view('posts.create', [
        'post' => new Post(),
    ]);
});

Route::post('/posts/create', function (PostFormRequest $request) {
    // Post::create(fields($request));
    $request->updateOrCreate(new Post());

    return redirect('/posts')->with('success_message', 'Post was created!');
});

Route::get('/posts/{post}', function (Post $post) {
    return view('posts.show', [
        'post' => $post,
    ]);
});

Route::get('/posts/{post}/edit', function (Post $post) {
    return view('posts.edit', [
        'post' => $post,
    ]);
});

Route::patch('/posts/{post}', function (Post $post, PostFormRequest $request) {
    // $post->update(fields($request));
    $request->updateOrCreate($post);

    return redirect('/posts/'.$post->id)->with('success_message', 'Post was updated!');
});

Route::get('/drag-drop', function () {
    return view('drag-drop');
});

Route::get('/http-client', function(){

    $responseGitHub = Http::get('https://api.github.com/users/piechowiaq/repos?sort=created&per_page=10');

    $responseWeather = Http::get('https://api.openweathermap.org/data/3.0/onecall?lat=33.44&lon=-94.04&exclude=hourly,daily&appid='.config('services.openWeatherMap.appId'));

    dump($responseWeather->status());
    return view('http-client', [
        'repos' => $responseGitHub->json(),
    ]);

});

function fields(Request $request)
{
    return [
        'user_id' => 1,
        'title' => $request->title,
        'body' => $request->body,
    ];
}
