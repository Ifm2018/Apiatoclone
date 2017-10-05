<?php

namespace App\Containers\Authentication\Actions;

use App\Ship\Parents\Actions\Action;
use App\Ship\Parents\Requests\Request;

/**
 * Class ProxyApiLoginAction.
 */
class ProxyApiLoginAction extends Action
{

    /**
     * @param \App\Ship\Parents\Requests\Request $request
     * @param                                    $clientId
     * @param                                    $clientPassword
     *
     * @return  array
     */
    public function run(Request $request, $clientId, $clientPassword)
    {
        $requestData = [
            'grant_type'    => 'password',
            'client_id'     => $clientId,
            'client_secret' => $clientPassword,
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '',
        ];

        $responseContent = $this->call('Authentication@CallOAuthServerTask', [$requestData]);

        // check if user email is confirmed only if that feature is enabled.
        $this->call('Authentication@CheckIfUserIsConfirmedTask', [],
            [['loginWithCredentials' => [$requestData['username'], $requestData['password']]]]);

        $refreshCookie = $this->call('Authentication@MakeRefreshCookieTask', [$responseContent['refresh_token']]);

        return [
            'response-content' => $responseContent,
            'refresh-cookie'   => $refreshCookie,
        ];
    }
}
