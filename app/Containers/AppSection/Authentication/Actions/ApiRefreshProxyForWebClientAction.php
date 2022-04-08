<?php

namespace App\Containers\AppSection\Authentication\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Authentication\Exceptions\LoginFailedException;
use App\Containers\AppSection\Authentication\Exceptions\RefreshTokenMissedException;
use App\Containers\AppSection\Authentication\Tasks\CallOAuthServerTask;
use App\Containers\AppSection\Authentication\Tasks\MakeRefreshCookieTask;
use App\Containers\AppSection\Authentication\UI\API\Requests\RefreshProxyRequest;
use App\Ship\Parents\Actions\Action;
use Illuminate\Support\Facades\Request;

class ApiRefreshProxyForWebClientAction extends Action
{
    /**
     * @param RefreshProxyRequest $request
     * @return array
     * @throws LoginFailedException
     * @throws RefreshTokenMissedException
     * @throws IncorrectIdException
     */
    public function run(RefreshProxyRequest $request): array
    {
        $sanitizedData = $request->sanitizeInput([
            'refresh_token',
        ]);

        $sanitizedData['refresh_token'] = $sanitizedData['refresh_token'] ?: Request::cookie('refreshToken');
        $sanitizedData['client_id'] = config('appSection-authentication.clients.web.id');
        $sanitizedData['client_secret'] = config('appSection-authentication.clients.web.secret');
        $sanitizedData['grant_type'] = 'refresh_token';
        $sanitizedData['scope'] = '';

        if (!$sanitizedData['refresh_token']) {
            throw new RefreshTokenMissedException();
        }

        $responseContent = app(CallOAuthServerTask::class)->run($sanitizedData, $request->headers->get('accept-language'));
        $refreshCookie = app(MakeRefreshCookieTask::class)->run($responseContent['refresh_token']);

        return [
            'response_content' => $responseContent,
            'refresh_cookie' => $refreshCookie,
        ];
    }
}
