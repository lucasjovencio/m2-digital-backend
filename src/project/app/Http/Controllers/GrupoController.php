<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grupo\StoreGrupoRequest;
use App\Http\Requests\Grupo\UpdateGrupoRequest;
use App\Http\Resources\Grupo\GrupoCollection;
use App\Http\Resources\Grupo\GrupoResource;
use App\Models\Grupo;
use App\Services\Grupo\GrupoStoreService;
use App\Services\Grupo\GrupoUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class GrupoController extends Controller
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
            return new GrupoCollection(Grupo::paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Grupo\StoreGrupoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGrupoRequest $request,GrupoStoreService $grupoStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new GrupoResource($grupoStoreService->generate($request)),201);
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
            return $this->jsonResponseSuccess(new GrupoResource(Grupo::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Grupo\UpdateGrupoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGrupoRequest $request, $id,GrupoUpdateService $grupoUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new GrupoResource($grupoUpdateService->update($request,$id)),200);
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
            return $this->jsonResponseSuccess(Grupo::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
