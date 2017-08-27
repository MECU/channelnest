<?php
namespace Deployer;

require 'recipe/laravel.php';

// Configuration
inventory('hosts.yml');

set('repository', 'git@github.com:MECU/channelnest.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);
set('http_user', 'nobody');
set('default_stage', 'production');


// Hosts
host('channelnest.com')
    ->stage('production')
    ->set('deploy_path', '/home/channelnest');


// Tasks

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
