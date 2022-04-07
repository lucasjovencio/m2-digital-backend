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
    /**
     * @OA\Get(
     *      path="/campanha-produtos",
     *      operationId="getCampanhaProdutoList",
     *      tags={"Campanhas e Produtos"},
     *      summary="Campanhas e produtos",
     *      description="Retorna campanhas e produtos",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
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
    /**
     * @OA\Post(
     *      path="/campanha-produtos",
     *      operationId="CampanhaProduto",
     *      tags={"Campanhas e Produtos"},
     *      summary="Novo produto na campanha",
     *      description="Cadastra produto na campanha",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="campanhas_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="produtos_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="descontos_id",
     *                     type="integer"
     *                 ),
     *                 example={"campanhas_id": "1","produtos_id":"1"}
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Failed",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
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
    /**
     * @OA\Get(
     *      path="/campanha-produtos/{id}",
     *      operationId="getCampanhaProdutoShow",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      tags={"Campanhas e Produtos"},
     *      summary="Produto e Campanha",
     *      description="Retorna Produto e Campanha",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
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
    /**
     * @OA\Put(
     *      path="/campanha-produtos/{id}",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *      ),
     *      operationId="CampanhaProdutoPut",
     *      tags={"Campanhas e Produtos"},
     *      summary="Atualização de produto e campanha",
     *      description="Atualiza produto e campanha",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="campanhas_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="produtos_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="descontos_id",
     *                     type="integer"
     *                 ),
     *                 example={"campanhas_id": "1","produtos_id":"1"}
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation Failed",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
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
    /**
     * @OA\Delete(
     *      path="/campanha-produtos/{id}",
     *      operationId="deleteCampanhaProduto",
     *      tags={"Campanhas e Produtos"},
     *      summary="Remove o produto da campanha",
     *      description="Remove o produto da campanha",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
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
