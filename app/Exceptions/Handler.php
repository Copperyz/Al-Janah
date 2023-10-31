<?php

namespace App\Exceptions;

use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\Access\AuthorizationException;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array<int, class-string<Throwable>>
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array<int, string>
   */
  protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

  /**
   * Register the exception handling callbacks for the application.
   *
   * @return void
   */
  public function register()
  {
    $this->reportable(function (Throwable $e) {
      //
    });
  }

  public function render($request, Throwable $exception)
  {
    if ($exception instanceof NotFoundHttpException) {
      app()->setLocale(app()->getLocale());
      return response()->view('errors.pages-misc-error', [], 404);
    }

    if ($exception instanceof HttpException) {
      return response()->view('errors.pages-misc-under-maintenance', [], 500);
    }

    if ($exception instanceof AuthorizationException) {
      return response()->view('errors.pages-misc-not-authorized', [], 403);
    }

    return parent::render($request, $exception);
  }
}
