#!/bin/bash

cd /home/a0092061/domains/find.dhamma.gift/public_html/input

cat input.txt | sort | uniq | while read -r line ; do  
echo $line 
../scripts/finddhamma.sh "$line" 
sed -i '/^'$line'$/d' input.txt 
done 
