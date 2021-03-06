namespace :symfony do

    desc 'MAJ les tables en base de donnée.'
    task :migrate do
        on roles(:web) do
            within release_path do
                #execute '/opt/plesk/php/7.2/bin/php', 'bin/console', 'make:migration'
                execute '/opt/plesk/php/7.2/bin/php', 'bin/console', ' --no-interaction', 'd:m:m'
            end
        end
    end


    desc 'Optimisation courante.'
    task :optimize do
        on roles(:web) do
            within release_path do
                execute '/opt/plesk/php/7.2/bin/php', 'bin/console', 'cache:clear'
            end
        end
    end



    desc 'Permissions courante.'
    task :permissions do
        on roles(:web) do
            within release_path do
                execute :chmod, '777', '-R', 'var'
            end
        end
    end







end