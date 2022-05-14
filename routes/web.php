<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Http\Livewire\LetsHelp;
use App\Models\User;
use App\Models\Event;
use App\Models\News;
use App\Models\Helpme; 
use App\Models\MessageBox; 
use App\Models\Role;
use App\Http\Controllers\Site\Home;
use App\Http\Controllers\Signout;
use App\Http\Controllers\Admin\Dashboard;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Site\HelpmeController;
use Twilio\Rest\Client;

Route::get('try', function ()
{

$receiver = '+251920763031';
$message = 'Hi Habte';
try{
    $account_sid = getenv('TWILIO_SID');
    $auth_token = getenv('TWILIO_TOKEN');
    $tw_no = getenv('TWILIO_FROM');
    $client = new Client($account_sid, $auth_token);
    $client->messages->create($receiver,['from'=>$tw_no,
'body'=>$message]);
    dd('Sent!');

} catch (Exception $e){
    dd('Error: ', $e->getMessage());
}	
});




Route::get('/', function () {
    return redirect()->route('site.home', app()->getLocale());
})->name('home');

Route::get('/', [Home::class, 'home'])->name('site.home');
Route::get('events/', [Home::class, 'events'])->name('site.events');
Route::get('staff/', [Home::class, 'staff'])->name('site.staff');
Route::get('lets-help', [Home::class, 'letsHelp'])->name('site.letshlep');
Route::get('help-me-form', [Home::class, 'tipForm'])->name('site.helpmeform');
Route::post('help-me-application',[HelpmeController::class, 'sendHelpMe'])->name('site.helpme.send');
Route::get('dash', [Dashboard::class, 'index'])->name('admin.dashboard');
Route::get('join-us',[Home::class,'registrationView'])->name('joinus');
Route::get('all-my-evnts',[Home::class,'allMyEvents'])->name('all.my.events');
Route::get('donate-materials',[Home::class,'donateMaterialsForm'])->name('donate.materials.form');
Route::get('contact-us',[Home::class,'contactForm'])->name('contact.form');

// Auth::routes();



Route::group(['middleware'=>['auth']],  function ()
{
    Route::get('/logout',[Signout::class,'signout'])->name('logout');
    
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
Route::get('personal-info', [Home::class, 'profile'])->name('profile');
Route::post('update-profile', [Home::class, 'updateProfile'])->name('update.profile');

Route::get('dash/events', [Dashboard::class, 'events'])->name('admin.events');
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
Route::get('dash/mails', [Dashboard::class, 'mails'])->name('user.mails');
Route::get('dash/mails/view/{id}', [Dashboard::class, 'viewMail'])->name('user.mails.view');
Route::get('dash/mails/reply/{id}', [Dashboard::class, 'reply'])->name('user.mails.reply');
Route::get('dash/users', [Dashboard::class, 'users'])->name('admin.users');
Route::get('dash/users/staffup/{id}', [Dashboard::class, 'staffup'])->name('admin.users.staffup');
Route::get('dash/users/staffdown/{id}', [Dashboard::class, 'staffdown'])->name('admin.users.staffdown');
Route::get('dash/users/adminup/{id}', [Dashboard::class, 'adminup'])->name('admin.users.adminup');
Route::get('dash/users/admindown/{id}', [Dashboard::class, 'admindown'])->name('admin.users.admindown');
Route::post('/users/delete', [Dashboard::class, 'deleteUser'])->name('admin.user.delete');

});    


Route::get('login',[Home::class,'loginView'])->name('login');

Route::get('join-event/{id}',[Home::class,'joinEvent'])->name('join.event');
Route::get('leave-event/{id}',[Home::class,'leaveEvent'])->name('leave.event');
Route::get('read-news/{id}', [Home::class, 'news'])->name('site.news');
Route::get('dash/helpmes/view/{id}', [Dashboard::class, 'viewHelpme'])->name('admin.helpmes.view');
Route::get('dash/helpmes/accept/{id}', [Dashboard::class, 'acceptHelpme'])->name('admin.helpmes.accept');
Route::get('dash/helpmes/reject/{id}', [Dashboard::class, 'rejectHelpme'])->name('admin.helpmes.reject');
Route::get('dash/helpmes/remove/{id}', [Dashboard::class, 'removeHelpme'])->name('admin.helpmes.remove');
Route::get('dash/helpmes/improve/{id}', [Dashboard::class, 'improveHelpme'])->name('admin.helpmes.improve');
Route::post('dash/helpmes/update/{id}', [Dashboard::class, 'updateHelpme'])->name('admin.helpmes.update');

Route::get('events/view/{id}', [Home::class, 'viewEvent'])->name('site.events.view');

Route::get('lets-help/view/{id}', [Home::class, 'viewLetsHelp'])->name('site.letshlep.view');

Route::get('dash/news/updateform/{id}', [Dashboard::class, 'updateNewsForm'])->name('admin.news.updateform');

Route::post('dash/news/update/{id}', [Dashboard::class, 'updateNews'])->name('admin.news.update');



























//     Route::get('/', [Home::class, 'home'])->name('site.home');
// Route::get('staff/', [Home::class, 'staff'])->name('site.staff');
// Route::get('events/', [Home::class, 'events'])->name('site.events');
// Route::get('events/view/{id}', [Home::class, 'viewEvent'])->name('site.events.view');
// Route::get('read-news/{id}', [Home::class, 'news'])->name('site.news');
// Route::get('lets-help', [Home::class, 'letsHelp'])->name('site.letshlep');
// Route::get('lets-help/view/{id}', [Home::class, 'viewLetsHelp'])->name('site.letshlep.view');
// Route::get('help-me-form', [Home::class, 'tipForm'])->name('site.helpmeform');
// Route::post('help-me-application',[App\Http\Controllers\Site\HelpmeController::class, 'sendHelpMe'])->name('site.helpme.send');
// Route::get('dash', [Dashboard::class, 'index'])->name('admin.dashboard');
// Route::get('login',[Home::class,'loginView'])->name('login');
// Route::get('join-us',[Home::class,'registrationView'])->name('joinus');
// Route::get('all-my-evnts',[Home::class,'allMyEvents'])->name('all.my.events');
// Route::get('donate-materials',[Home::class,'donateMaterialsForm'])->name('donate.materials.form');
// Route::get('contact-us',[Home::class,'contactForm'])->name('contact.form');
// Route::group(['middleware'=>['auth']],  function ()
// {
//     Route::get('/logout',[Signout::class,'signout'])->name('logout');
    
// });


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// Route::get('personal-info', [Home::class, 'profile'])->name('profile');
// Route::post('update-profile', [Home::class, 'updateProfile'])->name('update.profile');
// Route::get('join-event/{id}',[Home::class,'joinEvent'])->name('join.event');
// Route::get('leave-event/{id}',[Home::class,'leaveEvent'])->name('leave.event');
// Route::get('dash/events', [Dashboard::class, 'events'])->name('admin.events');
// Route::get('dash/news', [Dashboard::class, 'news'])->name('admin.news');

// Route::get('dash/helpmes', [Dashboard::class, 'helpmes'])->name('admin.helpmes');
// Route::get('dash/helpmes/view/{id}', [Dashboard::class, 'viewHelpme'])->name('admin.helpmes.view');
// Route::get('dash/helpmes/accept/{id}', [Dashboard::class, 'acceptHelpme'])->name('admin.helpmes.accept');
// Route::get('dash/helpmes/reject/{id}', [Dashboard::class, 'rejectHelpme'])->name('admin.helpmes.reject');
// Route::get('dash/helpmes/remove/{id}', [Dashboard::class, 'removeHelpme'])->name('admin.helpmes.remove');
// Route::get('dash/helpmes/improve/{id}', [Dashboard::class, 'improveHelpme'])->name('admin.helpmes.improve');
// Route::post('dash/helpmes/update/{id}', [Dashboard::class, 'updateHelpme'])->name('admin.helpmes.update');

// Route::get('dash/news/addform', [Dashboard::class, 'addNewsForm'])->name('admin.news.addform');
// Route::get('dash/news/updateform/{id}', [Dashboard::class, 'updateNewsForm'])->name('admin.news.updateform');
// Route::post('dash/news/update/{id}', [Dashboard::class, 'updateNews'])->name('admin.news.update');
// Route::post('dash/news/delete', [Dashboard::class, 'deleteNews'])->name('admin.news.delete');

// Route::post('dash/news/add', [Dashboard::class, 'addNews'])->name('admin.news.add');
// Route::get('dash/event/addform', [Dashboard::class, 'addEventView'])->name('admin.event.addform');
// Route::post('dash/event/add', [Dashboard::class, 'addEvent'])->name('admin.event.add');
// Route::get('dash/event/updateform/{id}', [Dashboard::class, 'updateEventView'])->name('admin.event.updateform');
// Route::post('dash/event/update/{id}', [Dashboard::class, 'updateEvent'])->name('admin.event.update');

// Route::post('/events/delete', [Dashboard::class, 'deleteEvent'])->name('admin.event.delete');
// Route::get('dash/event/viewmembers/{id}', [Dashboard::class, 'viewMembers'])->name('admin.event.viewmembers');
// Route::get('dash/mails', [Dashboard::class, 'mails'])->name('user.mails');
// Route::get('dash/mails/view/{id}', [Dashboard::class, 'viewMail'])->name('user.mails.view');
// Route::get('dash/mails/reply/{id}', [Dashboard::class, 'reply'])->name('user.mails.reply');


// Route::get('dash/users', [Dashboard::class, 'users'])->name('admin.users');
// Route::get('dash/users/staffup/{id}', [Dashboard::class, 'staffup'])->name('admin.users.staffup');
// Route::get('dash/users/staffdown/{id}', [Dashboard::class, 'staffdown'])->name('admin.users.staffdown');
// Route::get('dash/users/adminup/{id}', [Dashboard::class, 'adminup'])->name('admin.users.adminup');
// Route::get('dash/users/admindown/{id}', [Dashboard::class, 'admindown'])->name('admin.users.admindown');
// Route::post('/users/delete', [Dashboard::class, 'deleteUser'])->name('admin.user.delete');



// });






















