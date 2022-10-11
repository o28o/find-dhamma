#!/bin/bash -i
#set -x 
#trap read debug
source /home/a0092061/domains/find.dhamma.gift/public_html/scripts/script_config.sh --source-only
cd $output 

if [[ "$@" == *"-oru"* ]]; then
excluderesponse="исключая"
function bgswitch {
	echo "Найдено $linescount строк с $pattern<br> 
	Отправлено в фоновый режим.<br>
	Подождите 20-30 минут<br>
	и проверьте <a class=\"outlink\" href="./output/${table}">здесь</a><br>
	или в истории поиска." 
}

function emptypattern {
   echo "Что искать?"
}

function OKresponse {
  echo "${capitalized}${addtotitleifexclude} $textsqnty в $fortitle $language - "
#echo "$language - "
}

function Erresponse {
     echo "${pattern} нет в $fortitle $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./output/${tempfilewords}">Слова</a> и \");"  
}

function quoteresponse {
	php -r "print(\"<a class="outlink" href="./output/${table}">Цитаты</a><br>\n\");"
	
}
function minlengtherror {
echo "Слишком коротко. Мин $minlength символа"
}

elif [[ "$@" == *"-ogr"* ]]; then
excluderesponse="исключая"
function bgswitch {
	echo "Найдено $linescount строк с $pattern<br> 
	Отправлено в фоновый режим.<br>
	Подождите 20-30 минут<br>
	и проверьте <a class=\"outlink\" href="./output/${table}">здесь</a><br>
	или в истории поиска." 
}

function emptypattern {
   echo "Что искать?"
}

function OKresponse {
echo "$language - "
#echo "$language - "
}

function Erresponse {
     echo "нет в $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./output/${tempfilewords}">Слова</a> и \");"  
}

function quoteresponse {
	php -r "print(\"<a class="outlink" href="./output/${table}">Цитаты</a><br>\n\");"
	
}
function minlengtherror {
echo "Слишком коротко. Мин $minlength символа"
}

elif [[ "$@" == *"-oge"* ]]; then
excluderesponse="excluding"
function bgswitch {
	echo "$linescount $pattern lines found.<br> 
	Switched to background mode.<br>
	Wait for 20-30 minutes <br>
	and check <a class=\"outlink\" href="./output/${table}">here</a><br>
	or in search history." 
}

function emptypattern {
   echo "Empty pattern"
}


function OKresponse {
echo "$language - "
#echo "$language - "
}

function Erresponse {
     echo "not in $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./output/${tempfilewords}">Words</a> and \");"
}

function quoteresponse {
php -r "print(\"<a class="outlink" href="./output/${table}">Quotes</a><br>\n\");"

}

function minlengtherror {
echo Too short. Min is $minlength
}



else #eng
excluderesponse="excluding"
function bgswitch {
	echo "$linescount $pattern lines found.<br> 
	Switched to background mode.<br>
	Wait for 20-30 minutes <br>
	and check <a class=\"outlink\" href="./output/${table}">here</a><br>
	or in search history." 
}

function emptypattern {
   echo "Empty pattern"
}


function OKresponse {
echo "${capitalized}${addtotitleifexclude} $textsqnty in $fortitle $language - "
#echo "$language - "
}

function Erresponse {
     echo "${pattern} not in $fortitle $language<br>"
     #echo "$language - no<br>"
}

function wordsresponse {
php -r "print(\"<a class="outlink" href="./output/${tempfilewords}">Words</a> and \");"
}

function quoteresponse {
php -r "print(\"<a class="outlink" href="./output/${table}">Quotes</a><br>\n\");"

}

function minlengtherror {
echo Too short. Min is $minlength
}

fi

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
if [[ "$@" == *"-h"* ]]; then
    echo "
    without arguments - starts with prompt in pali<br>
    also search words can be used as arguments e.g.<br>
    <br>
    $> ./scriptname.sh moggall<br>
    <br>
    -vin - to search in vinaya texts only <br>
    -abhi - to search in abhidhamma texts only <br>
    -en - to search in english <br>
    -ru - to search in russian <br>
    -th - to search in thai <br>
    -pli - to search in pali (default option) <br>
    -nbg - no background <br>
	-kn - include Khuddaka Nikaya selected books <br>
	-oru - output messages in Russian<br>"
    exit 0
fi

pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs `
if [[ "$pattern" == "" ]] ||  [[ "$pattern" == "-ru" ]] || [[ "$pattern" == "-en" ]] || [[ "$pattern" == "-th" ]]  || [[ "$pattern" == "-oru" ]]  || [[ "$pattern" == "-nbg" ]] || [[ "$pattern" == "-ogr" ]] || [[ "$pattern" == "-oge" ]] 
then   
#echo -e "Content-Type: text/html\n\n"
emptypattern
   exit 3
fi
    

if   [ "${#pattern}" -lt "$minlength" ]
then
minlengtherror
exit 1 
fi
#echo searching $pattern
#pattern=adhivacanas
#set search language from args or set default

grepgenparam=E


#if you want to use this script for other languages, add blocks that are needed with your language which must be available on suttacentra.net
lookup=$suttapath/sc-data/sc_bilara_data

function clearsed {
sed 's/<p>/\n/g; s/<[^>]*>//g'  | sed  's/": "/ /g' | sed  's/"//1' | sed 's/",$//g' 
}


vin=vinaya
abhi=abhidhamma
sutta=mutta
fortitle=Suttanta
fileprefix=_suttanta
if [[ "$@" == *"-vin"* ]]; then
    vin=dummy
    sutta=sutta
	fortitle=Vinaya
    #echo search in vinaya
    fileprefix=_vinaya
fi
if [[ "$@" == *"-abhi"* ]]; then
    abhi=dummy
    sutta=sutta
	fortitle=Abhidhamma
    fileprefix=_abhidhamma
    #echo search in abhidhamma
fi
 
function grepbasefile {
nice -19 egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv,thag,thig,snp,dhp,iti,ud} 
}

if [[ "$@" == *"-kn"* ]]; then
function grepbasefile {
nice -19 egrep -Ri${grepvar}${grepgenparam} "$pattern" $suttapath/$pali_or_lang --exclude-dir={$sutta,$abhi,$vin,xplayground,name,site} --exclude-dir={ab,bv,cnd,cp,ja,kp,mil,mnd,ne,pe,ps,pv,tha-ap,thi-ap,vv} 
}
#| nice -19 egrep -v "snp|thag|thig|dhp|iti|ud"
fi

if [[ "$@" == *"-th"* ]]; then
    fnlang=_th
    pali_or_lang=sc-data/html_text/th/pli 
    language=Thai
	printlang=ไทย
    directlink=
    type=html   
    metaphorkeys="подоб|представь|обозначение"
    nonmetaphorkeys="подобного|подоба"
elif [[ "$@" == *"-ru"* ]]; then
    fnlang=_ru
    pali_or_lang=sc-data/html_text/ru/pli 
    language=Russian
	printlang=Русский
    directlink=
    type=html   
    metaphorkeys="подобно|представь|обозначение|пример"
    nonmetaphorkeys="подобного"
elif [[ "$@" == *"-pli"* ]]; then
    fnlang=_pali
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan|ūpama|opama|opamma"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath|ekarūp|tathārūpa|āmarūpa|\brūpa|evarūpa|\banopam|\battūpa|\bnillopa|opamaññ"
   #modify pattern as legacy uses different letters
    #pattern=`echo "$pattern" |  awk '{print tolower($0)}' | clearargs`
elif [[ "$@" == *"-en"* ]]; then
    fnlang=_en
	printlang=English
    pali_or_lang=sc-data/sc_bilara_data/translation/en/
    language=English
    type=json
    metaphorkeys="suppose|is a term for|similar to |simile"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath" 
else
    fnlang=_pali
    pali_or_lang=sc-data/sc_bilara_data/root/pli/ms
    directlink=/pli/ms
    #directlink=/en/?layout=linebyline
    language=Pali
    type=json
    metaphorkeys="seyyathāpi|adhivacan|ūpama|opama|opamma"
    nonmetaphorkeys="adhivacanasamphass|adhivacanapath|ekarūp|tathārūpa|āmarūpa|\brūpa|evarūpa|\banopam|\battūpa|\bnillopa|opamaññ"
fi


if [[ "$@" == *"-exc"* ]]
then
excludepattern="`echo $@ | awk -F'-exc ' '{print $2}'`"
addtotitleifexclude=" excluding $excludepattern"
addtoresponseexclude=" $excluderesponse $excludepattern"
function grepexclude {
egrep -viE "$excludepattern"
}
excfn="-exc-${excludepattern}"
else
function grepexclude {
pvlimit 
}
fi

#filename
fn=`echo $pattern | sed 's/\*//g' | sed 's/[|-]/_/g' | sed 's/ /_/g' | sed 's/\\\//g' |  awk '{print tolower($0)}'`
fn=${fn}${excfn}${fileprefix}${fnlang}

extention=txt
basefile=${fn}_fn.$extention

#filelist
#words=${fn}_words.$extention
#links=${fn}_links.$extention
#links_and_words=${fn}_links_words.$extention
#quotes=${fn}_quotes.$extention
#brief=${fn}_brief.$extention
#metaphors=${fn}_metaphors.$extention
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

filesize=$(stat -c%s "${table}")

if (( $filesize >= $filesizenooverwrite )) && [[ "`tail -n1 ${table}`" == "</html>" ]] 
then
	#echo Already 
OKresponse

	if [[ "$language" == "Pali" ]] 
	then 
	wordsresponse
	fi
	quoteresponse
	
	exit 0
#else 
#	echo Already 
fi 

fi


function genwordsfile {

cat $tempfilewords | pvlimit | sedexpr | awk '{print tolower($0)}' | tr -s ' '  '\n' | sort | uniq -c | awk '{print $2, $1}' > $tempfile

uniqwordtotal=`cat $tempfile | pvlimit | sort | uniq | wc -l `
#| sed 's/(//g' | sed 's/)//g'
#cat $tempfile
#echo cat

#cat $templatefolder/Header.html $templatefolder/WordTableHeader.html | sed 's/$title/TitletoReplace/g' > $tempfilewords 
cat $templatefolder/Header.html $templatefolder/WordTableHeader.html | sed 's/$title/TitletoReplace/g' > $tempfilewords 

nice -19 cat $tempfile | pvlimit | while IFS= read -r line ; do
uniqword=`echo $line | awk '{print $1}'`
uniqwordcount=`echo $line | awk '{print $2}'`
linkscount=`nice -19 grep -i "\b$uniqword\b" $basefile | sort | awk '{print $1}' | awk -F'/' '{print $NF}' | sort | uniq | wc -l`
linkswwords=`grep -i "\b$uniqword\b" $basefile | sort -V | awk '{print $1}' | awk -F'/' '{print $NF}' | sort -V | uniq | awk -F'_' '{print "<a target=_blank href=https://find.dhamma.gift/sc/?q="$1">"$1"</a>"}'| xargs`

#echo $linkswwords
#cat ${links_and_words}  | tr ' ' '\n' |  nice -19 egrep -i$grepgenparam "$pattern"  | sed -e 's/<[^>]*>//g' | sed 's/[".;:?,]/ /g' | sed -e 's/“/ /g' -e 's/‘/ /g'| sed 's/.*= //g' | sed 's@/legacy-suttacentral-data-master/text/pi/su@@g' | sed 's/.*>//g'| sed -e 's/^[[:space:]]*//' -e 's/[[:space:]]*$//' | tr '[:upper:]' '[:lower:]'  | sort | uniq > ${words}


#cat $file | clearsed | sed 's/[.,?;:]//g' | sed 's/[—”"]/ /g'| grep -io$grepgenparam "[^ ]*$pattern[^ ]*" | sort | uniq >> ${links_and_words}

echo "<tr>
<td class=\"longword\">`echo $uniqword | highlightpattern`</td>
<td>$linkscount</td>   
<td>$uniqwordcount</td>   
<td>$linkswwords</td>
</tr>" >>$tempfilewords
done

echo "</tbody>
</table>
<a href="/">Main page</a>&nbsp;
<a href="/output/${table}">Quotes</a>
" >> $tempfilewords

cat $templatefolder/Footer.html >> $tempfilewords

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

textlist=`nice -19  cat $basefile | pvlimit | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -V | uniq`

for filenameblock in `nice -19 cat $basefile | pvlimit | awk -F':' '{print $1}' | awk -F'/' '{print $NF}' |  awk -F'_' '{print $1}' | sort -V | uniq` ; do 

    roottext=`nice -19 find $lookup/root -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    translation=`nice -19 find $lookup/translation/en/ -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    rustr=`nice -19 find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    variant=`nice -19 find $lookup/variant -name "*${filenameblock}_*" -not -path "*/blurb/*" -not  -path "*/name*" -not -path "*/site/*"`
    
    rusnp=`echo $filenameblock | sed 's@\.@_@g'`
    rustr=`nice -19 find $searchdir -name "*${rusnp}-*"`

     rusthrulink=`echo $rustr | sed 's@.*theravada.ru@https://www.theravada.ru@g'`

if [[ $filenameblock == *"dn"* ]]
then 
dnnumber=`echo $filenameblock | sed 's/dn//g'`
rusthrulink=`curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep "ДН $dnnumber" | sed 's#href="#href="https://tipitaka.theravada.su#' |awk -F'"' '{print $2}'`
  fi 
    if [[ "$language" == "Pali" ]]; then
        file=$roottext
    elif [[ "$language" == "English" ]]; then
        file=$translation
    fi 
    
translatorsname=`echo $translation | awk -F'/en/' '{print $2}' | awk -F'/' '{print $1}'`

suttanumber="$filenameblock"

if [[ "$fortitle" == "Suttanta" ]]
then
linkthai=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/th/siam_rath"}' `
linkrus=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0""}' `
fi

#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}'`
linkgeneral=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli-eng"}' `
#linkgeneral=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `
linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
#linken=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q='$translatorsname'}' `
#linken=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=eng"}' `
linkpli=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli"}' `
#linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile
#russian text 
#link ru 
#translatorsname=`echo $rustr | awk -F'/ru/' '{print $2}' | awk -F'/' '{if ($4 ~ /html/ || $4 ~ /[0-9]/ || $NF > 3 ) print "sv"; else print $4}'`
#echo -e "`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/ru/'$translatorsname'"}' ` " | tee -a ${quotes} ${links_and_words}  ${metaphors} #>/dev/null
#/home/a0092061/scripts/suttacentral.net/sc-data-master/html_text/ru/pli/sutta
#${textspi} ${textsru} ${textsen}
#`grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `


word=`getwords | removeindex | clearsed | sedexpr | awk '{print tolower($0)}' | highlightpattern | sort | uniq | xargs` 
indexlist=`nice -19 egrep -i "${suttanumber}:" $basefile | awk '{print $2}' | sort -V | uniq`

indexlist=$(for i in $indexlist
do
nice -19 egrep -A${linesafter} -iE "${i}(:|[^0-9]|$)" $roottext | grep -v "^--$" | awk '{print $1}' | clearsed | sedexpr | sort -V | uniq
done)

#metaphorindexlist=`nice -19 cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`nice -19 cat $file | pvlimit | clearsed | nice -19 egrep -iE "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 

suttatitle=`nice -19 grep ':0\.' $file | clearsed | awk '{print substr($0, index($0, $2))}' | xargs `

echo "<tr>
<td><a class=\"freebutton\" target=\"_blank\" href="$linkgeneral">$suttanumber</a></td>
<td><div class=\"wordwrap\">$word<div></td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><strong>$suttatitle</strong></td>
<td>" | tohtml 

 
for i in $indexlist
do
#echo "<strong>$i</strong>"
		for f in $roottext $translation #$variant
        do     
        #echo rt=$roottext
		quote=`nice -19 egrep -iE "${i}(:|[^0-9]|$)" $f | grep -v "^--$" | removeindex | clearsed | awk '{print substr($0, index($0, $2))}'  | highlightpattern `
      if [[ "$quote" != "" ]]
then 
[[ "$f" == *"root"* ]] && echo "$quote<br class=\"btwntrn\">" || echo "<p class=\"text-muted font-weight-light\">$quote</p>"
fi
done

echo '<br class="styled">'
done | tohtml 

echo  "</td>
<td><a target=\"_blank\" href="$linkpli">Pāḷi</a> 
`[[ $rusthrulink != "" ]] && echo "<a target=\"_blank\" href="$rusthrulink">Русский</a>"` 
`[[ $rusthrulink == "" ]] && [[ $linkrus != "" ]] && echo "<a target=\"_blank\" href="$linkrus">Русский</a>"` 
`[[ $linkthai != "" ]] && echo "<a target=\"_blank\" href="$linkthai">ไทย</a>"` <a target=\"_blank\" href="$linken">English</a></td>
</tr>" | tohtml

done
matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`




#Sibbin 999 matches in 444 texts of Pali Suttas
echo "</tbody>
</table>
<a href="/">Main page</a>&nbsp;
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


uniquelist=`cat $basefile | pvlimit | awk '{print $1}' | awk -F'/' '{print $NF}' | sort -V | uniq`
#| grep "html:"
textlist=$uniquelist

#edit me edn
    for i in $uniquelist
do

    filenameblock=`echo $i |  sed 's/.html//g' | sort -V | uniq `
file=`grep -m1 $filenameblock $basefile`
   # count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l` 
rustr=$file

    #roottext=`find $lookup/root -name "*${filenameblock}_*"`
   # translation=`find $lookup/translation/en/ -name "*${filenameblock}_*"`
    #rustr=`find $suttapath/sc-data/html_text/ru/pli -name "*${filenameblock}*"`
   # variant=`find $lookup/variant -name "*${filenameblock}_*"`
    
    suttanumber="$filenameblock"
	linkgeneral=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0}' `

linklang=$linkgeneral

    
        if [[ "$language" == "Pali" ]]; then
        file=$roottext
    elif [[ "$language" == "Russian" ]]; then
        file=$rustr
		
	
	   rusnp=`echo $filenameblock | sed 's@\.@_@g'`
    rustr=`find $searchdir -name "*${rusnp}-*"`

     rusthrulink=`echo $rustr | sed 's@.*theravada.ru@https://www.theravada.ru@g'`


linklang=$rusthrulink	
fi

linkthai=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/th/siam_rath"}' `

  
 if [[ $filenameblock == *"dn"* ]]
then 
dnnumber=`echo $filenameblock | sed 's/dn//g'`
linklang=`curl -s https://tipitaka.theravada.su/toc/translations/1098 | grep "ДН $dnnumber" | sed 's#href="#href="https://tipitaka.theravada.su#' |awk -F'"' '{print $2}'`
  fi    
        
#translatorsname=`echo $translation | awk -F'/ru/' '{print $2}' | awk -F'/' '{print $1}'`
#linken=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/en/'$translatorsname'?layout=linebyline"}' `
#linkpli=`echo $filenameblock |  awk '{print "https://suttacentral.net/"$0"/pli/ms"}' `
linkpli=`echo $filenameblock |  awk '{print "https://find.dhamma.gift/sc/?q="$0"&lang=pli"}' `
count=`nice -19 egrep -oi$grepgenparam "$pattern" $file | wc -l ` 
echo $count >> $tempfile

word=`getwords | xargs | clearsed | sedexpr | highlightpattern`
indexlist=`nice -19 egrep -i $filenameblock $basefile | awk '{print $2}'`

#metaphorindexlist=`cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'` 

metaphorcount=`cat $file | pvlimit | clearsed | nice -19 egrep -i "$metaphorkeys" | nice -19 egrep -vE "$nonmetaphorkeys" | awk '{print $1}'| wc -l` 

suttatitle=`grep 'h1' $file | clearsed | xargs `
#quote=`nice -19 egrep -ih "${pattern}" $file | clearsed | highlightpattern `
echo "<tr>
<td><a target=\"_blank\" href="$linkgeneral">$suttanumber</a></td>
<td>$word</td>
<td>$count</td>   
<td>$metaphorcount</td>
<td><strong>$suttatitle</strong></td>
<td>" | tohtml
nice -19 egrep -A${linesafter} -ih "${pattern}" $file | grep -v "^--$" | clearsed | highlightpattern  | while IFS= read -r line ; do
echo "$line"
echo '<br class="styled">'
done | tohtml
echo "</td>
<td><a target=\"_blank\" href="$linkpli">Pāḷi</a>&nbsp;<a target=\"_blank\" href="$linklang">"$printlang"</a>`[[ $rusthrulink != "" ]] && [[ "$rusthrulink" != "$linklang" ]] && echo "&nbsp;<a target=\"_blank\" href="$rusthrulink">Вариант 2</a>"` `[[ $linkthai != "" ]] && echo "<a target=\"_blank\" href="$linkthai">ไทย</a>"`</td>
</tr>" | tohtml

done
matchqnty=`awk '{sum+=$1;} END{print sum;}' $tempfile`
echo "</tbody>
</table>
<a href="/">Main page</a>&nbsp;
<a href="/output/${tempfilewords}">Words</a>
" | tohtml

cat $templatefolder/Footer.html | tohtml
}

fi

function getbasefile {
grepbasefile | grep -v "^--$" | grepexclude | clearsed > $basefile

linescount=`wc -l $basefile | awk '{print $1}'`
if [ ! -s $basefile ]
then
	Erresponse
     rm $basefile
     exit 1
elif [ $linescount -ge $maxmatchesbg ] && [[ "$@" != *"-nbg"* ]];  then  
bgswitch
	echo "$@" | sed 's/-oru //g' | sed 's/-oge //g' | sed 's/-ogr //g'   | sed 's/-nbg //g' >> ../input/input.txt
	exit 3
fi

}
rm $basefile > /dev/null 2>&1
getbasefile $@ 
#cleanup in case the same search was launched before
rm ${table} table.html $tempfile  $tempfilewords > /dev/null 2>&1

#add links to each file
linklist

genwordsfile

textsqnty=`echo $textlist | wc -w`
capitalized=`echo $pattern | sed 's/[[:lower:]]/\U&/'`
title="${capitalized}${addtotitleifexclude} $textsqnty texts and $matchqnty matches in $fortitle $language"
titlewords="${capitalized} $uniqwordtotal related words in $textsqnty texts and $matchqnty matches in $fortitle $language"

sed -i 's/TitletoReplace/'"$title"'/g' table.html 
sed -i 's/TitletoReplace/'"$title"'/g' ${table}
sed -i 's/TitletoReplace/'"$titlewords"'/g' ${tempfilewords}

#echo "${fortitle^} $language"
OKresponse

#rm $basefile $tempfile > /dev/null 2>&1
#php -r 'header("Location: ./output/table.html");'

if [[ "$language" == "Pali" ]]
then 
#echo "$language -"
wordsresponse

fi
quoteresponse
exit 0
