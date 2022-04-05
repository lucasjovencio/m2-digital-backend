<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campanha\StoreCampanhaRequest;
use App\Http\Requests\Campanha\UpdateCampanhaRequest;
use App\Http\Resources\Campanha\CampanhaCollection;
use App\Http\Resources\Campanha\CampanhaResource;
use App\Models\Campanha;
use App\Services\Campanha\CampanhaStoreService;
use App\Services\Campanha\CampanhaUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CampanhaController extends Controller
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
            return new CampanhaCollection(Campanha::paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Campanha\StoreCampanhaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampanhaRequest $request,CampanhaStoreService $cidadeStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new CampanhaResource($cidadeStoreService->generate($request)),201);
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
            return $this->jsonResponseSuccess(new CampanhaResource(Campanha::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError($e->getMessage(),404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Campanha\UpdateCampanhaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampanhaRequest $request, $id,CampanhaUpdateService $cidadeUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new CampanhaResource($cidadeUpdateService->update($request,$id)),200);
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
            return $this->jsonResponseSuccess(Campanha::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError($e->getMessage(),404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
