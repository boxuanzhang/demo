<?php

namespace App\Services;

use App\Ip;
use App\Repositories\IpRepository;

class ApnicService
{

	protected $ipRepository;

	/**
	 * ApnicService constructor.
	 * @param $ipRepository
	 */
	public function __construct(IpRepository $ipRepository)
	{
		$this->ipRepository = $ipRepository;
	}

	public function importData()
	{
		$file = explode("\n", $this->getData());

		foreach ($file as $line) {
			try {
				if (substr($line, 0, 1) === "#") {
					continue;
				}

				if (substr($line, 0, 1) === "2") {
					continue;
				}
				$line = explode('|', $line);
				if (!count($line)) {
					echo 'Have successfully imported all records!';
					break;
				}
				if ($line[1] == '*') {
					continue;
				}
				$this->ipRepository->addNewIp($line);
			} catch (\Exception $e) {
				echo 'Have unsuccessfully imported ip of !' . implode('|', $line);
			}
		}
	}

	public function getData()
	{
		try {
			$ctx = stream_context_create([
					'http' => [
						'timeout' => 20
					]
				]
			);
			$file = file_get_contents(env('APNIC_URL'), 0, $ctx);

			return $file;
		} catch (\Exception $e) {
			return 'Can not get correct content';
		}
	}

	public function test()
	{
		$this->ipRepository->getASNNum();
	}
}