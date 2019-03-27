# Joomla Staff Validator

Joomla component to allow site members (staffers) to validate their identities when contacting people outside of the site organisation. If a site member is contacting someone via a method that is insecure or not easily verified, such as phone call or most e-mail, this component can allow the person being contacted to validate the member as belonging to the website. A code is generated in advance by the site member and provided to the contact, who can then enter it into a public form on the website to verify its authenticity and the identity of the user who generated it.

# Running Development Environment

This Joomla extension uses the [JoomlaTools Vagrant Box](https://www.joomlatools.com/developer/tools/vagrant/) for local development and testing.

This box uses NFS for its file synchronisation outside the box. Ensure that you have the required NFS tools installed before building the box. On Ubuntu, this is as simple as:

`sudo apt install nfs-kernel-server`

Once you have done this, you can run `vagrant up` to build the box. **ON FIRST RUN:** Run this command from the command line and not from your IDE, as you will be required to enter your sudo/admin password for Vagrant to set up the NFS shares. You will also need to do this if you run `vagrant destroy`.

The JoomlaTools box uses fixed-IP private networking to expose its various domains. Once the Vagrant box has finished building, add the following line to your hosts file (on Linux this is usually at `/etc/hosts`):

`33.33.33.58 joomla.box webgrind.joomla.box phpmyadmin.joomla.box`

You should now be able to view the box's control panel at http://joomla.box