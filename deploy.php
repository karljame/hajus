<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'hajusrakendus');
set('remote_user', 'virt83021'); //virt...
set('http_user', 'virt83021');
set('keep_releases', 2);

// Hosts
host('tak19jame.itmajakas.ee')
    ->setHostname('tak19jame.itmajakas.ee')
    ->set('http_user', 'virt83021')
    ->set('deploy_path', '~/domeenid/www.tak19jame.itmajakas.ee/hajus')
    ->set('branch', 'dev');

// Tasks
set('repository', 'git@github.com:karljame/hajus.git');
//Restart opcache
task('opcache:clear', function () {
    run('killall php80-cgi || true');
})->desc('Clear opcache');

task('build:node', function () {
    cd('{{release_path}}');
    run('npm i');
    run('npx vite build');
    run('rm -rf node_modules');
});
task('deploy', [
    'deploy:prepare',
    'deploy:vendors',
    'artisan:storage:link',
    'artisan:view:cache',
    'artisan:config:cache',
    'build:node',
    'deploy:publish',
    'opcache:clear',
    'artisan:cache:clear'
]);
after('deploy:failed', 'deploy:unlock');