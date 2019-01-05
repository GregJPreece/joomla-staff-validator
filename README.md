# Joomla Staff Validator

Joomla component to allow site members (staffers) to validate their identities when contacting people outside of the site organisation. If a site member is contacting someone via a method that is insecure or not easily verified, such as phone call or most e-mail, this component can allow the person being contacted to validate the member as belonging to the website. A code is generated in advance by the site member and provided to the contact, who can then enter it into a public form on the website to verify its authenticity and the identity of the user who generated it.

# Running Development Environment

This Joomla extension uses a Docker-based Joomla environment for testing. To instantiate an environment after checkout, ensure you have recent versions of Docker and Docker-Compose installed, then run:

`docker-compose up`

After the containers have started, you can access the Joomla development site at http://localhost:8080. The first time you start the container, you will have to set up Joomla. Once you can configured Joomla and are logged in as the administrator account, go to the Extensions manager and install the development extension from its folder:

`/var/www/html/components/com_staffvalidator`

**Note:** You may find that you receive a permissions error when installing. This is because Docker mounts the code in as your host user, not as something the web root can read. If this happens, use `docker exec` to run a bash terminal inside the container, give the folder the same group ownership as the web server, and give that group write permissions. Installation should then work correctly. I will attempt to make this process more automatic in a future revision, but for now you can jump through some hoops.

You are now ready to proceed with development. All file changes will be automatically synchronised into the Joomla box.