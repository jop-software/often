<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'often');

// Project repository
set('repository', 'https://github.com/cngJo/often');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server 
set('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('johannesprzymusinski.de')
    ->set('deploy_path', '/var/www/vhosts/often');
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

task("copy_config", function() {
    run("cp ~/config/often.config.ini /var/www/vhosts/oten/current/config.ini");
});

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
