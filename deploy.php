<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'nearry.com');

// Project repository
set('repository', 'git@github.com:ankitjaiswal/nearryapi.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('167.71.234.167')
    ->user('deployer')
    ->identityFile('~/.ssh/nearry')
    ->set('deploy_path', '/var/www/api.nearry.com/html');
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

