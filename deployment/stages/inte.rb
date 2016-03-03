server 'open_orchestra_media_inte', roles: %w{web app db env}
set :repo_url, 'git@github.com:open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/var/www/media-open-orchestra'
set :branch, 'master'
set :application, 'OpenOrchestraMedia'
set :update_dir, 'update-vendor-media_inte'
set :git_project_dir, 'open-orchestra-media-demo'
