#!/bin/bash

#Installs the submodules!
#GIT NEED TO BE INSTALLED!

if output=$(git submodule init); then
	echo "INIT DONE!"
	git submodule update
	echo "SETUP DONE! HAPPY CODING!"
	
else
	echo "git submodule init faild!"
fi
