server 'open_orchestra_media_stable', roles: %w{web app db env}
set :repo_url, 'git@github.com:open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/var/www/stable-media-open-orchestra'
set :branch, '1.0'
set :application, 'OpenOrchestraMediaStable'
set :update_dir, 'update-vendor-media_stable'
set :git_project_dir, 'open-orchestra-media-demo'
