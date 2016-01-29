Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"

    config.vm.synced_folder ".", "/vagrant"

    config.vm.provision "shell", path: "./provision/requirements.sh"

    config.vm.provider "virtualbox" do |v|
        v.memory = 1536
    end
end
