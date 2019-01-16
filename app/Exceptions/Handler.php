<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //dd($exception);

        switch ($exception->getMessage()) {
            case 'No query results for model [App\Post].':
                return response()->json('Post not found', 404);
                break;
            case 'No query results for model [App\Category].':
                return response()->json('Category not found', 404);
                break;
            case 'No query results for model [App\Tag].':
                return response()->json('Tag not found', 404);
                break;
                case 'No query results for model [App\Comment].':
                    return response()->json('Comment not found', 404);
                    break;
            default:
            return parent::render($request, $exception);
                break;
        }
        return parent::render($request, $exception);
    }
}
