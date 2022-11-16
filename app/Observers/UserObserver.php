<?php

namespace App\Observers;

use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        $this->getNovaNotification($user, 'New User: ', 'success');
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->getNovaNotification($user, 'Updated User: ', 'info');
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->getNovaNotification($user, 'Deleted User: ', 'error');
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->getNovaNotification($user, 'Restored User: ', 'success');
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->getNovaNotification($user, 'Force Deleted User: ', 'error');
    }

    private function getNovaNotification($user, $message, $type)
    {
        foreach(User::all() as $u) {
            $u->notify(NovaNotification::make()
                ->message($message . ' ' . $user->name)
                ->icon('user')
                ->type($type));
        }
    }
}
