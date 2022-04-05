<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\JsonResponseTrait;
use App\Http\Requests\Cidade\StoreCidadeRequest;
use App\Http\Requests\Cidade\UpdateCidadeRequest;
use App\Http\Resources\Cidade\CidadeCollection;
use App\Http\Resources\Cidade\CidadeResource;
use App\Models\Cidade;
use App\Services\Cidade\CidadeStoreService;
use App\Services\Cidade\CidadeUpdateService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CidadeController extends Controller
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
            return new CidadeCollection(Cidade::paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Cidade\StoreCidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCidadeRequest $request,CidadeStoreService $cidadeStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new CidadeResource($cidadeStoreService->generate($request)),201);
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
            return $this->jsonResponseSuccess(new CidadeResource(Cidade::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError($e->getMessage(),404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Cidade\UpdateCidadeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCidadeRequest $request, $id,CidadeUpdateService $cidadeUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new CidadeResource($cidadeUpdateService->update($request,$id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError($e->getMessage(),404);
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
            return $this->jsonResponseSuccess(Cidade::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError($e->getMessage(),404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
