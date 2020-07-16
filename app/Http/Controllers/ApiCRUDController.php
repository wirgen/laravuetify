<?php /** @noinspection RedundantSuppression */

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class ApiCRUDController extends ApiController
{
  /**
   * @var Model
   */
  protected $model;

  /**
   * @var JsonResource
   */
  protected $resource;

  /**
   * @return AnonymousResourceCollection
   */
  public function index()
  {
    $query = $this->model::query();

    return $this->resource::collection($query->get());
  }

  /**
   * @param Request $request
   * @return JsonResource|JsonResponse
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), $this->getValidationRules(true));
    if ($validator->fails()) {
      return response()
        ->json(['errors' => $validator->errors()],
          Response::HTTP_BAD_REQUEST);
    }

    /** @var Model $model */
    $model = new $this->model;
    $model->fill($this->paramsAlter($request->all(), true));
    $this->beforeSave($model, true);
    $model->save();
    $this->afterSave($model, true);

    return new $this->resource($model);
  }

  /**
   * @param int $id
   * @return JsonResource|JsonResponse
   */
  public function show($id)
  {
    try {
      $model = $this->getModel($id);
    } catch (ReflectionException $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_INTERNAL_SERVER_ERROR);
    } catch (Exception $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_NOT_FOUND);
    }

    return new $this->resource($model);
  }

  /**
   * @param Request $request
   * @param int $id
   * @return JsonResource|JsonResponse
   */
  public function update(Request $request, $id)
  {
    try {
      $model = $this->getModel($id);
    } catch (ReflectionException $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_INTERNAL_SERVER_ERROR);
    } catch (Exception $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_NOT_FOUND);
    }

    $validator = Validator::make($request->all(), $this->getValidationRules(false, $model));
    if ($validator->fails()) {
      return response()
        ->json(['errors' => $validator->errors()],
          Response::HTTP_BAD_REQUEST);
    }

    $model->fill($this->paramsAlter($request->all(), false));
    $this->beforeSave($model, false);
    $model->save();
    $this->afterSave($model, false);

    return new $this->resource($model);
  }

  /**
   * @param int $id
   * @return JsonResponse
   */
  public function destroy($id)
  {
    try {
      $model = $this->getModel($id);
    } catch (ReflectionException $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_INTERNAL_SERVER_ERROR);
    } catch (Exception $e) {
      return response()
        ->json(['error' => $e->getMessage()],
          Response::HTTP_NOT_FOUND);
    }

    if (!$this->canDelete($model)) {
      try {
        return response()->json([
          'error' => __('model.not_delete', [
            'model' => (new ReflectionClass($this->model))->getShortName(),
          ]),
        ], Response::HTTP_FORBIDDEN);
      } catch (ReflectionException $e) {
        return response()
          ->json(['error' => $e->getMessage()],
            Response::HTTP_INTERNAL_SERVER_ERROR);
      }
    }

    try {
      $model->delete();
    } catch (Exception $ex) {
      response()
        ->json(['error' => $ex->getMessage()],
          Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    return response()->json(null, Response::HTTP_NO_CONTENT);
  }

  /**
   * @param bool $isNew
   * @param Model|null $model
   * @return array
   * @noinspection PhpUnusedParameterInspection
   */
  protected function getValidationRules($isNew, $model = null)
  {
    return [];
  }

  /**
   * @param array $params
   * @param bool $isNew
   * @return array
   * @noinspection PhpUnusedParameterInspection
   */
  protected function paramsAlter($params, $isNew)
  {
    return $params;
  }

  /**
   * @param Model $model
   * @param bool $isNew
   * @noinspection PhpUnusedParameterInspection
   */
  protected function beforeSave($model, $isNew)
  {
  }

  /**
   * @param Model $model
   * @param bool $isNew
   * @noinspection PhpUnusedParameterInspection
   */
  protected function afterSave($model, $isNew)
  {
  }

  /**
   * @param Model $model
   * @return bool
   * @noinspection PhpUnusedParameterInspection
   */
  protected function canDelete($model)
  {
    return true;
  }

  /**
   * @param $id
   * @return Model
   * @throws ReflectionException|Exception
   */
  private function getModel($id)
  {
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    $model = $this->model::find($id);
    if ($model === null) {
      throw new Exception(__('model.not_found', [
        'model' => (new ReflectionClass($this->model))->getShortName(),
      ]));
    }

    return $model;
  }
}
