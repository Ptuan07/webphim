<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LinkMovieController;





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

Route::get('/',[IndexController::class, 'home'])->name('homepage');
Route::get('/danh-muc/{slug}',[IndexController::class, 'category'])->name('category');
Route::get('/the-loai/{slug}',[IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}',[IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}',[IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}/{server_active}',[IndexController::class, 'watch']);
Route::get('/so-tap',[IndexController::class, 'episode'])->name('so-tap');
Route::get('/year/{year}',[IndexController::class, 'year']);
Route::get('/tag/{tag}',[IndexController::class, 'tag']);
Route::get('/tim-kiem',[IndexController::class, 'timkiem'])->name('tim-kiem');
Route::get('/locphim',[IndexController::class, 'locphim'])->name('locphim');
Route::post('/add-rating',[IndexController::class, 'add_rating'])->name('add-rating');




Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,

]);

Route::get('/home', [HomeController::class, 'index'])->name('home');


//route admin
Route::resource('category', CategoryController::class);
Route::post('resorting', [CategoryController::class, 'resorting'])->name('resorting');
Route::resource('movie', MovieController::class);
Route::resource('genre', GenreController::class);
Route::resource('country', CountryController::class);
Route::resource('linkmovie', LinkMovieController::class);

//them tap phim
Route::get('add-episode/{id}', [EpisodeController::class,'add_episode'])->name('add-episode');
Route::resource('episode', EpisodeController::class);
Route::get('select-movie', [EpisodeController::class,'select_movie'])->name('select-movie');



Route::get('/update-year-phim',[MovieController::class, 'update_year']);
Route::get('/update-topview-phim',[MovieController::class, 'update_topview']);
Route::post('/filter-topview-phim',[MovieController::class, 'filter_topview']);
Route::get('/filter-topview-default',[MovieController::class, 'filter_default']);
Route::get('/update-season-phim',[MovieController::class, 'update_season']);
// Thông tin web
Route::resource('info', InfoController::class);


// thay đổi dữ liệu trong admin bằng ajax
Route::get('/category-choose',[MovieController::class, 'category_choose'])->name('category-choose');
Route::get('/country-choose',[MovieController::class, 'country_choose'])->name('country-choose');
Route::get('/vietsub-choose',[MovieController::class, 'vietsub_choose'])->name('vietsub-choose');
Route::get('/status-choose',[MovieController::class, 'status_choose'])->name('status-choose');
Route::get('/phimhot-choose',[MovieController::class, 'phimhot_choose'])->name('phimhot-choose');
Route::get('/thuocphim-choose',[MovieController::class, 'thuocphim_choose'])->name('thuocphim-choose');
Route::get('/resolution-choose',[MovieController::class, 'resolution_choose'])->name('resolution-choose');
Route::post('/update-image-movie-ajax',[MovieController::class, 'update_image_movie_ajax'])->name('update-image-movie-ajax');
Route::post('/watch-video',[MovieController::class, 'watch_video'])->name('watch-video');

Route::get('/genre-choose',[MovieController::class, 'genre_choose'])->name('genre-choose');

Route::get('/create_sitemap', function(){
    return Artisan::call('sitemap:create');
});


