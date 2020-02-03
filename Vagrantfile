# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrant configuration for Joomla Staff Validator
# Author: Greg J Preece
# Creation Date: 2019-03-26

Vagrant.configure("2") do |config|

  config.vm.box = "joomlatools/box"
  config.vm.box_version = ">= 1.6"
  config.vm.hostname = "joomlatools"

  # VirtualBox configuration:
  config.vm.provider "virtualbox" do |vb|
    vb.name = "joomlatools"

    # Don't display the VM's output - run headless
    vb.gui = false

    # Memory and CPU:
    vb.cpus = 2
    vb.memory = "1024"
  end

end
