namespace :php do

    desc 'Charge les dépendances de composer'
    task :composer do
        on roles(:web) do
            within release_path do
                # execute '/opt/plesk/php/7.2/bin/php', '/usr/local/bin/composer', :install, '--optimize-autoloader'
                execute '/opt/plesk/php/7.2/bin/php', '/usr/local/bin/composer', :install, '--no-dev', '--optimize-autoloader'
            end
        end
    end


    desc 'Redemarre PHP7.2'
    task :restart_fpm do
        on roles(:web) do
            sudo :service, 'plesk-php72-fpm', :restart
        end
    end



end

