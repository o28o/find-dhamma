function texts {

if [[ "$@" == *"-oru"* ]]; then

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
echo "${pattern^} $fortitle $language - "
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

function bgswitch {
	echo "$linescount $pattern lines found.<br> 
	Switched to background mode.<br>
	Wait for 20-30 minutes <br>
	and check <a class=\"outlink\" href="./output/${table}">here</a><br>
	or in search history." 
}

function emptypattern {
   echo "Emptry pattern"
}


function OKresponse {
echo "$language - "
#echo "$language - "
}

function Erresponse {
     echo "not fount<br>"
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

function bgswitch {
	echo "$linescount $pattern lines found.<br> 
	Switched to background mode.<br>
	Wait for 20-30 minutes <br>
	and check <a class=\"outlink\" href="./output/${table}">here</a><br>
	or in search history." 
}

function emptypattern {
   echo "Emptry pattern"
}


function OKresponse {
echo "${pattern^} $fortitle $language - "
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
}


function pvlimit {
pv -L 2m -q 
}

function clearargs {
sed -e 's/-pli //g' -e 's/-pi //g' -e 's/-ru //g' -e 's/-en //g' -e 's/-abhi //g' -e 's/-vin //g' -e 's/-th //g' -e 's/^ //g' -e 's/-kn //g' | sed 's/-oru //g' | sed 's/-ogr //g' | sed 's/-oge //g'| sed 's/-nbg //g'
}


function removeindex {
sed -e 's/:.*": "/": "/' #      sed 's/ /:/1' | awk -F':'  '{print $1, $3}'
}

function tohtml {
tee -a ${table} table.html > /dev/null
} 

function sedexpr {
sed 's/\.$//g' | sed 's/:$//g' | sed 's/[,!?;«—”“‘"]/ /g' | sed 's/)//g' | sed 's/(//g'  
}

function cleanwords {
  cat $file | removeindex | clearsed | sedexpr | awk '{print tolower($0)}' |egrep -io$grepgenparam "[^ ]*$pattern[^ ]*"
  }
  
#| sed 's/’ti//g'  
function getwords {
cleanwords | sort | uniq 
cleanwords | tee -a $tempfilewords > /dev/null

}

function highlightpattern {
sed "s@$pattern@<b>&</b>@gI"
}



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

function checkifempty {

if [[ "$pattern" == "" ]] ||  [[ "$pattern" == "-ru" ]] || [[ "$pattern" == "-en" ]] || [[ "$pattern" == "-th" ]]  || [[ "$pattern" == "-oru" ]]  || [[ "$pattern" == "-nbg" ]] || [[ "$pattern" == "-ogr" ]] || [[ "$pattern" == "-oge" ]] 
then   
#echo -e "Content-Type: text/html\n\n"
emptypattern
   exit 3
fi
    
}

function clearsed {
sed 's/<p>/\n/g; s/<[^>]*>//g'  | sed  's/": "/ /g' | sed  's/"//1' | sed 's/",$//g' 
}


function whichpitaka {
vin=vinaya
abhi=abhidhamma
sutta=mutta
fortitle=Suttanta
fileprefix=_suttanta
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
}




function ifalready {
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

}