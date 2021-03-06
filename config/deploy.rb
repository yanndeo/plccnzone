# config valid for current version and patch releases of Capistrano
lock "~> 3.12.0"

set :application, "plccnzone"
set :repo_url, "https://github.com/yanndeo/plccnzone.git"

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
 set :deploy_to, "/var/www/vhosts/plccnczone.com/new.plccnczone.com"

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
append :linked_files, ".env"
# append :linked_files, "config/database.yml"

# Default value for linked_dirs is []
append :linked_dirs, "public/uploads"
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"
# append :linked_dirs, "public/uploads", "tmp/cache", "tmp/sockets", "public/system"


# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
set :keep_releases, 3

# Uncomment the following to require manually verifying the host key before first deploy.
# set :ssh_options, verify_host_key: :secure

namespace :deploy do

    after :updated, :php_sf do
        invoke "php:composer"
        invoke "symfony:migrate"
        invoke "symfony:optimize"
        invoke "webapp:install"
        invoke "webapp:manifest"
        invoke "webapp:optimize"
    end

    after :finished, 'php:restart_fpm'

end