<?php


namespace App\Http\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Arr;

trait ResponseTrait
{

    public function perPage()
    {
        return request()->per_page ?? 20;
    }

    public function page()
    {
        return request()->page ?? 1;
    }

    public function isProd(): bool
    {
        $liveModes = [
            "prod",
            "live",
            "production",
        ];

        $env = config("app.env");

        if (in_array($env, $liveModes)) {
            return true;
        }

        return false;
    }

    /**
     * Set failed response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function failedResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.failed'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 424);
    }

    /**
     * Set success response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function successResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.success'),
            'code' => config('appconfig.code.success'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response);
    }

    /**
     * Set success response
     *
     * @param $message
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function successResponseWithResource($message, $data, $meta = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.success'),
            'code' => config('appconfig.code.success'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        if (!empty($meta)) {
            $response['meta'] = $meta;
        }


        return Response::json($response);
    }

    /**
     * Set success response
     *
     * @param $message
     * @param mixed $data
     *
     * @return JsonResponse
     */
    public function successResponseWithPaginatedResource(
        $message,
        $data
    ): JsonResponse {
        $response = [
            'status' => config('appconfig.status.success'),
            'code' => config('appconfig.code.success'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $items = $data->items();
            $response['data'] = [
                'items' => $items,
                'meta' => [ // Create 'meta' object for pagination information
                    'current_page' => $data->currentPage(),
                    'total' => $data->total(),
                    'total_pages' => $data->lastPage(),
                    // Other pagination info if needed
                ],
            ];
        };

        return Response::json($response);
    }

    /**
     * Set success response
     *
     * @param $message
     * @param $collection
     *
     * @return JsonResponse
     */
    public function successResponseWithCollection($message, $collection): JsonResponse
    {
        return Response::json(array_merge([
            'status' => config('appconfig.status.success'),
            'code' => config('appconfig.code.success'),
            'message' => $message,
        ], (array) $collection));
    }


    /**
     * Set server error response
     *
     * @param $message
     * @param Exception|null $exception
     * @return JsonResponse
     */
    public function serverErrorResponse($message, \Exception $exception = null): JsonResponse
    {
        if ($exception !== null) {
            Log::error(
                "{$exception->getMessage()} on line {$exception->getLine()} in {$exception->getFile()}"
            );
        }
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.server_error'),
            'message' => ($this->isProd()) ? "There was an error in your request" : $message,
        ];

        if (config('app.debug')) {
            $response['debug'] = $this->appendDebugData($exception);
        }

        return Response::json($response, ($this->isProd()) ? 406 : 500);
    }

    /**
     * Set server error response
     *
     * @param $message
     * @param \Error|null $error
     * @return JsonResponse
     */
    public function errorResponse($message, \Error $error = null): JsonResponse
    {
        if ($error !== null) {
            Log::error(
                "{$error->getMessage()} on line {$error->getLine()} in {$error->getFile()}"
            );
        }
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.server_error'),
            'message' => ($this->isProd()) ? "There was an error in your request" : $message,
        ];

        if (config('app.debug')) {
            $response['debug'] = $this->appendDebugData($error);
        }

        return Response::json($response, ($this->isProd()) ? 406 : 500);
    }

    /**
     * Append debug data to the response data returned.
     */
    protected function appendDebugData($exception): array
    {
        return [
            'message' => $exception->getMessage(),
            'exception' => get_class($exception),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => collect($exception->getTrace())->map(function ($trace) {
                return Arr::except($trace, ['args']);
            })->all(),
        ];
    }

    /**
     * Set not found response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function notFoundResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.not_found'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }
        return Response::json($response, 404);
    }

    /**
     * Set not allowed response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function notAllowedResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.not_allowed'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 403);
    }

    /**
     * Set form validation errors
     *
     * @param $errors
     * @param array $data
     * @return JsonResponse
     */
    public function formValidationResponse($errors, array $data = [], $message = 'Whoops. Validation failed'): JsonResponse
    {
        foreach ($errors->toArray() as $key => $value) {
            $message = $value[0];
        }
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.failed'),
            'message' => $message,
            'errors' => $data,
        ];

        return Response::json($response, 406);
    }

    /**
     * Set not exist response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function notExistResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.not_exist'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 406);
    }

    /**
     * Set exist response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function existsResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.exists'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 409);
    }

    /**
     * Set network error response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function networkErrorResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.network_error'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 503);
    }

    /**
     * Set bad request response
     *
     * @param $message
     * @param array $data
     * @return JsonResponse
     */
    public function badRequestResponse($message, array $data = []): JsonResponse
    {
        $response = [
            'status' => config('appconfig.status.failed'),
            'code' => config('appconfig.code.bad_request'),
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        return Response::json($response, 400);
    }

    /**
     * Return paginated data
     *
     * @return array
     */
    public function paginate(): array
    {
        $request = request();
        if ($request->per_page and $request->per_page > 10000) {
            $per_page = 10000;
        }
        return [
            "per_page" => $per_page ?? 20,
            "page" => $request->page ?? 1
        ];
    }
}