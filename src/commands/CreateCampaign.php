<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Fastwebmedia\LaravelVouchering\core\Factories\CampaignFactory;

class CampaignCreate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'campaign:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Set up a new voucher campaign.';

    /**
     * Create a new CampaignFactory instance.
     *
     * CampaignFactory instance
     *
     * @var CampaignFactory
     */
    protected $campaign;

	/**
	 * Create a new CampaignCreateCommand instance.
	 *
     * @param CampaignFactory @campaign
	 * @return void
	 */
	public function __construct()
	{
        parent::__construct();
		$this->campaign = New CampaignFactory;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->line('Setting up your new voucher campaign...');

        $this->comment("Campaign Configuration:");

        $datestamp = date('my');
        $name = $this->ask('What is the name of your campaign?');
        $brand = $this->ask('What is your campaign brand?');

        $urn = Str::slug($name).'-'.$datestamp;

        $correctUrn = false;

        while ( ! $correctUrn)
        {
            if ( ! $this->confirm("Is '{$urn}' the URN you would like to use for the voucher campaign? [yes|no]", true))
            {
                $urn = $this->ask('Please enter a new campaign URN:');
            }
            else
            {
                $correctUrn = true;
            }
        }

        $data = [
            'name' => $name,
            'brand' => $brand,
            'urn' => $urn
        ];

        if ( ! $this->campaign->createCampaign($data) ):
            $this->comment("Oops, something went wrong. Please ensure the Campaign URN '{$urn}' is unique.");
            return;
        endif;

        $this->comment("Campaign successfully created. Campaign URN is '{$urn}'.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
		);
	}
}