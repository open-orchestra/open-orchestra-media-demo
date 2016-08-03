server 'open_orchestra_media_inte_1-1', roles: %w{web app db env}
set :repo_url, 'https://github.com/open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/home/wwwroot/openorchestra/media'
set :branch, '1.1'
set :application, 'OpenOrchestraMedia'
set :update_dir, 'update-vendor-media_inte'
set :git_project_dir, 'open-orchestra-media-demo'
