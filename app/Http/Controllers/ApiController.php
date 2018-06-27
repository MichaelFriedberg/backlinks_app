<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get links
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function links()
    {
        $links = Link::orderBy('name')->get(['name', 'url']);

        return $this->successResponse(compact('links'));
    }

    /**
     * Return an error response
     *
     * @param null $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($message = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ]);
    }

    /**
     * Return a success response with given data
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse($data)
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
