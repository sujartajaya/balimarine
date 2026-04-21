<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;

class MikrotikService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->client = new Client([
            'host' => config('mikrotik.host'),
            'user' => config('mikrotik.user'),
            'pass' => config('mikrotik.pass'),
            'port' => config('mikrotik.port'),
        ]);
    }

    public function disconnectUser($username)
    {
        $query = new Query('/ip/hotspot/active/print');
        $query->where('user', $username);

        $activeUsers = $this->client->query($query)->read();

        foreach ($activeUsers as $user) {
            $remove = new Query('/ip/hotspot/active/remove');
            $remove->equal('.id', $user['.id']);

            $this->client->query($remove)->read();
        }

        return true;
    }

    public function getIpBindings()
    {
        $query = new Query('/ip/hotspot/ip-binding/print');
        return $this->client->query($query)->read();
    }

    public function addMacBinding($mac, $comment = '', $type = 'bypassed')
    {
        $query = new Query('/ip/hotspot/ip-binding/add');
        $query->equal('mac-address', $mac);
        $query->equal('type', $type); // bypassed / blocked / regular
        $query->equal('comment', $comment);

        return $this->client->query($query)->read();
    }

    public function removeMacBinding($id)
    {
        $query = new Query('/ip/hotspot/ip-binding/remove');
        $query->equal('.id', $id);

        return $this->client->query($query)->read();
    }

    public function getActiveUsers()
    {
        $query = new Query('/ip/hotspot/active/print');
        return $this->client->query($query)->read();
    }

}
