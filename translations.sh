#!/bin/bash

PROJECT_NAME='SharingsTheme'

FILE_TYPE='php'

language=( en )

subdirs=( forms lib actions )

SUBDIR=

function combine_files {
	TEMPFILE=/tmp/combine5235.txt
	for lang in "${language[@]}"
	do
		if [ -d locale/${lang}/LC_MESSAGES ]; then
			ALL_PO_FILES=/tmp/combine73518
			cat locale/${lang}/LC_MESSAGES/temp_*.po > $ALL_PO_FILES
			if [ -f $TEMPFILE ]; then
				rm $TEMPFILE
			fi
			BLANK_LINE=
			HEADER=1
			long_message_id=
			long_message_str=
			repeat=
			repeat_str=""
			header_file=/tmp/header367835.txt
			if [ -f $header_file ]; then
				rm $header_file
			fi
			while read line; do
				if [ $HEADER ]; then
					if [ ${#line} -gt 0 ]; then
						echo $line >> $header_file
						echo $line | sed 's|n"|\\n"|g' >> $TEMPFILE
					else
						HEADER=
					fi
				else
					if [ ${#line} -gt 0 ]; then
						BLANK_LINE=1
						if [[ "$line" != '#'* && "$line" != *"charset=ASCII"* ]]; then
							if [[ "$line" == "msgid "* || "$line" == "msgstr "* || "$line" == '"'* ]]; then
								if [[ "$line" == 'msgid ""'* ]]; then
									long_message_id=1
									long_message_str=
								else
									if [[ "$line" == 'msgstr ""'* ]]; then
										long_message_id=
										long_message_str=1
									else
										if ! grep -q "$line" $TEMPFILE; then
											if ! grep -q "$line" $header_file; then

												if [ $long_message_id ]; then
													echo 'msgid ""' >> $TEMPFILE
													repeat=1
													long_message_id=
													long_message_str=
												fi
												if [ $long_message_str ]; then
													echo 'msgstr ""' >> $TEMPFILE
													long_message_str=
												fi
												echo "$line" >> $TEMPFILE
												if [ $repeat ]; then
													if [[ $repeat_str != "" ]]; then
														repeat_str="${repeat_str}
${line}"
													else
														repeat_str="msgstr \"\"
${line}"
													fi
												fi
												BLANK_LINE=
											fi
											long_message_id=
											long_message_str=
										fi
									fi

								fi
							else
								long_message_id=
								long_message_str=
								repeat=
							fi
						else
							long_message_id=
							long_message_str=
							repeat=
						fi
					else
						if [ $repeat ]; then
							echo "$repeat_str" >> $TEMPFILE
						fi

						if [ ! $BLANK_LINE ]; then
							echo $line >> $TEMPFILE
						fi
						BLANK_LINE=1
						long_message_id=
						long_message_str=
						repeat=
						repeat_str=""
					fi
				fi
			done <$ALL_PO_FILES
			rm $ALL_PO_FILES
			if [ -f $TEMPFILE ]; then
				cp $TEMPFILE locale/${lang}/LC_MESSAGES/${PROJECT_NAME}.po
				rm $TEMPFILE
				git add locale/${lang}/LC_MESSAGES/${PROJECT_NAME}.po
			fi
			rm locale/${lang}/LC_MESSAGES/temp_*.po
		fi
	done
}

function create_translation_files {
	create_arg=$1
	if [ ! -d locale ]; then
		mkdir locale
	fi

	TEMPFILE3=/tmp/translate365725.${FILE_TYPE}
	COMMAND_FILES=$SUBDIR/*.${FILE_TYPE}
	for f in $COMMAND_FILES
	do
		echo $f
		cp $f $TEMPFILE3
		sed -i 's|_m(|_(|g' $TEMPFILE3
		COMMAND_NAME=$(echo $f | awk -F '/' '{print $2}')
		POT_FILE=locale/${PROJECT_NAME}.pot
		xgettext --from-code=UTF-8 -o $POT_FILE $TEMPFILE3
		if [ -f $POT_FILE ]; then
			for lang in "${language[@]}"
			do
				if [ ! -d locale/${lang}/LC_MESSAGES ]; then
					mkdir -p locale/${lang}/LC_MESSAGES
				fi

				PO_NAME=$(echo $COMMAND_NAME | awk -F '.' '{print $1}')
				if [[ ! -f locale/${lang}/LC_MESSAGES/${PROJECT_NAME}.po || "$create_arg" == "--force" ]]; then
					if [[ ! -f locale/${lang}/LC_MESSAGES/temp_${SUBDIR}_${PO_NAME}.po || "$create_arg" == "--force" ]]; then
						# create po file
						echo "Creating ${lang} Translation file for ${COMMAND_NAME}..."
						msginit --no-translator -l ${lang} -i $POT_FILE -o locale/${lang}/LC_MESSAGES/temp_${SUBDIR}_${PO_NAME}.po
					fi
				fi
			done
			rm $POT_FILE
		fi
		rm $TEMPFILE3
	done
}

function translate {
	if [[ "$1" == "--force" ]]; then
		for lang in "${language[@]}"
		do
			if [ -d locale/${lang}/LC_MESSAGES ]; then
				rm locale/${lang}/LC_MESSAGES/*.po locale/${lang}/LC_MESSAGES/*.mo
			fi
		done
	fi

	for sub in "${subdirs[@]}"
	do
		SUBDIR=$sub
		create_translation_files ${1}
	done
	combine_files
}

translate ${1}

exit 0
