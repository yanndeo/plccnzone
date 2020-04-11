namespace :webapp do

    desc 'Installation des dependances js.'
    task :install do
        on roles(:web) do
            within release_path do
                execute 'npm install'
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









end