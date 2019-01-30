<?php

namespace App\Traits;

trait PaginatedIndex
{
	protected function paginateIndex($service, $path, $view, $var)
	{
		$data = $service->getPagesPaginated($path);

		return view($view, [
			$var => $data,
		]);
	}
}