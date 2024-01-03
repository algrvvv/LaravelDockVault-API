<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return MovieResource::collection(Movie::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $request): MovieResource
    {
        return new MovieResource(Movie::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): MovieResource
    {
        return new MovieResource($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, Movie $movie): MovieResource
    {
        $movie->update($request->all());

        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): JsonResponse
    {
        $movie->delete();

        return response()->json([
            "data" => "Successfully deleted"
        ]);
    }
}
