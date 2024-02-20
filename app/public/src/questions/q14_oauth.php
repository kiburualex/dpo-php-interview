<?php
    /*
        14.	Write a PHP script that integrates with a REST API protected by OAuth 2.0 authentication. 
            Implement the OAuth 2.0 authorization code flow to obtain an access token and use that token 
            to make authenticated requests to the API. Provide a code example that demonstrates the 
            complete authentication and data retrieval process
    */

    require '/var/www/html/vendor/autoload.php';

    use League\OAuth2\Client\Provider\GenericProvider;

    // Replace these with your actual values
    $clientId = 'your-client-id';
    $clientSecret = 'your-client-secret';
    $redirectUri = 'your-redirect-uri';
    $authorizationUrl = 'authorization-url';
    $tokenUrl = 'token-url';
    $apiEndpoint = 'api-endpoint';

    // Initialize the provider
    $provider = new GenericProvider([
        'clientId'                => $clientId,
        'clientSecret'            => $clientSecret,
        'redirectUri'             => $redirectUri,
        'urlAuthorize'            => $authorizationUrl,
        'urlAccessToken'          => $tokenUrl,
        'urlResourceOwnerDetails' => $apiEndpoint,
    ]);

    // Step 1: Redirect the user to the authorization URL to get the authorization code
    if (!isset($_GET['code'])) {
        $authUrl = $provider->getAuthorizationUrl(['scope' => 'desired-scope']);
        header('Location: ' . $authUrl);
        exit;

    // Step 2: Use the authorization code to get the access token
    } else {
        // Exchange authorization code for an access token
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
        ]);

        // Step 3: Use the access token to make a request to the API
        $resourceOwner = $provider->getResourceOwner($accessToken);
        $apiResponse = $resourceOwner->toArray();

        // Display the API response
        print_r($apiResponse);
    }

?>