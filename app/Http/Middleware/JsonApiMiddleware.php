<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use Closure;

class JsonApiMiddleware
{
    const PARSED_METHODS = [
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
    ];

    protected $contentType = 'application/vnd.api+json';

    protected $typesServices = [
		'categories' => 'App\Services\CategoryService',
		'tags' => 'App\Services\TagService',
		'pages' => 'App\Services\PageService',
		'page-comments' => 'App\Services\PageCommentService',
		'post-comments' => 'App\Services\PostCommentService',
		'roles' => 'App\Services\RoleService',
		'permissions' => 'App\Services\PermissionService',
		'users' => 'App\Services\UserService',
		'metatags' => 'App\Services\MetatagService',
    ];

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
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
		$this->isLocalIp($request);

        if (in_array($request->getMethod(), self::PARSED_METHODS)) {

            $content = $request->json()->all();

            $request->replace($content['data']);

            $id = $request->get('id');
            $type = $request->get('type');
            if ($request->getMethod() == 'PATCH' && ! empty($id) && ! empty($type)) {
                $this->mergeNewData($request, $id, $type);
            }
        }

        $request->headers->set('Accept', $this->contentType);

        $response = $next($request);

        if (! $response instanceof JsonResponse) {
            $response = $this->factory->json($response->content(), $response->status(), $response->headers->all());
        }

        $response->header('Content-Type', $this->contentType);

        if (config('app.debug')) {
            $response->setContent(json_encode(json_decode($response->getContent(), true), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }

        return $response;
    }

    private function isLocalIp(Request $request){

		if (!in_array($request->ip(), ['::1', '127.0.0.1', 'localhost'])) {
			abort(403, 'Access denied');
		}

	}

    private function mergeNewData(&$request, $id, $type)
    {
        $service = $this->typesServices[$type];

        if (empty($service)) {
            return false;
        }

        $chosenService = app($service);

        $mergeData = $chosenService->mergeNewData($request->input('attributes')??[], $id);

        if (!$mergeData){
            abort(404);
        }

        $request->merge(['attributes' => $mergeData]);

        return true;
    }
}