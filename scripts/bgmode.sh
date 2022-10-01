#!/bin/bash

cd /home/a0092061/domains/find.dhamma.gift/public_html/input
pscheck=`ps -ef | grep bgmode.sh | grep -v grep | wc -l`
inputfile=./input.txt
#echo pscheck $pscheck 


#debug info
#echo begin ps list
#ps -ef | grep bgmode.sh | grep -v grep
#echo end 
#quit if already running
if (( "$pscheck" >= 2 ))
then 
  echo "`date` already running"
  exit 1
fi

#clean emptly lines
sed -i '/^$/d' ./input.txt
#grep -v "^$" $inputfile > temp  
#mv temp $inputfile

#run the main script
cat input.txt | sort | uniq | while read -r line 
do  
  #echo working on $line 
  ../scripts/finddhamma.sh "$line" 
#  grep -v "$line" $inputfile > ./temp ;
#  mv ./temp $inputfile
  sed -i '/^'"$line"'$/Id' ./input.txt 
done 

exit 0
