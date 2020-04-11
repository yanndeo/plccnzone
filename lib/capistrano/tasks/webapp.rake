namespace :webapp do

    desc 'Installation des dependances js.'
    task :install do
        on roles(:web) do
            within current_path do
                execute 'yarn install'
            end
        end
    end


    desc 'Cache clear js.'
    task :optimize do
        on roles(:web) do
            within current_path do
                execute 'yarn cache clean'
            end
        end
    end


    desc 'Webpack Encore production.'
    task :manifest do
        on roles(:web) do
            within current_path do
                execute 'yarn build'
            end
        end
    end









end