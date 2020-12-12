# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrant configuration for Joomla Staff Validator
# Author: Greg J Preece
# Creation Date: 2019-03-26

Vagrant.configure("2") do |config|

  config.vm.box = "joomlatools/box"
  config.vm.box_version = ">= 1.6"
  config.vm.hostname = "joomlatools"

  # Check guest additions
  config.vbguest.auto_update = true;

  # VirtualBox configuration:
  config.vm.provider "virtualbox" do |vb|
    vb.name = "joomlatools"

    # Don't display the VM's output - run headless
    vb.gui = false

    # Memory and CPU:
    vb.cpus = 2
    vb.memory = "1024"
  end

  # What follows is a workaround for Composer 2.0 incompatibility in the
  # Joomlatools 1.6 box. To work around this until a new version of the box
  # is released, we use the following rather convoluted method:
  # 1) We install all dependencies in Composer 1.x
  # 2) We remove all the specified Composer plugins 
  #     (if they were not properly installed them removal will fail because of uninstall hooks, gaah!)
  # 3) We tell Composer to self-upate to the 2.0 branch.
  #     Joomlatools would have done this anyway so let's pre-empt it.
  # 4) We add back the compatible plugin versions 

  # This structure and params are required for Windows host compatibility
  config.vm.provision "shell" do |s|
    s.binary = true
    s.privileged = true
    s.inline = <<-SHELL
      sudo -H -u vagrant bash -c 'composer global remove pyrech/composer-changelogs cweagans/composer-patches hirak/prestissimo --no-plugins'
    SHELL
  end

  config.vm.provision "shell" do |s|
    s.binary = true
    s.privileged = true
    s.inline = <<-SHELL
      sudo -H -u vagrant bash -c 'sudo composer self-update'
    SHELL
  end

  config.vm.provision "shell" do |s|
    s.binary = true
    s.privileged = true
    s.inline = <<-SHELL
      sudo -H -u vagrant bash -c 'composer global require pyrech/composer-changelogs cweagans/composer-patches'
    SHELL
  end

  config.vm.provision "shell" do |s|
    s.binary = true
    s.privileged = true
    s.inline = <<-SHELL
      sudo -H -u vagrant bash -c 'composer global update'
    SHELL
  end

end
