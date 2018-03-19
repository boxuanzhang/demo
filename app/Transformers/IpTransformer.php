<?php

namespace App\Transformer;

/**
 * Class IpTransformer
 * @package App\Transformer
 */
class IpTransformer
{

	public function transformASNIps(array $data)
	{
		$ret = [];
		foreach ($data as $item) {
			$ret[] = [
				'Economy'  => $item['cc'],
				'Resource' => 'ASN',
				'Total'    => $item['total'],
			];
		}

		return $ret;
	}

}