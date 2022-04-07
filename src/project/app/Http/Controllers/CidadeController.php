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
    /**
     * @OA\Get(
     *      path="/cidades",
     *      operationId="getCidadeList",
     *      tags={"Cidades"},
     *      summary="Lista de cidades",
     *      description="Retorna a lista de cidades",
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
    /**
     * @OA\Post(
     *      path="/cidades",
     *      operationId="postCidade",
     *      tags={"Cidades"},
     *      summary="Nova cidade",
     *      description="Cadastra e retorna a cidade",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ),
     *                 example={"nome": "Cidade"}
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
    /**
     * @OA\Get(
     *      path="/cidades/{id}",
     *      operationId="getCidadeShow",
     *      tags={"Cidades"},
     *      summary="Cidade",
     *      description="Retorna a cidade",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
            return $this->jsonResponseSuccess(new CidadeResource(Cidade::findOrFail($id)),200);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
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
    /**
     * @OA\Put(
     *      path="/cidades/{id}",
     *      operationId="putCidade",
     *      tags={"Cidades"},
     *      summary="Atualiza a Cidade",
     *      description="Atualiza e retorna a cidade",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ),
     *                 example={"nome": "Cidade +"}
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
     *          response=404,
     *          description="Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server error"
     *      )
     *     )
    */
    public function update(UpdateCidadeRequest $request, $id,CidadeUpdateService $cidadeUpdateService)
    {
        try{
            return $this->jsonResponseSuccess(new CidadeResource($cidadeUpdateService->update($request,$id)),200);
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
     *      path="/cidades/{id}",
     *      operationId="deleteCidade",
     *      tags={"Cidades"},
     *      summary="Remove a cidade",
     *      description="Remove a cidade",
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
            return $this->jsonResponseSuccess(Cidade::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
