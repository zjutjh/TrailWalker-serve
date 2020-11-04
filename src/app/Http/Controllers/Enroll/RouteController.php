<?php

namespace App\Http\Controllers\Enroll;

use App\Http\Controllers\Controller;
use App\User;
use App\Apply;
use App\Group;
use App\WalkRoute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * 查询路线列表
     * @param Request $request
     * @return JsonResponse
     */
    public function getRouteList(Request $request)
    {
        return StandardSuccessJsonResponse(WalkRoute::orderBy('id', 'asc')->get());
    }


}