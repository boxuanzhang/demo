<?php

namespace App\Http\Controllers\Api;

use App\Ip;
use App\Repositories\IpRepository;
use App\Transformer\IpTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class IpController
 * @package App\Http\Controllers\Api
 */
class IpController extends Controller
{

	/**
	 * @var IpRepository
	 */
	protected $ipRepositories;
	/**
	 * @var IpTransformer
	 */
	protected $ipTransformer;

	/**
	 * IpController constructor.
	 * @param IpRepository $ipRepositories
	 * @param IpTransformer $ipTransformer
	 */
	public function __construct(IpRepository $ipRepositories, IpTransformer $ipTransformer)
	{
		$this->ipRepositories = $ipRepositories;
		$this->ipTransformer = $ipTransformer;
	}


	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getASNIps()
	{
		return response()->json($this->ipTransformer->transformASNIps($this->ipRepositories->getASNNum()->toArray()));
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getIpsGroupByCC()
	{
		return response()->json($this->ipTransformer->transformCC($this->ipRepositories->getIpsGroupByCC()->toArray()));
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getIpsGroupByType()
	{
		return response()->json($this->ipTransformer->transformType($this->ipRepositories->getIpsGroupByType()->toArray()));
	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getIpsGroupByCCAndType()
	{
		return response()->json($this->ipTransformer->transformCCAndType($this->ipRepositories->getIpsGroupByCCType()->toArray()));
	}

	public function getIpsGroupByYear()
	{
		return response()->json($this->ipTransformer->transformYear($this->ipRepositories->getIpsGroupByYear()->toArray()));
	}
}
