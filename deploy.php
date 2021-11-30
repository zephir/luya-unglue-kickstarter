<?php

namespace Deployer;

require 'vendor/luyadev/luya-deployer/luya.php';

host('SSHOST')
    ->stage('prod')
    ->port(22)
    ->user('SSHUSER')
    ->set('deploy_path', '~/httpdocs');

after('luya:commands', 'unglue');

set('repository', 'https://USER:PASSWORD@github.com/VENDOR/REPO.git');
