#!/bin/bash
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh --source-only
cd $output 

title="All Searches"

cat $templatefolder/Header.html $templatefolder/ListTableHeader.html | sed 's/$title/'"$title"'/g'
#`grep ':0\.' $file | clearsed |

case=$@ 
if [[ "$case" == "pali" ]]
then
switch=pali
elif [[ "$case" == "en" ]]
then
switch=en
elif [[ "$case" == "ru" ]]
then
switch=ru
elif [[ "$case" == "th" ]]
then
switch=th
else 
switch=
fi

ls -lpah --time-style="+%d-%m-%Y" *_${switch}* | egrep -v "_words.html|\.tmp|_fn.txt|table|.git|итого|total|/" | grep -v "^_" | awk '{print substr($0, index($0, $5))}'  | while IFS= read -r line ; do

file=`echo $line | awk '{print $NF}'`
pitaka=`echo $file | awk -F'_' '{mu=(NF-1); print $mu}' | sed 's/nta//g'`
language=`echo $file | awk -F'_' '{print $NF}' | awk -F'.' '{print $1 }'`
link=/output/$file
searchedpattern=`echo $file | awk -F'_' '{mu=(NF-1); $mu=$NF=""; print }'`
if [ ${#searchedpattern} -ge $truncatelength ]
then
  searchedpattern="`echo $searchedpattern | head -c $truncatelength`..."
fi


creationdate=`echo $line | awk '{print $2}'`
size=`echo $line | awk '{print $1}'`
#extra=`grep "matech in"  $file`   <td>$extra</td>   
matchescount=`cat ./$file | grep -m1 title | awk -F' matches in ' '{print $1}' | awk -F' texts and ' '{print $NF}'`
textscount=`cat ./$file | grep -m1 title | awk -F' matches in ' '{print $1}' | awk -F' texts and ' '{print $1}' | awk '{print $NF}'`
echo "<tr>
<td><a target=\"_blank\" href="$link">$searchedpattern</a>  
</td>
<td>${language^}</td>
<th>$textscount</th>
<th>$matchescount</th>
<td>${pitaka^}</td>
<td>$size</td>
<td>$creationdate</td>
</tr>"
done
echo "</table>
<a href="/">Main page </a>"
cat $templatefolder/Footer.html 


exit 0

            <th>Pattern</th>
            <th>Pitaka</th>
            <th>Date</th>
            <th>Size</th>
            <th class="none">Texts</th>
            <th class="none">Matches</th>
            <th class="none">Language</th>