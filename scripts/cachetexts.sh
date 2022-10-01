#!/bin/bash
for i in /home/a0092061/data/suttacentral.net/sc-data/sc_bilara_data/root/pli/ms/sutta/ /home/a0092061/data/suttacentral.net/sc-data/sc_bilara_data/root/pli/ms/vinaya/ /home/a0092061/data/suttacentral.net/sc-data/sc_bilara_data/translation/en/ /home/a0092061/data/suttacentral.net/sc-data/html_text/th /home/a0092061/data/suttacentral.net/sc-data/html_text/ru 
do
echo $i
for l in `find $i -type f `
do 
cat $l > /dev/null
done
done

