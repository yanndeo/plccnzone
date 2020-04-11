namespace :webapp do

    desc 'Installation des dependances js.'
    task :install do
        on roles(:web) do
            within release_path do
                execute 'yarn install'
            end
        end
    end


    desc 'Webpack Encore production.'
    task :manifest do
        on roles(:web) do
            within release_path do
                execute 'yarn build'
            end
        end
    end









end