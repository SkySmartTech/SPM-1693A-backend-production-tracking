<?php

namespace App\Http\Controllers\CheckPoint;

use App\Http\Controllers\Controller;
use App\Repositories\All\CheckPoint\CheckPointInterface;
use Illuminate\Http\Request;

class CheckPointController extends Controller
{
    protected $checkPointInterface;

    public function __construct(CheckPointInterface $checkPointInterface)
    {
        $this->checkPointInterface = $checkPointInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkPoints = $this->checkPointInterface->all()->pluck('CheckPointName');
        return response()->json($checkPoints, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checkPoint = $this->checkPointInterface->findById($id);
        return response()->json($checkPoint, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
