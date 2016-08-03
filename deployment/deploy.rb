set :format, :pretty
set :log_level, :info
set :keep_releases, 2
set :ssh_options, { :forward_agent => true }
set :composer_install_flags, '--ignore-platform-reqs --no-dev --prefer-dist --no-interaction --optimize-autoloader'
set :linked_files, %w{app/config/parameters.yml}
set :linked_dirs, %w{app/logs web/uploads vendor bower_components node_modules}

after 'deploy:finishing', 'deploy:cleanup'
