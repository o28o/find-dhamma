#!/bin/bash
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh
cd $output 

title="All Searches"

cat $templatefolder/Header.html $templatefolder/ListTableHeader.html | sed 's/$title/'"$title"'/g'
#`grep ':0\.' $file | clearsed |



ls -lpah --time-style="+%d-%m-%Y"| egrep -v "table|.git|итого|total|/" | awk '{print substr($0, index($0, $5))}'  | while IFS= read -r line ; do

file=`echo $line | awk '{print $NF}'`
if [ ${#file} -ge $truncatelength ]
then
  searchedpattern="`echo $file | sed 's/_analysis.html//g' | head -c $truncatelength`..."
else 
  searchedpattern=`echo $file | sed 's/_analysis.html//g' `
fi
link=./output/$file
creationdate=`echo $line | awk '{print $2}'`
size=`echo $line | awk '{print $1}'`
#extra=`grep "matech in"  $file`   <td>$extra</td>   


echo "<tr>
<td><a target=\"_blank\" href="$link">$searchedpattern</a>  
</td>
<td>$creationdate</td>
<td>$size</td>  
</tr>"

done

cat $templatefolder/Footer.html 


exit 0

Pattern</th>
            <th></th>
            <th>Date</th>
            <th>Size</th>
            <th class="none">Extra</th>