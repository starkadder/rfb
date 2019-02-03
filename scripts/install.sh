#!/bin/bash

if  whoami | grep -q root  
then
  echo "installing as root"
else
  echo "you must be root to install"
  exit
fi

if [ ! -d /etc/rfb ]
then
 mkdir /etc/rfb
fi

cp ./rfbplayer /usr/local/sbin/rfbplayer
cp ./rfbservice /usr/local/sbin/rfbservice
cp ./rfb.conf /etc/init/rfb.conf
cp ./rfb /etc/init.d/rfb
chmod 777 /usr/local/sbin/rfbplayer
chmod 700 /usr/local/sbin/rfbservice
chmod 755 /etc/init.d/rfb
service rfb restart


#echo "add a line to /etc/initab like this:"
#echo "rfb:23:respawn:/usr/local/sbin/rfb "




