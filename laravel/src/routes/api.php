<?php
use App\Http\Controllers\api\DashboardApiController;

Route::get('/dashboard/online', [DashboardApiController::class, 'online']);