@php
    // Read the raw POST data sent by GitHub webhook
    $payload = file_get_contents('php://input');

    // GitHub sends the signature in the format "sha1=HMAC_HEX_DIGEST"
    $signature = isset($_SERVER['HTTP_X_HUB_SIGNATURE']) ? $_SERVER['HTTP_X_HUB_SIGNATURE'] : '';

    // If the signature is not present (GitHub webhook without a secret), proceed without verification
    if (empty($signature)) {
        // No signature verification needed
        // Proceed with deployment or other actions
        $output = shell_exec(
            'cd /home/janahxco/Al-Janah && git config --global user.email "admin@janahx.com" && git config --global user.name "Admin" && git pull',
        );
        echo "<pre>$output</pre>";
        exit('Deployment completed');
    }

    // Validate signature if provided
    if (strpos($signature, 'sha1=') !== 0) {
        header('HTTP/1.1 403 Forbidden');
        exit('Invalid signature format.');
    }

    // Separate algorithm from hash
    [$algo, $hash] = explode('=', $signature, 2);

    // Compute expected HMAC signature using an empty secret
    $expectedHash = hash_hmac($algo, $payload, '');

    // Compare the expected HMAC signature with the received signature
    if (!hash_equals($hash, $expectedHash)) {
        header('HTTP/1.1 403 Forbidden');
        exit('Invalid GitHub webhook signature.');
    }

    // If the signature is valid, proceed with deployment
    $output = shell_exec(
        'cd /home/janahxco/Al-Janah && git config --global user.email "admin@janahx.com" && git config --global user.name "Admin" && git pull',
    );
    echo "<pre>$output</pre>";
    exit('Deployment completed');

@endphp
