<?php

namespace App\Http\Controllers\Api;

use App\Ip;
use App\Repositories\IpRepository;
use App\Transformer\IpTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IpController extends Controller
{

	protected $ipRepositories;
	protected $ipTransformer;

	/**
	 * IpController constructor.
	 * @param $ipRepositories
	 */
	public function __construct(IpRepository $ipRepositories, IpTransformer $ipTransformer)
	{
		$this->ipRepositories = $ipRepositories;
		$this->ipTransformer = $ipTransformer;
	}


	public function getASNIps()
	{
		return response()->json($this->ipTransformer->transformASNIps($this->ipRepositories->getASNNum()->toArray()));
	}
}
