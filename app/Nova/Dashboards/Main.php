<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\UsersPerRole;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new UsersPerRole()
        ];
    }


    /**
     * @return string
     */
    public function name()
    {
        return 'Dashboard';
    }
}
