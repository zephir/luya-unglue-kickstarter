<?php

require 'vendor/luyadev/luya-deployer/luya.php';

server('prod', 'SSHHOST.COM', 22)
    ->user('SSHUSER')
    ->password('SSHPASS')
    ->stage('prod')
    ->env('deploy_path', '/var/www/vhosts/path/httpdocs');

set('afterCommands', [
    './vendor/bin/unglue compile'
]);

set('repository', 'https://USER:PASSWORD@github.com/VENDOR/REPO.git');