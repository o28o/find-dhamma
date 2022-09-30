#!/bin/bash

cd /home/a0092061/domains/find.dhamma.gift/public_html/input
pscheck=`ps -ef | grep bgmode.sh | grep -v grep | wc -l`
echo pscheck $pscheck 
#clean emptly lines
sed -i '/^$/d' ../input/input.txt

#debug info
echo begin ps list
ps -ef | grep bgmode.sh | grep -v grep
echo end 


#quit if already running
if (( "$pscheck" >= 4 ))
then 
  echo "`date` already running"
  exit 1
fi

#run the main script
cat input.txt | sort | uniq | while read -r line 
do  
  echo doing $line 
  ../scripts/finddhamma.sh "$line" 
  sed -i '/^'"$line"'$/Id' input.txt 
done 

exit 0