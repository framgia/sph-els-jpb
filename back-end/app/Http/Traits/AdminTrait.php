<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait AdminTrait
{
  protected function isAdmin()
  {
    if (!Gate::allows('admin', auth()->user())) {
      throw new AuthorizationException('Unauthorized', 403);
    }
  }
}
