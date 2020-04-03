# server-based syntax
# ======================
# Defines a single server with a list of roles and multiple properties.
# You can define all roles on a single server, or split them:

# server "example.com", user: "deploy", roles: %w{app db web}, my_property: :my_value
# server "example.com", user: "deploy", roles: %w{app web}, other_property: :other_value
# server "db.example.com", user: "deploy", roles: %w{db}



# role-based syntax
# ==================

# Defines a role with one or multiple servers. The primary server in each
# group is considered to be the first unless any hosts have the primary
# property set. Specify the username and a domain or IP for the server.
# Don't use `:all`, it's a meta role.

# role :app, %w{deploy@example.com}, my_property: :my_value
# role :web, %w{user1@primary.com user2@additional.com}, other_property: :other_value
# role :db,  %w{deploy@example.com}



# Configuration
# =============
# You can set any configuration variable like in config/deploy.rb
# These variables are then only loaded and set in this stage.
# For available Capistrano configuration variables see the documentation page.
# http://capistranorb.com/documentation/getting-started/configuration/
# Feel free to add new variables to customise your setup.



# Custom SSH Options
# ==================
# You may pass any option but keep in mind that net/ssh understands a
# limited set of options, consult the Net::SSH documentation.
# http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start
#
# Global options
# --------------
#  set :ssh_options, {
#    keys: %w(/home/user_name/.ssh/id_rsa),
#    forward_agent: false,
#    auth_methods: %w(password)
#  }
#
# The server-based syntax can be used to override options:
# ------------------------------------
# server "example.com",
#   user: "user_name",
#   roles: %w{web app},
#   ssh_options: {
#     user: "user_name", # overrides user setting above
#     keys: %w(/home/user_name/.ssh/id_rsa),
#     forward_agent: false,
#     auth_methods: %w(publickey password)
#     # password: "please use keys"
#   }

set :deploy_to, "~/larasta.mycpnv.ch"
set :keep_releases, 2

server "larasta.mycpnv.ch",
   user: "larasta",
   roles: %w{web app},
   ssh_options: {
    keys: %w(config/larasta_rsa),
     forward_agent: false,
     auth_methods: %w(publickey password)
   }
  
SSHKit.config.command_map[:composer] = "php -d allow_url_fopen=true #{shared_path.join('composer')}"

Rake::Task['laravel:optimize'].clear_actions rescue nil
   set :laravel_set_acl_paths, false
   set :laravel_upload_dotenv_file_on_deploy, false

   after 'composer:run' , 'copy_dotenv'
   after 'composer:run' , 'laravel:migrate'
   after 'laravel:migrate' , 'seed_database'
   after "deploy:updated", "deploy:cleanup"

   task :copy_dotenv do
    on roles(:all) do
      execute :cp, "#{shared_path}/.env #{release_path}/.env"
    end
  end

  task :seed_database do
    on roles(:db), in: :sequence, wait: 5 do
        within release_path  do
            execute :php, "artisan db:seed"
        end
    end