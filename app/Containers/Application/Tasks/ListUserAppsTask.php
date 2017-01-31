<?php

namespace App\Containers\Application\Tasks;

use App\Containers\Application\Data\Repositories\ApplicationRepository;
use App\Containers\Order\Data\Criterias\ThisStoreCriteria;
use App\Port\Task\Abstracts\Task;
use App\Port\Criterias\Eloquent\OrderByCreationDateDescendingCriteria;
use App\Port\Criterias\Eloquent\ThisUserCriteria;

/**
 * Class ListUserAppsTask.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class ListUserAppsTask extends Task
{
    /**
     * @var \App\Containers\Application\Data\Repositories\ApplicationRepository
     */
    private $applicationRepository;

    /**
     * ListAllAppsTask constructor.
     *
     * @param \App\Containers\Application\Data\Repositories\ApplicationRepository $applicationRepository
     */
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @return  mixed
     */
    public function run()
    {
        $this->applicationRepository->pushCriteria(new ThisStoreCriteria());

        $this->applicationRepository->pushCriteria(new OrderByCreationDateDescendingCriteria());

        return $this->applicationRepository->all();
    }

}