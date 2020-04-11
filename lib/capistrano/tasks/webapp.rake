namespace :webapp do

    desc 'Installation des dependances js.'
    task :install do
        on roles(:web) do
            within release_path do
                execute("cd #{release_path} && yarn install")
            end
        end
    end


    desc 'Cache clear js.'
    task :optimize do
        on roles(:web) do
            within release_path do
                execute("cd #{release_path} && yarn cache clean")
            end
        end
    end


    desc 'Webpack Encore production.'
    task :manifest do
        on roles(:web) do
            within release_path do
                execute("cd #{release_path} && yarn build")
            end
        end
    end









end