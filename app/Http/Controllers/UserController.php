<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Auth;
use Hash;

class UserController extends ApiCRUDController
{
  protected $model = User::class;

  protected $resource = UserResource::class;

  protected function getValidationRules($isNew, $model = null)
  {
    if ($isNew) {
      $rules = [
        'name' => 'required|unique:users|min:3|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:6',
      ];
    } else {
      $rules = [
        'name' => 'required|unique:users|max:255',
        'email' => 'required|unique:users|max:255',
        'password' => 'min:6',
      ];
      if (isset($model)) {
        /** @var User $model */
        $id = $model->id;

        $rules['name'] = "required|unique:users,name,$id|max:255";
        $rules['email'] = "required|email|unique:users,email,$id|max:255";
      }
    }

    return array_merge(parent::getValidationRules($isNew), $rules);
  }

  protected function beforeSave($model, $isNew)
  {
    /** @var User $model */
    parent::beforeSave($model, $isNew);

    if ($model->isDirty('password')) {
      $model->password = Hash::make($model->password);
    }
  }

  protected function canDelete($model)
  {
    $can = parent::canDelete($model);

    /** @var User $model */
    return $can && $model->id !== Auth::user()->id;
  }
}
