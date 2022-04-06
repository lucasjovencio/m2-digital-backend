<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeGrupo\StoreCidadeGrupoRequest;
use App\Http\Requests\CidadeGrupo\UpdateCidadeGrupoRequest;
use App\Http\Resources\CidadeGrupo\CidadeGrupoCollection;
use App\Http\Resources\CidadeGrupo\CidadeGrupoResource;
use App\Models\CidadeGrupo;
use App\Services\CidadeGrupo\CidadeGrupoStoreService;
use App\Services\CidadeGrupo\CidadeGrupoUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CidadeGrupoController extends Controller
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
            return new CidadeGrupoCollection(CidadeGrupo::with(['cidade','grupo'])->paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CidadeGrupo\StoreCidadeGrupoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCidadeGrupoRequest $request,CidadeGrupoStoreService $cidadeGrupoStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new CidadeGrupoResource($cidadeGrupoStoreService->generate($request)),201);
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
            return new CidadeGrupoResource(CidadeGrupo::findOrFail($id));
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CidadeGrupo\UpdateCidadeGrupoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCidadeGrupoRequest $request, $id,CidadeGrupoUpdateService $cidadeGrupoUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new CidadeGrupoResource($cidadeGrupoUpdateService->update($request,$id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(ValidationException $e){
            return $this->jsonResponseErrorValidation([
                "error"     =>  $e->validator->errors(),
                "message"   => 'Validation Failed'
            ],422);
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
            return $this->jsonResponseSuccess(CidadeGrupo::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
