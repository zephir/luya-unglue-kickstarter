<?php

namespace Deployer;

require 'vendor/luyadev/luya-deployer/luya.php';

host('SSHOST')
    ->stage('prod')
    ->port(22)
    ->user('SSHUSER')
    ->set('deploy_path', '~/httpdocs');

task('unglue:compile', './vendor/bin/unglue compile');
after('luya:commands', 'unglue:compile');


set('repository', 'https://USER:PASSWORD@github.com/VENDOR/REPO.git');