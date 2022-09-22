#!/bin/bash -i
#set -x 
#trap read debug
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh
cd $output 

function grepbrief {
	
	awk -v ptn="$pattern" -v cnt1=$wbefore -v cnt2=$wafter '
{ for (i=1;i<=NF;i++)
      if ($i ~ ptn) {
         sep=""
         for (j=i-cnt1;j<=i+cnt2;j++) {
             if (j<1 || j>NF) continue
             printf "%s%s", sep ,$j
             sep=OFS
         }
         print ""
      }
}'
}


pattern="$@"
#pattern=океан
minlength=3
if [[ "$pattern" == "" ]] ||  [[ "$pattern" == "-ru" ]] || [[ "$pattern" == "-en" ]] 
then   
#echo -e "Content-Type: text/html\n\n"
   echo Empty pattern 
   exit 1
elif   [ "${#pattern}" -lt "$minlength" ]
then
echo Too short. Min is $minlength
exit 1 
fi
#echo searching $pattern
#pattern=adhivacanas

function clearargs {
sed -e 's/-pil//g' -e 's/-pi//g' -e 's/-ru//g' -e 's/-en//g' -e 's/-abhi//g' -e 's/-vin//g' -e 's/^ //g'
}
#set search language from args or set default

pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs `
grepgenparam=E


#if you want to use this script for other languages, add blocks that are needed with your language which must be available on suttacentra.net
lookup=$suttapath/sc-data/sc_bilara_data

function clearsed {
sed 's/<p>/\n/g; s/<[^>]*>//g'  | sed  's/": "/ /g' | sed  's/"//1' | sed 's/",$//g' 
}


vin=vinaya
abhi=abhidhamma
sutta=mutta
fortitle=Suttas
fileprefix=_sutta
if [[ "$@" == *"-vin"* ]]; then
    vin=
    sutta=sutta
	fortitle=Vinaya
    #echo search in vinaya
    fileprefix=_vinaya
fi
if [[ "$@" == *"-abhi"* ]]; then
    abhi=
    sutta=sutta
	fortitle=Abhidhamma
    fileprefix=_abhidhamma
    #echo search in abhidhamma
fi

if [[ "$" == *"-h"* ]]; then
    echo "
    without arguments - starts with prompt in pali
    also search words can be used as arguments e.g.
    
    $> ./scriptname.sh moggall
    
    -vin - to search in vinaya texts only 
    -abhi - to search in abhidhamma texts only
    -en - to search in english
    -ru - to search in russian
    -pil - search in pali on legacy.suttacentral.net archive
    "
    exit 0
elif [[ "$@" == *"-ru"* ]]; then
    fnlang=_ru
    pali_or_lang=sc-data/html_text/ru/pli 
    language=Russian
    directlink=
    type=html   
    metaphorkeys="подобно|представь|обозначение"
    nonmetaphorkeys="подобного"
elif [[ "$@" == *"-pil"* ]]; then
   fnlang=_pali
    pali_or_lang=legacy-suttacentral-data-master/text/pi
    language=Pali
    directlink=/pli/ms
    directlink=/en/?layout=linebyline
    directlink=
    type=html
    metaphorkeys="seyyathāpi|adhivacan|ūpamā|ūpama|opama|upamā"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath"
   #modify pattern as legacy uses different letters
    #pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs`
elif [[ "$@" == *"-en"* ]]; then
    fnlang=_en
    pali_or_lang=sc-data/sc_bilara_data/translation/
    language=English
    type=json
    metaphorkeys="suppose|is a term for|similar to "
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath" 
else
    fnlang=_pali
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath"
fi

#filename
fn=`echo $pattern | sed 's/ /_/g' | sed 's/\\\//g' |  awk '{print tolower($0)}'`
fn=${fn}${fileprefix}${fnlang}

extention=txt
basefile=${fn}_fn.$extention

#filelist
words=${fn}_words.$extention
links=${fn}_links.$extention
links_and_words=${fn}_links_words.$extention
quotes=${fn}_quotes.$extention
brief=${fn}_brief.$extention
metaphors=${fn}_metaphors.$extention
table=${fn}.html
tempfile=${fn}.tmp
tempfilewords=${fn}_words.html

if [[ -s ${table} ]] ; then 
function md5checkwrite {
var="$(cat)"
functionname=`echo $var | awk '{print $1}'`
functionfile=~/.shortcuts/${functionname}.sh 
content=`echo "$var" | awk 'NR!=1'`
#echo $functionfile $functionname
md5_stdin=$(echo "$content" | md5sum | cut -d" " -f 1)
md5_file=$(md5sum ${functionfile} | cut -d" " -f1)
[[ "$md5_stdin" != "$md5_file" ]] && echo "$content"  > $functionfile
}
echo Already 
#php -r "print(\"Go to <a href="./output/${table}">${table}</a>\");"
#exit 0
fi


function removeindex {
sed -e 's/:.*": "/": "/' #      sed 's/ /:/1' | awk -F':'  '{print $1, $3}'
}

function tohtml {
tee -a ${table} table.html > /dev/null
} 

function getwords {
cat $file | removeindex | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”‘"]/ /g'|egrep -io$grepgenparam "[^ ]*$pattern[^ ]*" | sort | uniq 
cat $file | removeindex | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”‘"]/ /g'|egrep -io$grepgenparam "[^ ]*$pattern[^ ]*" | tee -a $tempfilewords > /dev/null

}

function highlightpattern {
sed "s@$pattern@<b>&</b>@gI"
}




if [[ "$type" == json ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${brief}
${metaphors}
${top}"`

grepvar=

function linklist {
#echo -e "Content-Type: text/html\n\n"
#echo $@

cat $templatefolder/Header.html $templatefolder/ResultTableHeader.html | sed 's/$title/TitletoReplace/g' | tohtml 

textlist=`cat $basefile | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -n | uniq`

for filenameblock in `cat $basefile | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -n | uniq` ; do 

    roottext=`find $lookup/root -name "*${filenameblock}_*"`
    translation=`find $lookup/translation/en/ -name "*${filenameblock}_*"`
    rustr=`find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*"`
    variant=`find $lookup/variant -name "*${filenameblock}_*"`
    
    
    rusnp=`echo $filenameblock | sed 's@\.@_@g'`
    rustr=`find /home/a0092061/domains/find.dhamma.gift/public_html/theravada.ru/Teaching/Canon/Suttanta/Texts/ -name "*${rusnp}-*"`

     rusthrulink=`echo $rustr | sed 's@.*theravada.ru@https://www.theravada.ru@g'`

  
  
    if [[ "$language" == "Pali" ]]; then
        file=$roottext
    elif [[ "$language" == "English" ]]; then
        file=$translation
    fi 
    
translatorsname=`echo $translation | awk -F'/en/' '{print $2}' | awk -F'/' '{print $1}'`

suttanumber="$filenameblock"

#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}'`
linkgeneral=`echo $filenameblock |  awk '{print "https://sc.Dhamma.gift/?q="$0}' `
#linkgeneral=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `
linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
count=`egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile
#russian text 
#link ru 
#translatorsname=`echo $rustr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `


word=`getwords | removeindex | clearsed | sed 's/[.?;:]//g' | sed 's/[—‘”"]/ /g' | highlightpattern | sort | uniq | xargs` 
indexlist=`egrep -i $filenameblock $basefile | awk '{print $2}'`

metaphorindexlist=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 

suttatitle=`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

echo "<tr>
<td><a class=\"freebutton\" target=\"_blank\" href="$linkgeneral">$suttanumber</a></td>
<td>$word</td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><strong>$suttatitle</strong></td>
<td>" | tohtml 

for i in $indexlist
do              
		for f in  $roottext $translation #$variant
        do      
        #echo rt=$roottext
		quote=`egrep -iE "${i}([^0-9]|$)" $f | removeindex | clearsed | awk '{print substr($0, index($0, $2))}'  | highlightpattern `
echo "$quote</br>"			
        done 
echo '<br class="styled">'
done | tohtml 

echo  "</td>
<td><a target=\"_blank\" href="$linkpli">Pali</a> `[[ $rusthrulink != "" ]] && echo "<a target=\"_blank\" href="$rusthrulink">Русский</a>"` <a target=\"_blank\" href="$linken">English</a></td>
</tr>" | tohtml

done
matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`

cat $tempfilewords  | sed 's/[.,?;:]//g' | sed 's/[—”‘“"]/ /g' | awk '{print tolower($0)}' | tr -s ' '  '\n' | sort | uniq -c | awk '{print $2, $1}' > $tempfile
uniqwordtotal=`cat $tempfile | wc -l `
#| sed 's/(//g' | sed 's/)//g'
#cat $tempfile
#echo cat

cat $templatefolder/Header.html $templatefolder/WordTableHeader.html | sed 's/$title/TitletoReplace/g' > $tempfilewords 

cat $tempfile | while IFS= read -r line ; do
uniqword=`echo $line | awk '{print $1}'`
uniqcount=`echo $line | awk '{print $2}'`
linkswwords=`grep -i $uniqword $basefile | awk '{print $1}' | awk -F'/' '{print $NF}' | awk -F'_' '{print "<a target=_blank href=https://sc.dhamma.gift/?q="$1">"$1"</a>"}'| xargs`

#echo $linkswwords
#cat ${links_and_words}  | tr ' ' '\n' |  egrep -i$grepgenparam "$pattern"  | sed -e 's/<[^>]*>//g' | sed 's/[".;:?,]/ /g' | sed -e 's/“/ /g' -e 's/‘/ /g'| sed 's/.*= //g' | sed 's@/legacy-suttacentral-data-master/text/pi/su@@g' | sed 's/.*>//g'| sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//' | tr '[:upper:]' '[:lower:]'  | sort | uniq > ${words}


#cat $file | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”"]/ /g'| grep -io$grepgenparam "[^ ]*$pattern[^ ]*" | sort | uniq >> ${links_and_words}

echo "<tr>
<td>`echo $uniqword | highlightpattern`</td>
<td>$uniqcount</td>   
<td>$linkswwords</td>
</tr>" >>$tempfilewords
done

echo "</tbody>
</table>
<a href="/">Main page </a>
<a href="/output/${table}">Quotes</a>
" >> $tempfilewords

cat $templatefolder/Footer.html >> $tempfilewords

#Sibbin 999 matches in 444 texts of Pali Suttas
echo "</tbody>
</table>
<a href="/">Main page </a>
<a href="/output/${tempfilewords}">Words</a>
" | tohtml


cat $templatefolder/Footer.html | tohtml


}
#e g for russian language
elif [[ "$type" == html ]]; then

filelist=`echo "
${words}
${links}
${links_and_words}
${quotes}
${tempfile}
${table}"`

#${texts}

grepvar=l

#Edit me

function linklist {
#echo -e "Content-Type: text/html\n\n"
#echo $@

#russian text 
#link ru 
#translatorsname=`echo $rustr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

cat $templatefolder/Header.html $templatefolder/ResultTableHeader.html | sed 's/$title/TitletoReplace/g' | tohtml 


uniquelist=`cat $basefile | awk -F'/' '{print $NF}' | sort -n | uniq`

textlist=$uniquelist

#edit me edn
    for i in $uniquelist
do

    filenameblock=`echo $i |  sed 's/.html//g' | sort | uniq `
file=`grep -m1 $filenameblock $basefile`
   # count=`egrep -oi$grepgenparam "$pattern" $file | wc -l` 
rustr=$file

    #roottext=`find $lookup/root -name "*${filenameblock}_*"`
   # translation=`find $lookup/translation/en/ -name "*${filenameblock}_*"`
    #rustr=`find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*"`
   # variant=`find $lookup/variant -name "*${filenameblock}_*"`
    
    suttanumber="$filenameblock"
    
        if [[ "$language" == "Pali" ]]; then
        file=$roottext
    elif [[ "$language" == "Russian" ]]; then
        file=$rustr
    fi 
    
    
        
translatorsname=`echo $translation | awk -F'/ru/' '{print $2}' | awk -F'/' '{print $1}'`

linkru=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `
#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
#linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
linkpli=`echo $filenameblock |  awk '{print "https://sc.dhamma.gift/?q="$0}' `
count=`egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile

word=`getwords | xargs | clearsed | sed 's/[.?;:]//g' | sed 's/[—‘”"]/ /g' | highlightpattern`
indexlist=`egrep -i $filenameblock $basefile | awk '{print $2}'`

metaphorindexlist=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`cat $file | clearsed | egrep -i "$metaphorkeys" | egrep -v "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 

suttatitle=`grep 'h1' $file | clearsed | xargs `
#quote=`egrep -ih "${pattern}" $file | clearsed | highlightpattern `
echo "<tr>
<td><a target=\"_blank\" href="$linkru">$suttanumber</a></td>
<td>$word</td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><strong>$suttatitle</strong></td>
<td>" | tohtml
egrep -ih "${pattern}" $file | clearsed | highlightpattern  | while IFS= read -r line ; do
echo "$line"
echo '<br class="styled">'
done | tohtml
echo "</td>
<td><a target=\"_blank\" href="$linkpli">Pali</a>    <a target=\"_blank\" href="$linkru">Русский</a></td>
</tr>" | tohtml

done
matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`
cat $templatefolder/Footer.html | tohtml
}

fi

function getbasefile {
egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={xplayground,$sutta,$abhi,$vin,ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} | clearsed > $basefile

if [ ! -s $basefile ]
then
     echo "${pattern} not found in $fortitle $language" 
     rm $basefile
     exit 1
fi

}

getbasefile
#cleanup in case the same search was launched before
rm ${table} table.html $tempfile  $tempfilewords > /dev/null 2>&1

#add links to each file
linklist

textsqnty=`echo $textlist | wc -w`
capitalized=`echo $pattern | sed 's/[[:lower:]]/\U&/'`
title="${capitalized} $textsqnty texts and $matchqnty matches in $fortitle $language"
titlewords="${capitalized} $uniqwordtotal related words and $matchqnty matches in $fortitle $language"

sed -i 's/TitletoReplace/'"$title"'/g' table.html 
sed -i 's/TitletoReplace/'"$title"'/g' ${table}
sed -i 's/TitletoReplace/'"$titlewords"'/g' ${tempfilewords}

echo "Done"

#rm $basefile $tempfile > /dev/null 2>&1
php -r 'header("Location: ./output/table.html");'
php -r "print(\"<a class="outlink" href="/output/${tempfilewords}">Words</a> and <a class="outlink" href="/output/${table}">Quotes</a>\");"
		
exit 0
