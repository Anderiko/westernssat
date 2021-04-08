<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use \App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventController;
use \App\Http\Controllers\CacheController;
use App\Http\Controllers\IndexController;
use \App\Http\Controllers\MemberController;
use \App\Http\Controllers\PartyController;
use \App\Http\Controllers\SaveController;


// ===== HOME =====
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::redirect('/home', '/');
Route::view('/mentions', 'mentions')->name('mentions');

// ===== USER ROUTES =====
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/register', [AuthController::class, 'registerform'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/user', [AuthController::class, 'user']);


// ===== PASSWORD ROUTES =====
Route::prefix('password')->group(function () {

    Route::get('/forgot', [AuthController::class, 'requestPassword'])->middleware('guest')->name('password.forgot');
    Route::post('/forgot', [AuthController::class, 'sendResetLink'])->middleware('guest')->name('password.forgot');


    Route::get('/reset', function (Illuminate\Http\Request $request) {
        $request->validate(['token' => 'required']);
        return view('auth.reset-password', ['token' => $request->token]);
    })->middleware('guest')->name('password.reset');

    Route::post('/reset', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');

    Route::post('/change', [AuthController::class, 'changePassword'])->middleware('auth')->name('password.change');
    Route::get('/change', [AuthController::class, 'showPassword'])->name('password.change');

});


// ===== PROFILE ROUTES =====
Route::prefix('profile')->group(function () {

    Route::get('/', [AuthController::class, 'profile'])->middleware('auth')->name('profile');
    Route::post('/', [AuthController::class, 'updateProfile'])->middleware('auth')->name('profile.update');

    Route::get('/edit', [AuthController::class, 'editProfile'])->middleware('auth')->name('profile.edit');

});


// ===== EMAIL VERIFY =====
Route::prefix('email')->group(function () {

    Route::get('/verify', [EmailController::class, 'emailNotice'])->middleware('auth')->name('verification.notice');

    Route::get('/verify/{id}/{hash}', [EmailController::class, 'emailVerify'])->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/verification-notification', [EmailController::class, 'emailResend'])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

});


// ===== MEMBERS =====
Route::prefix('members')->group(function () {

    Route::get('/', [MemberController::class, 'index'])->name('members.index');
    Route::post('/', [MemberController::class, 'store'])->middleware('perms:create_member')->name('members.store');

    Route::get('/create', [MemberController::class, 'create'])->middleware('perms:create_member')->name('members.create');

    Route::post('/{member}', [MemberController::class, 'update'])->middleware('perms:edit_member')->name('members.update');
    Route::delete('/{member}', [MemberController::class, 'delete'])->middleware('perms:delete_member')->name('members.delete');
    Route::get('/{member}/edit', [MemberController::class, 'edit'])->middleware('perms:edit_member')->name('members.edit');

});

// ===== EVENTS =====
Route::prefix('events')->group(function () {

    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::post('/', [EventController::class, 'store'])->middleware('perms:create_event')->name('events.store');

    Route::get('/create', [EventController::class, 'create'])->middleware('perms:create_event')->name('events.create');

    Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/{event}', [EventController::class, 'update'])->middleware('perms:edit_event')->name('events.update');
    Route::delete('/{event}', [EventController::class, 'delete'])->middleware('perms:delete_event')->name('events.delete');

    Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit')->middleware('perms:edit_event');
    Route::delete('/{event}/force', [EventController::class, 'forceDelete'])->middleware('perms:force_delete_event')->name('events.delete.force');

});



// ===== GAME =====
Route::prefix('game')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/token', [AuthController::class, 'token']);
    Route::post('/hint', [SaveController::class, 'hintUsed']);
    Route::post('/end/group', [SaveController::class, 'endGroup']);
    Route::post('/end/solo', [SaveController::class, 'endSolo']);

    Route::get('/save/solo/create', [SaveController::class, 'createSolo']);
    Route::post('/save/solo', [SaveController::class, 'saveSolo']);
    Route::get('/save/solo/load', [SaveController::class, 'loadSolo']);
    Route::get('/save/solo/rebase', [SaveController::class, 'rebaseSolo']);



    Route::get('/save/group/create', [SaveController::class, 'createGroup']);
    Route::post('/save/group', [SaveController::class, 'saveGroup']);
    Route::get('/save/group/load', [SaveController::class, 'loadGroup']);

    Route::get('/{path?}', [IndexController::class, 'game'])->name('game');

});



// ===== PARTY =====
Route::prefix('party')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/create', [PartyController::class, 'create'])->name('party.create');


    Route::get('/{party}/register', [PartyController::class, 'register'])->name('party.register');
    Route::get('/{party}/unregister', [PartyController::class, 'unregister'])->name('party.unregister');

    Route::get('/join', [PartyController::class, 'joinForm'])->name('party.join');
    Route::post('/join', [PartyController::class, 'join'])->name('party.join');

    Route::delete('/leave', [PartyController::class, 'leave'])->name('party.leave');
    Route::delete('/{party}/{user}', [PartyController::class, 'removeMember'])->name('party.removeMember');
    Route::delete('/{party}', [PartyController::class, 'dissovleParty'])->name('party.dissolve');

    Route::get('/{party}/quit', function () {
        abort(404);
    });
    Route::get('/{party}/{user}', function () {
        abort(404);
    });
    Route::get('/{party}', function () {
        abort(404);
    });

});



// ===== GEOCACHE ROUTES =====
Route::prefix('geocache')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [CacheController::class, 'index'])->name('geocache.index');
    Route::get('/map', [CacheController::class, 'map'])->name('geocache.map');
    Route::get('/rules', [CacheController::class, 'rules'])->name('geocache.rules');
    Route::get('/credits', [CacheController::class, 'credits'])->name('geocache.credits');

    Route::get('/map/geopoints', [CacheController::class, 'getGeopoints']);

    Route::get('/enigme', [CacheController::class, 'getEnigmeParts']);

    Route::post('/enigme', [CacheController::class, 'submitEnigme'])->name('geocache.enigme');

    Route::get('/caches/{cache}', [CacheController::class, 'showCache']);

    Route::get('/validate', [CacheController::class, 'validateCacheForm'])->name('geocache.validate');
    Route::post('/validate', [CacheController::class, 'validateCache'])->name('geocache.validate');
});

// ===== ADMIN =====
Route::prefix('admin')->middleware('perms:admin')->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');

    Route::get('/users/{user}/perms', [AdminController::class, 'showPermissions'])->name('admin.user.permissions');
    Route::post('/users/{user}/perms', [AdminController::class, 'updatePermissions'])->name('admin.user.permissions.update');
    Route::post('/users/{user}/roles', [AdminController::class, 'updateRoles'])->name('admin.user.roles.update');

    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::get('/roles/{role}', [AdminController::class, 'showRole'])->name('admin.roles');
    Route::post('/roles/{role}', [AdminController::class, 'updateRole'])->name('admin.roles');
    Route::delete('/roles/{role}', [AdminController::class, 'deleteRole'])->name('admin.roles.delete');

    Route::post('/roles', [AdminController::class, 'createRole'])->name('admin.roles.create');

});
