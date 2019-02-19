<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;

class JsonApiMiddleware
{

	protected $contentType = 'application/vnd.api+json';

	/**
	 * The Response Factory our app uses
	 *
	 * @var ResponseFactory
	 */
	protected $factory;

	/**
	 * JsonMiddleware constructor.
	 *
	 * @param ResponseFactory $factory
	 */
	public function __construct(ResponseFactory $factory)
	{
		$this->factory = $factory;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// First, set the header so any other middleware knows we're
		// dealing with a should-be JSON response.
		$request->headers->set('Accept', $this->contentType);

		// Get the response
		$response = $next($request);

		// If the response is not strictly a JsonResponse, we make it

		if (!$response instanceof JsonResponse) {
			$response = $this->factory->json(
				$response->content(),
				$response->status(),
				$response->headers->all()
			);
		}

		$response->header('Content-Type', $this->contentType);

		if (config('app.debug')) {
			$response->setContent(
				json_encode(
					json_decode($response->getContent(),true),JSON_PRETTY_PRINT
					|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
				)
			);
		}

		return $response;
	}
}