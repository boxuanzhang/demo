<?php

namespace App\Repositories;

use App\Ip;
use Illuminate\Support\Facades\DB;

class IpRepository
{

	private $ip;

	/**
	 * IpRepository constructor.
	 * @param $ip
	 */
	public function __construct(Ip $ip)
	{
		$this->ip = $ip;
	}

	public function addNewIp(array $data)
	{
		DB::beginTransaction();

		try {
			$ip = new Ip;

			$ip->registry = $data[0];
			$ip->cc = $data[1];
			$ip->type = $data[2];
			$ip->start = $data[3];
			$ip->value = $data[4];
			$ip->date = $data[5];
			$ip->status = $data[6];

			$ip->save();

			echo "Have successfully imported ip of " . implode("|", $data) . "\n";
		} catch (\Exception $e) {
			DB::rollback();
			echo "Have unsuccessfully imported ip of " . implode("|", $data) . "\n";
		}

		DB::commit();
	}

	public function getASNNum()
	{
		return $this->ip
			->select('cc', DB::raw('count(*) as total'))
			->where('type', 'asn')
			->where('date', '>=', '20160000')
			->where('date', '<=', '20161231')
			->groupBy('cc')
			->get();
	}
}