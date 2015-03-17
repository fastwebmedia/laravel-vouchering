<?php namespace Fastwebmedia\LaravelVouchering\core\Factories;

use \Fastwebmedia\LaravelVouchering\models\Campaign;
use \Fastwebmedia\LaravelVouchering\core\Repositories\CampaignRepository;

class CampaignFactory
{
    /**
     * @var Campaign
     */
    protected $model;

    /**
     * @var CampaignRepository
     */
    protected $repo;

    /**
     * Constructs models
     */
    public function __construct() {
        $this->model = New Campaign;
        $this->repo = New CampaignRepository;
    }

    /**
     * createCampaign function.
     *
     * @access public
     *
     * @param string $campaignUrn
     *
     * @return Campaign
     */
    public function createCampaign($data)
    {
        // Check campaign already exists
        if (! $this->repo->getCampaign($data['urn'])):

            $campaign = $this->model->create($data);

            return $campaign;
        endif;

        return false;
    }
}
