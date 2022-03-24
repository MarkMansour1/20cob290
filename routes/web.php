<?php

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

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
    return redirect(RouteServiceProvider::LOGIN);
});

Route::get('/problems', [App\Http\Controllers\users\FetchProblems::class, 'index']);

Route::get('/problem/{problem_id}', [App\Http\Controllers\users\FetchProblemDetails::class, 'index']);
Route::Post('/problem/sendMessage', [App\Http\Controllers\users\PostChatMessage::class, 'index']);
Route::Post('/problem/closeProblem', [App\Http\Controllers\users\CloseProblem::class, 'index']);
Route::Post('/problem/solutionNotHelpful', [App\Http\Controllers\users\PostSolutionNotHelpful::class, 'index']);
Route::Post('/problem/provideSolution', [App\Http\Controllers\users\ProvideSolution::class, 'index']);

Route::get('/report-problem', [App\Http\Controllers\users\FetchReportProblemsStartUpInfo::class, 'index']);
Route::Post('/report-problem/fetch-suggested-solutions', [App\Http\Controllers\users\FetchSuggestedSolutions::class, 'index']);
Route::Post('/report-problem/post-report-problem', [App\Http\Controllers\users\PostReportProblem::class, 'index']);

Route::get('/settings', [App\Http\Controllers\users\FetchSettings::class, 'index']);
Route::Post('/settings/updateExpertise', [App\Http\Controllers\users\UpdateExpertise::class, 'index']);
Route::Post('/settings/updateAvailability', [App\Http\Controllers\users\UpdateAvailability::class, 'index']);
Route::Post('/settings/updateDetails', [App\Http\Controllers\users\UpdateUserDetails::class, 'index']);
Route::Post('/settings/updatePassword', [App\Http\Controllers\users\UpdateUserPassword::class, 'index']);

Route::get('/analytics', [App\Http\Controllers\users\FetchAnalytics::class, 'index']);
Route::Post('/analytics/lookup-specialist', [App\Http\Controllers\users\FetchLookupSpecialistDetails::class, 'index']);
Route::Post('/analytics/lookup-equipment', [App\Http\Controllers\users\FetchLookupEquipmentDetails::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
