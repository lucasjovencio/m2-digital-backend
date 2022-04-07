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
    /**
     * @OA\Get(
     *      path="/cidade-grupos",
     *      operationId="getCidadeGrupoList",
     *      tags={"Cidades e Grupos"},
     *      summary="Lista de cidades e grupos",
     *      description="Retorna a lista de cidades e grupos",
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
            return new CidadeGrupoCollection(CidadeGrupo::has('cidade')->has('grupo')->with(['cidade','grupo'])->paginate(5));
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
    /**
     * @OA\Post(
     *      path="/cidade-grupos",
     *      operationId="postCidadeGrupo",
     *      tags={"Cidades e Grupos"},
     *      summary="Nova cidade no grupo",
     *      description="Cadastra nova cidade no grupo",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="cidades_id",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="grupos_id",
     *                     type="integer"
     *                 ),
     *                 example={"cidades_id": 1,"grupos_id":1}
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
    /**
     * @OA\Get(
     *      path="/cidade-grupos/{id}",
     *      operationId="getCidadeGrupoShow",
     *      tags={"Cidades e Grupos"},
     *      summary="Cidade e Grupo",
     *      description="Retorna a cidade e grupo",
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
    /**
     * @OA\Put(
     *      path="/cidade-grupos/{id}",
     *      @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *      ),
     *      operationId="PutCidadeGrupo",
     *      tags={"Cidades e Grupos"},
     *      summary="Atualiza a Cidade no Grupo",
     *      description="Retorna a cidade e grupo",
     *      @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="cidades_id",
     *                     type="integer"
     *                 ),
     *                  @OA\Property(
     *                     property="grupos_id",
     *                     type="integer"
     *                 ),
     *                 example={"cidades_id": "1","grupos_id":"1"}
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
