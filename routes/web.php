<?php

use App\Models\Role;
use App\Http\Controllers\Signout;
use App\Http\Controllers\Messages;
use App\Http\Controllers\Site\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Site\HelpmeController;
use App\Http\Controllers\admin\EventControllerAdmin;
// use Twilio\Rest\Client;

Route::get('login', [Home::class, 'loginView'])->name('login');
Route::get('join-event/{id}', [Home::class, 'joinEvent'])->name('join.event');
Route::get('leave-event/{id}', [Home::class, 'leaveEvent'])->name('leave.event');
Route::get('read-news/{id}', [Home::class, 'news'])->name('site.news');
Route::get('events/view/{id}', [Home::class, 'viewEvent'])->name('site.events.view');
Route::get('/', [Home::class, 'home'])->name('site.home');
Route::get('/search-news', [Home::class, 'searchNews'])->name('site.home.searchnews');
Route::get('/search-events', [Home::class, 'searchEvents'])->name('site.home.searchevents');
Route::get('events', [Home::class, 'events'])->name('site.events');
Route::get('staff', [Home::class, 'staff'])->name('site.staff');
Route::get('lets-help', [Home::class, 'letsHelp'])->name('site.letshlep');
Route::get('lets-help/view/{id}', [Home::class, 'viewLetsHelp'])->name('site.letshlep.view');
Route::get('help-me-form', [Home::class, 'helpmeForm'])->name('site.helpmeform');
Route::post('help-me-application', [HelpmeController::class, 'sendHelpMe'])->name('site.helpme.send');
Route::get('join-us', [Home::class, 'registrationView'])->name('joinus');
Route::get('all-my-events', [Home::class, 'allMyEvents'])->name('all.my.events');
Route::get('donate-materials', [Home::class, 'donateMaterialsForm'])->name('donate.materials.form');
Route::get('contact-us', [Home::class, 'contactForm'])->name('contact.form');
Route::get('/logout', [Signout::class, 'signout'])->name('logout')->middleware('auth');
Route::group(['middleware' => ['auth']],  function () {
    Route::get('personal-info', [Home::class, 'profile'])->name('profile');
    Route::post('update-profile', [Home::class, 'updateProfile'])->name('update.profile');
    Route::get('profile/delete', [Home::class, 'deleteProfile'])->name('delete.profile');
    Route::post('mail/reply', [Messages::class, 'reply'])->name('mail.reply');
    Route::get('dash/mails', [Messages::class, 'chat'])->name('user.mails');
    Route::get('dash/mails/open/{id}', [Messages::class, 'open'])->name('user.mails.open');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () { 
    Route::group(['middleware' => ['isAdmin']],  function () {
        Route::get('dash', [Dashboard::class, 'index'])->name('admin.dashboard');
        Route::get('dash/users', [Dashboard::class, 'users'])->name('admin.users');
        Route::get('dash/users/staffup/{id}', [Dashboard::class, 'staffup'])->name('admin.users.staffup');
        Route::get('dash/users/staffdown/{id}', [Dashboard::class, 'staffdown'])->name('admin.users.staffdown');
        Route::get('dash/users/adminup/{id}', [Dashboard::class, 'adminup'])->name('admin.users.adminup');
        Route::get('dash/users/admindown/{id}', [Dashboard::class, 'admindown'])->name('admin.users.admindown');
        Route::post('/users/delete', [Dashboard::class, 'deleteUser'])->name('admin.user.delete');
        
    });
    Route::group(['middleware' => ['isStaff']],  function () {
        Route::get('dash/news/updateform/{id}', [Dashboard::class, 'updateNewsForm'])->name('admin.news.updateform');
        Route::post('dash/news/update/{id}', [Dashboard::class, 'updateNews'])->name('admin.news.update');
        Route::get('dash/events', [Dashboard::class, 'events'])->name('admin.events');
        Route::get('/search-event', [Dashboard::class, 'searchEvent'])->name('admin.events.search');
        Route::get('dash/news', [Dashboard::class, 'news'])->name('admin.news');
        Route::get('dash/helpmes', [Dashboard::class, 'helpmes'])->name('admin.helpmes');
        Route::get('dash/news/addform', [Dashboard::class, 'addNewsForm'])->name('admin.news.addform');
        Route::post('dash/news/delete', [Dashboard::class, 'deleteNews'])->name('admin.news.delete');
        Route::post('dash/news/add', [Dashboard::class, 'addNews'])->name('admin.news.add');
        Route::get('dash/event/addform', [Dashboard::class, 'addEventView'])->name('admin.event.addform');
        Route::post('dash/event/add', [Dashboard::class, 'addEvent'])->name('admin.event.add');
        Route::get('dash/event/updateform/{id}', [Dashboard::class, 'updateEventView'])->name('admin.event.updateform');
        Route::post('dash/event/update/{id}', [Dashboard::class, 'updateEvent'])->name('admin.event.update');
        Route::post('/events/delete', [Dashboard::class, 'deleteEvent'])->name('admin.event.delete');
        Route::get('dash/event/viewmembers/{id}', [Dashboard::class, 'viewMembers'])->name('admin.event.viewmembers');
        Route::get('dash/events/search',[Dashboard::class,'searchEvent'])->name('admin.events.search');
        Route::get('dash/news/search',[Dashboard::class,'searchNews'])->name('admin.news.search');
        Route::get('dash/users/search',[Dashboard::class,'searchUsers'])->name('admin.users.search');
        Route::get('dash/helpmes/search',[Dashboard::class,'searchHelpmes'])->name('admin.helpmes.search');

        Route::get('dash/helpmes/view/{id}', [Dashboard::class, 'viewHelpme'])->name('admin.helpmes.view');
        Route::get('dash/helpmes/accept/{id}', [Dashboard::class, 'acceptHelpme'])->name('admin.helpmes.accept');
        Route::get('dash/helpmes/reject/{id}', [Dashboard::class, 'rejectHelpme'])->name('admin.helpmes.reject');
        Route::get('dash/helpmes/remove/{id}', [Dashboard::class, 'removeHelpme'])->name('admin.helpmes.remove');
        Route::get('dash/helpmes/improve/{id}', [Dashboard::class, 'improveHelpme'])->name('admin.helpmes.improve');
        Route::post('dash/helpmes/update/{id}', [Dashboard::class, 'updateHelpme'])->name('admin.helpmes.update'); 
    });
});

Route::get('try', function () {
    $admins = Role::find(3)->users->count();
    dd($admins);
});




