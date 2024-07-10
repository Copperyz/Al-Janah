@php
    $secret = ''; // Same as the secret you used in the GitHub webhook settings
    $signature = 'sha1=' . hash_hmac('sha1', file_get_contents('php://input'), $secret);
    if (hash_equals($signature, $_SERVER['HTTP_X_HUB_SIGNATURE'])) {
        shell_exec('cd /home/janahxco/Al-Janah/repository && git pull');
    }

@endphp
