<?php

namespace App\Transformer;

/**
 * Class IpTransformer
 * @package App\Transformer
 */
/**
 * Class IpTransformer
 * @package App\Transformer
 */
class IpTransformer
{

	/**
	 * @param array $data
	 * @return array
	 */
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

	/**
	 * @param array $data
	 * @return array
	 */
	public function transformCC(array $data)
	{
		$ret = [];
		foreach ($data as $item) {
			$ret[] = [
				'Economy' => $item['cc'],
				'Total'   => $item['total'],
			];
		}

		return $ret;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function transformType(array $data)
	{
		$ret = [];
		foreach ($data as $item) {
			$ret[] = [
				'Type'  => $item['type'],
				'Total' => $item['total'],
			];
		}

		return $ret;
	}

	/**
	 * @param array $data
	 * @return array
	 */
	public function transformCCAndType(array $data)
	{
		$ret = [];
		foreach ($data as $item) {
			$ret[$item['cc']][$item['type']] = $item['total'];
			$ret[$item['cc']]['cc'] = $item['cc'];
		}

		return $ret;
	}

	public function transformYear(array $data)
	{
		$ret = [];
		foreach ($data as $item) {
			$ret[$item['year(date)']][$item['type']] = $item['total'];
			$ret[$item['year(date)']]['year'] = $item['year(date)'];
		}

		return $ret;
	}
}