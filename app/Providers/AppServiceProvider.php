<?php

namespace App\Providers;

use App\Models\bahanBakuModel;
use App\Models\satuanModel;
use App\Policies\bahanBakuPolicy;
use App\Policies\SatuanPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
}
