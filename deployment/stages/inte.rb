server 'open_orchestra_media_inte_1-0', roles: %w{web app db env}
set :repo_url, 'git@github.com:open-orchestra/open-orchestra-media-demo.git'
set :deploy_to, '/var/www/media-open-orchestra'
