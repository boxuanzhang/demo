<?php

namespace App\Console\Commands;

use App\Services\ApnicService;
use Illuminate\Console\Command;

/**
 * Class ImportIpData
 * @package App\Console\Commands
 */
class ImportIpData extends Command
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'import_ip_data';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import IP records from APNIC api';

	/**
	 * @var ApnicService
	 */
	protected $apnicService;

	/**
	 * ImportIpData constructor.
	 * @param ApnicService $apnicService
	 */
	public function __construct(ApnicService $apnicService)
	{
		parent::__construct();

		$this->apnicService = $apnicService;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->apnicService->importData();
	}
}
