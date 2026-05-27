<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PreparationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TestInfoController;
use App\Http\Controllers\PricelistController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index'])->name('login');


//Auth
Route::group(['prefix' => 'auth'], function(){
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/forgot',[AuthController::class, 'forgot'])->name('auth.forgot');
    Route::get('/reset/{email}/{remember_token}',[AuthController::class, 'resetInput'])->name('auth.reset');
    Route::post('/reset',[AuthController::class, 'postResetPassword'])->name('auth.reset.post');
    Route::get('/logout',[AuthController::class, 'logout'])->name('auth.logout');
    Route::post('/email',[AuthController::class, 'verifyEmail'])->name('auth.verifyEmail');
    Route::post('/create',[AuthController::class, 'createAccount'])->name('auth.createAccount');
});

//User
Route::group(['prefix' => 'user', 'middleware' => 'auth'], function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/informasi', [UserController::class, 'informasi'])->name('user.informasi');
    Route::get('/pilihlab', [UserController::class, 'pilihLab'])->name('user.pilihlab');
    Route::get('/quotation', [UserController::class, 'quotation'])->name('user.quotation');
    Route::get('/pengiriman', [UserController::class, 'pengiriman'])->name('user.pengiriman');
    Route::get('/preparasi', [UserController::class, 'preparasi'])->name('user.preparasi');
    Route::get('/labtest', [UserController::class, 'labtest'])->name('user.labtest');
    Route::get('/invoice', [UserController::class, 'invoice'])->name('user.invoice');
    Route::get('/download', [UserController::class, 'download'])->name('user.download');
});

//Admin
Route::group(['prefix' => 'admin'], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/manage/user', [AdminController::class, 'manageUser'])->name('admin.manageUser');
    Route::post('/manage/user', [AdminController::class, 'addUser'])->name('admin.addUser');
    Route::post('/manage/user/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::get('/manage/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::get('/ajax-datatable', [AdminController::class, 'ajaxDataTable'])->name('admin.ajax-datatable');

    Route::get('/manage/project', [AdminController::class, 'manageProject'])->name('admin.manageProject');
    Route::get('/manage/detail-project/{id}', [AdminController::class, 'manageDetailProject'])->name('admin.manageDetailProject');
    Route::get('/manage/pdf/{id}', [AdminController::class, 'pdfDetailProject'])->name('admin.pdfDetailProject');

    Route::get('/manage/sample', [AdminController::class, 'manageSample'])->name('admin.manageSample');

    Route::get('/manage/tag', [AdminController::class, 'manageTag'])->name('admin.manageTag');

    Route::get('/manage/news', [AdminController::class, 'manageNews'])->name('admin.manageNews');

    Route::get('/manage/preparation', [AdminController::class, 'managePreparation'])->name('admin.managePreparation');

    Route::get('/manage/testinfo', [AdminController::class, 'manageTestInfo'])->name('admin.manageTestInfo');

    Route::get('/manage/journals', [AdminController::class, 'manageJournals'])->name('admin.manageJournals');

    Route::get('/manage/people', [AdminController::class, 'managePeople'])->name('admin.managePeople');

    Route::get('/manage/slider', [AdminController::class, 'manageSlider'])->name('admin.manageSlider');

    Route::get('/manage/pricelist', [AdminController::class, 'managePricelist'])->name('admin.managePricelist');
});

//Slider Management
Route::group(['prefix' => 'slider'], function(){
    Route::get('/ajax-datatable', [SliderController::class, 'ajaxDataTable'])->name('slider.ajax-datatable');
    Route::post('/add', [SliderController::class, 'addSlider'])->name('slider.addSlider');
    Route::post('/edit', [SliderController::class, 'editSlider'])->name('slider.editSlider');
    Route::get('/delete/{id}', [SliderController::class, 'deleteSlider'])->name('slider.deleteSlider');
});

//Pricelist Management
Route::group(['prefix' => 'pricelist'], function(){
    Route::get('/ajax-datatable', [PricelistController::class, 'ajaxDataTable'])->name('pricelist.ajax-datatable');
    Route::post('/add', [PricelistController::class, 'addPricelist'])->name('pricelist.addPricelist');
    Route::post('/edit', [PricelistController::class, 'editPricelist'])->name('pricelist.editPricelist');
    Route::get('/delete/{id}', [PricelistController::class, 'deletePricelist'])->name('pricelist.deletePricelist');
});

//Project
Route::group(['prefix' => 'project'], function(){
    Route::post('/add', [ProjectController::class, 'addProject'])->name('project.addProject');
    Route::post('/edit', [ProjectController::class, 'editProject'])->name('project.editProject');
    Route::get('/delete/{id}', [ProjectController::class, 'deleteProject'])->name('project.deleteProject');
    Route::get('/delete-response-json/{id}', [ProjectController::class, 'deleteResponseJson'])->name('project.deleteResponseJson');
    Route::post('/change-status', [ProjectController::class, 'changeStatus'])->name('project.changeStatus');
    Route::get('/detail/{id}', [ProjectController::class, 'detailProject'])->name('project.detailProject');
    Route::get('/restore/{id}', [ProjectController::class, 'restoreProject'])->name('project.restoreProject');
    
    Route::get('/ajax-labtest', [ProjectController::class, 'getAjaxLabtest'])->name('project.getAjaxLabtest');
    Route::get('/ajax-get-test-sample', [ProjectController::class, 'getAjaxTestSample2'])->name('project.getAjaxTestSample2');
    Route::get('/ajax-datatable', [ProjectController::class, 'ajaxDataTable'])->name('project.ajax-datatable');
    Route::get('/ajax-bystatus', [ProjectController::class, 'ajaxByStatus'])->name('project.ajax-bystatus');
    Route::get('/ajax-archived', [ProjectController::class, 'ajaxArchived'])->name('project.ajaxArchived');

    Route::get('/ajax-detail-datatable', [ProjectController::class, 'ajaxDetailProjectDataTable'])->name('project.ajax-detail-datatable');
    Route::post('/ajax-add-preparasi-sample', [ProjectController::class, 'ajaxAddPreparasiSample'])->name('project.ajaxAddPreparasiSample');
    Route::post('/ajax-delete-preparasi-sample', [ProjectController::class, 'ajaxDeletePreparasiSample'])->name('project.ajaxDeletePreparasiSample');
    Route::post('/ajax-add-preparasi-image', [ProjectController::class, 'ajaxAddPreparasiImage'])->name('project.ajaxAddPreparasiImage');
    Route::post('/get-ajax-preparasi-sample', [ProjectController::class, 'getAjaxPreparasiSample'])->name('project.getAjaxPreparasiSample');
    Route::post('/ajax-change-status', [ProjectController::class, 'changeStatusAjax'])->name('project.changeStatusAjax');
    Route::post('/ajax-get-test-sample', [ProjectController::class, 'getAjaxTestSample'])->name('project.getAjaxTestSample');
    Route::post('/ajax-add-labtest', [ProjectController::class, 'ajaxAddLabtest'])->name('project.ajaxAddLabtest');
    Route::post('/ajax-add-document', [ProjectController::class, 'ajaxAddDocument'])->name('project.ajaxAddDocument');
    Route::post('/ajax-get-project-by-id', [ProjectController::class, 'getProjectById'])->name('project.getProjectById');

    Route::post('/ajax-upload-bukti', [ProjectController::class, 'uploadBukti'])->name('project.uploadBukti');
    Route::post('/ajax-delete-bukti', [ProjectController::class, 'deleteBukti'])->name('project.deleteBukti');
    Route::post('/ajax-upload-invoice', [ProjectController::class, 'uploadInvoice'])->name('project.uploadInvoice');

    Route::post('/add-hasil-image', [ProjectController::class, 'addHasilImage'])->name('project.addHasilImage');
    Route::get('/ajax-hasil-image', [ProjectController::class, 'getAjaxHasilImage'])->name('project.getAjaxHasilImage');
    Route::get('/delete-hasil-image/{id_hasil_image}', [ProjectController::class, 'deleteHasilImage'])->name('project.deleteHasilImage');
    Route::get('/delete-invoice/{id}', [ProjectController::class, 'deleteInvoice'])->name('project.deleteInvoice');
});

//Sample
Route::group(['prefix' => 'sample'], function(){
    Route::get('/ajax-datatable', [SampleController::class, 'ajaxDataTable'])->name('sample.ajax-datatable');
    Route::post('/add', [SampleController::class, 'addSample'])->name('sample.addSample');
    Route::post('/edit', [SampleController::class, 'editSample'])->name('sample.editSample');
    Route::get('/delete/{id}', [SampleController::class, 'deleteSample'])->name('sample.deleteSample');
    Route::post('/ajax-select', [SampleController::class, 'ajaxSelectOne'])->name('sample.ajax-selectone');
    Route::post('/delete-image-from-sample', [SampleController::class, 'deleteImageFromSample'])->name('sample.deleteImageFromSample');
});

//People
Route::group(['prefix' => 'people'], function(){
    Route::get('/', [PeopleController::class, 'index'])->name('people.index');
    Route::get('/ajax-datatable', [PeopleController::class, 'ajaxDataTable'])->name('people.ajax-datatable');
    Route::post('/add', [PeopleController::class, 'addPeople'])->name('people.addPeople');
    Route::post('/edit', [PeopleController::class, 'editPeople'])->name('people.editPeople');
    Route::get('/delete/{id}', [PeopleController::class, 'deletePeople'])->name('people.deletePeople');

    Route::post('/add-self', [PeopleController::class, 'addSelfJournals'])->name('people.addSelfJournals');
});

//About
Route::group(['prefix' => 'about'], function(){
    Route::get('/', [PeopleController::class, 'aboutPage'])->name('about.aboutPage');
});


//Journals
Route::group(['prefix' => 'journals'], function(){
    Route::get('/pages/{current_page}', [JournalsController::class, 'index'])->name('journals.index');
    Route::get('/ajax-datatable', [JournalsController::class, 'ajaxDataTable'])->name('journals.ajax-datatable');
    Route::post('/add', [JournalsController::class, 'addJournals'])->name('journals.addJournals');
    Route::post('/edit', [JournalsController::class, 'editJournals'])->name('journals.editJournals');
    Route::get('/delete/{id}', [JournalsController::class, 'deleteJournals'])->name('journals.deleteJournals');
});

//Preparation
Route::group(['prefix' => 'preparation'], function(){
    Route::get('/ajax-datatable', [PreparationController::class, 'ajaxDataTable'])->name('preparation.ajax-datatable');
    Route::post('/add', [PreparationController::class, 'addPreparation'])->name('preparation.addPreparation');
    Route::post('/edit', [PreparationController::class, 'editPreparation'])->name('preparation.editPreparation');
    Route::get('/delete/{id}', [PreparationController::class, 'deletePreparation'])->name('preparation.deletePreparation');
});

//Tag
Route::group(['prefix' => 'tag'], function(){
    Route::get('/ajax-datatable', [TagController::class, 'ajaxDataTable'])->name('tag.ajax-datatable');
    Route::post('/add', [TagController::class, 'addTag'])->name('tag.addTag');
    Route::post('/edit', [TagController::class, 'editTag'])->name('tag.editTag');
    Route::get('/delete/{id}', [TagController::class, 'deleteTag'])->name('tag.deleteTag');
    Route::get('/delete-ajax/{id_tag}/{id_news}', [TagController::class, 'deleteTagAjax'])->name('tag.deleteTagAjax');
});

//News & IRMS
Route::group(['prefix' => 'news'], function(){
    Route::get('/pages/{current_page}', [NewsController::class, 'index'])->name('news.index');
    Route::get('/detail/{slug}', [NewsController::class, 'detailNews'])->name('news.detailNews');
    Route::get('/ajax-datatable', [NewsController::class, 'ajaxDataTable'])->name('news.ajax-datatable');
    Route::post('/add', [NewsController::class, 'addNews'])->name('news.addNews');
    Route::post('/search', [NewsController::class, 'searchNews'])->name('news.searchNews');
    Route::post('/edit', [NewsController::class, 'editNews'])->name('news.editNews');
    Route::get('/delete/{id}', [NewsController::class, 'deleteNews'])->name('news.deleteNews');
    Route::get('/news-tag/{id}', [NewsController::class, 'getNewsTag'])->name('admin.getNewsTag');
});

Route::group(['prefix' => 'irms'], function(){
    Route::get('/pages/{current_page}', [NewsController::class, 'irmsView'])->name('news.irmsView');
    Route::get('/detail/{slug}', [NewsController::class, 'detailIrms'])->name('news.detailIrms');
});

//Test Info
Route::group(['prefix' => 'testinfo'], function(){
    Route::get('/ajax-datatable', [TestInfoController::class, 'ajaxDataTable'])->name('testinfo.ajax-datatable');
    Route::post('/add', [TestInfoController::class, 'addTestInfo'])->name('testinfo.addTestInfo');
    Route::post('/edit', [TestInfoController::class, 'editTestInfo'])->name('testinfo.editTestInfo');
    Route::get('/delete/{id}', [TestInfoController::class, 'deleteTestInfo'])->name('testinfo.deleteTestInfo');
});

//Test Info
Route::group(['prefix' => 'survey'], function(){
    Route::get('/ajax-datatable', [SurveyController::class, 'ajaxDataTable'])->name('survey.ajax-datatable');
    Route::post('/add', [SurveyController::class, 'addSurvey'])->name('survey.addSurvey');
    Route::post('/edit', [SurveyController::class, 'editSurvey'])->name('survey.editSurvey');
});

//Order
Route::group(['prefix' => 'order', 'middleware' => 'auth'], function(){
    Route::post('/', [OrderController::class, 'addProject'])->name('order.addProject');
    Route::post('/add', [OrderController::class, 'addOrders'])->name('order.addOrders');
    Route::post('/set-session', [OrderController::class, 'setProjectSession'])->name('order.setProjectSession');
    Route::post('/confirm-quotation', [OrderController::class, 'confirmQuotation'])->name('order.confirmQuotation');
    Route::post('/confirm-pengiriman', [OrderController::class, 'pengirimanConfirm'])->name('order.pengirimanConfirm');
    Route::post('/confirm-preparasi', [OrderController::class, 'preparasiConfirm'])->name('order.preparasiConfirm');
    Route::post('/confirm-labtest', [OrderController::class, 'labtestConfirm'])->name('order.labtestConfirm');
    Route::post('/confirm-invoice', [OrderController::class, 'invoiceConfirm'])->name('order.invoiceConfirm');
    Route::get('/ajax-data', [OrderController::class, 'ajaxData'])->name('order.ajax');
    Route::post('/select-data', [OrderController::class, 'selectData'])->name('order.select');
    Route::get('/delete/{id}', [OrderController::class, 'deleteOrder'])->name('order.delete');
    Route::post('/edit', [OrderController::class, 'editData'])->name('order.edit');
    Route::post('/add-single', [OrderController::class, 'addData'])->name('order.addData');
});

Route::get('/{slug}', [PeopleController::class, 'peopleDetail'])->name('people.peopleDetail');