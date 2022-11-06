<?php

use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\User\Page\ElementController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\UserController;
use App\Models\Page\Page;
use App\Models\Page\PageElement;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use JeroenDesloovere\VCard\VCard;

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

$host = parse_url(config('app.url'), PHP_URL_HOST);

// domain.zone
Route::group(['domain' => $host], function () {
    Route::view('/', 'welcome');
    Route::get('/{page:link}', [PageController::class, 'show']);
    Route::group(['prefix' => 'app'], function () {
        Route::redirect('/', RouteServiceProvider::HOME);
        Route::group(['middleware' => ['auth', 'verified']], function () {
            Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
                Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies');
                Route::get('pages', static fn() => auth()->user()->pages)->name('pages');
                Route::post('register_link_click', [PageController::class, 'registerLinkClick'])->name('register_link_click');
            });
            Route::resource('pages', PageController::class)->except('edit');
            Route::group(['prefix' => '/editor/{page:uuid}', 'as' => 'pages.', 'middleware' => 'user.owns_page'], function () {
                Route::get('/', [PageController::class, 'edit'])->name('edit');
                Route::post('/create_profile_element', [ElementController::class, 'createProfileElement'])->name('create_profile_element');
                Route::post('/create_contact_element', [ElementController::class, 'createContactElement'])->name('create_contact_element');
                Route::group(['as' => 'update.'], function () {
                    Route::prefix('/settings')->as('settings')->group(function () {
                        Route::put('/', [PageController::class, 'updateSettings']);
                        Route::delete('/seo/favicon', [PageController::class, 'deleteSeoFavicon'])->name('.seo.favicon.delete');
                    });
                    Route::prefix('/theme')->as('theme')->group(function () {
                        Route::put('/', [PageController::class, 'updateTheme']);
                    });
                });
                Route::prefix('/page_elements')->as('page_elements.')->group(function () {
                    Route::post('/reorder', [ElementController::class, 'reorder'])->name('reorder');
                    Route::post('/create', [ElementController::class, 'create'])->name('create');
                });
            });
            Route::middleware('user.owns_element')->group(function () {
                Route::resource('page_elements', ElementController::class)->except('create');
                Route::prefix('/page_elements/{page_element}')->as('page_elements.')->group(function () {
                    Route::post('/copy', [ElementController::class, 'copy'])->name('copy');
                    Route::post('/update_profile_element', [ElementController::class, 'updateProfileElement'])->name('update_profile_element');
                    Route::post('/update_contact_element', [ElementController::class, 'updateContactElement'])->name('update_contact_element');
                    Route::delete('/remove_profile_picture', [ElementController::class, 'removeProfilePicture'])->name('remove_profile_picture');
                    Route::post('/update_static', [ElementController::class, 'updateStatic'])->name('update_static');
                });
            });
            Route::resource('products', ProductController::class);
        });
        Route::get('/user_products', [ProductController::class, 'getForPage'])->name('products.get_for_page');
        Route::get('/send_feedback', [UserController::class, 'sendFeedback'])->name('user.send-feedback');
        require __DIR__ . '/auth.php';
    });
});

Route::get('/add_to_contacts/{element}', function (PageElement $element) {
    $props = $element->props;
    $vcard = new VCard();
    $lastname = $element['surname'];
    $firstname = $props['name'];
    $additional = $props['patronymic'];
    $prefix = '';
    $suffix = '';
    $vcard->addName($lastname, $firstname, $additional, $prefix, $suffix);
    $vcard->addCompany($props['company']);
    $vcard->addPhoneNumber($props['wpn'], 'PREF;WORK');
    $vcard->addPhoneNumber($props['phn'], 'HOME');
    $vcard->addAddress(null, null, $props['address'], null, null, null);
    $vcard->addURL($props['website']);
    try {
        $path = $element->getMedia(PageElement::$profilePicCollection)?->first()?->getPath();
        if ($path) {
            $vcard->addPhoto($path);
        }
    } catch (Exception) {
    }
    $vcard->download();
//    return redirect()->back();
})->name('add_to_contacts');
