<?php

namespace App\Http\Controllers;

use App\Http\Requests\Desconto\StoreDescontoRequest;
use App\Http\Resources\Desconto\DescontoCollection;
use App\Http\Resources\Desconto\DescontoResource;
use App\Models\Desconto;
use App\Services\Desconto\DescontoStoreService;
use App\Services\Desconto\DescontoUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class DescontoController extends Controller
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
            return new DescontoCollection(Desconto::paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Desconto\StoreDescontoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDescontoRequest $request,DescontoStoreService $descontoStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new DescontoResource($descontoStoreService->generate($request)),201);
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
            return $this->jsonResponseSuccess(new DescontoResource(Desconto::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,DescontoUpdateService $descontoUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new DescontoResource($descontoUpdateService->update($request,$id)),200);
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
            return $this->jsonResponseSuccess(Desconto::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
