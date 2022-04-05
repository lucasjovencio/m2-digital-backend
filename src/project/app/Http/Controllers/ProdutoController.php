<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Http\Resources\Produto\ProdutoCollection;
use App\Http\Resources\Produto\ProdutoResource;
use App\Models\Produto;
use App\Services\Produto\ProdutoStoreService;
use App\Services\Produto\ProdutoUpdateService;
use App\Traits\JsonResponseTrait;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
            return new ProdutoCollection(Produto::paginate(5));
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Produto\StoreProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request,ProdutoStoreService $produtoStoreService)
    {
        try{
            return $this->jsonResponseSuccess(new ProdutoResource($produtoStoreService->generate($request)),201);
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
            return $this->jsonResponseSuccess(new ProdutoResource(Produto::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Produto\UpdateProdutoRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdutoRequest $request, $id,ProdutoUpdateService $produtoUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new ProdutoResource($produtoUpdateService->update($request,$id)),200);
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
            return $this->jsonResponseSuccess(Produto::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
