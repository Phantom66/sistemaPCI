<?php namespace Tests\Integration\User;

use Tests\Integration\AbstractIntegration;

abstract class AbstractUserIntegration extends AbstractIntegration
{

    /**
     * @var \PCI\Models\User
     */
    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = $this->getUser();

        $this->persistData();
    }

    /**
     * @return \PCI\Models\User
     */
    abstract protected function getUser();

    /**
     * @return void
     */
    abstract protected function persistData();
}
