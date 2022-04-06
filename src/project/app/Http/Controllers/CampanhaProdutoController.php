<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampanhaProduto\StoreCampanhaProdutoRequest;
use App\Http\Requests\CampanhaProduto\UpdateCampanhaProdutoRequest;
use App\Http\Resources\CampanhaProduto\CampanhaProdutoCollection;
use App\Http\Resources\CampanhaProduto\CampanhaProdutoResource;
use App\Models\CampanhaProduto;
use App\Services\CampanhaProduto\CampanhaProdutoStoreService;
use App\Services\CampanhaProduto\CampanhaProdutoUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CampanhaProdutoController extends Controller
{
    use JsonResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return new CampanhaProdutoCollection(CampanhaProduto::with(['campanha','produto','desconto'])->paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CampanhaProduto\StoreCampanhaProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampanhaProdutoRequest $request,CampanhaProdutoStoreService $campanhaProdutoStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new CampanhaProdutoResource($campanhaProdutoStoreService->generate($request)),201);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            return $this->jsonResponseSuccess(new CampanhaProdutoResource(CampanhaProduto::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CampanhaProduto\UpdateCampanhaProdutoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampanhaProdutoRequest $request, $id,CampanhaProdutoUpdateService $campanhaProdutoUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new CampanhaProdutoResource($campanhaProdutoUpdateService->update($request,$id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            return $this->jsonResponseSuccess(CampanhaProduto::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
