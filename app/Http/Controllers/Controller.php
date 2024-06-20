<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $desi_scopes;
    public function __construct()
    {
        $this->desi_scopes = config('constants.DESIGNATION_SCOPE');
        view()->share('desi_scopes', $this->desi_scopes);
    }

}
