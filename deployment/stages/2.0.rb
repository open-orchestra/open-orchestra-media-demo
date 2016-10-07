server 'open_orchestra_media_inte_2-0', roles: %w{web app db env}
set :repo_url, 'https://github.com/open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/home/wwwroot/openorchestra/media'
set :branch, 'master'
set :application, 'OpenOrchestraMedia'
set :update_dir, 'update-vendor-media_inte'
set :git_project_dir, 'open-orchestra-media-demo'
