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
    /**
     * @OA\Get(
     *      path="/descontos",
     *      operationId="getDescontoList",
     *      tags={"Descontos"},
     *      summary="Lista de descontos",
     *      description="Retorna a lista de descontos",
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
    /**
     * @OA\Post(
     *      path="/descontos",
     *      operationId="postDesconto",
     *      tags={"Descontos"},
     *      summary="Novo desconto",
     *      description="Cadastra novo desconto",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="valor",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="tipo",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="ativo",
     *                     type="integer"
     *                 ),
     *                 example={"nome": "desconto +","valor":"25,43","tipo":0,"ativo":1}
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
    /**
     * @OA\Get(
     *      path="/descontos/{id}",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      operationId="getDescontoShow",
     *      tags={"Descontos"},
     *      summary="Desconto",
     *      description="Retorna o desconto",
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
    /**
     * @OA\Put(
     *      path="/descontos/{id}",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      operationId="getDescontoPut",
     *      tags={"Descontos"},
     *      summary="Atualiza desconto",
     *      description="Retorna o desconto",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="nome",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="valor",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="tipo",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="ativo",
     *                     type="integer"
     *                 ),
     *                 example={"nome": "desconto +","valor":"25,43","tipo":0,"ativo":1}
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
    /**
     * @OA\Delete(
     *      path="/descontos/{id}",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      operationId="removeDesconto",
     *      tags={"Descontos"},
     *      summary="Remove desconto",
     *      description="Remove o desconto",
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
            return $this->jsonResponseSuccess(Desconto::findOrFail($id)->delete(),204);
        }catch(ModelNotFoundException $e){
            return $this->jsonResponseError("No query results for model",404);
        }catch(Exception $e){
            return $this->jsonResponseError($e->getMessage(),$e->getCode());
        }
    }
}
