<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorCreateRequest;
use App\Repositories\All\Color\ColorInterface;
use Illuminate\Http\Request;

class ColorSettingController extends Controller
{
    protected $colorInterface;

    public function __construct(ColorInterface $colorInterface)
    {
        $this->colorInterface = $colorInterface;
    }

    public function index(){

    }

    public function store(ColorCreateRequest $request){

        $validatedColor = $request->validated();
        $this->colorInterface->create($validatedColor);

        return response()->json([
            'message' => 'Color Created successfully!',
        ], 201);
    }

    public function show($id){

    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }

}
