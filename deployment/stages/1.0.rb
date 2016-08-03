server 'open_orchestra_media_inte_1-0', roles: %w{web app db env}
set :repo_url, 'https://github.com/open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/home/wwwroot/openorchestra/media'
set :update_dir, 'update-vendor-media-inte'
set :git_project_dir, 'open-orchestra-media-demo'
set :branch, '1.0'
