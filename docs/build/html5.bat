@ECHO OFF

REM ---
REM --- Windows CMD script
REM --- to build PHP CompatInfo documentation in HTML 5 format
REM ---
REM --- Released under the Apache 2 license (http://www.apache.org/licenses/LICENSE-2.0.html)
REM --- (c) 2014 Laurent Laville
REM ---


IF "%ASCIIDOC%"==""       SET "ASCIIDOC=C:\asciidoc-8.6.9"
IF "%ASCIIDOC_BIN%"==""   SET "ASCIIDOC_BIN=%ASCIIDOC%\asciidoc.py"
IF "%ASCIIDOC_THEME%"=="" SET "ASCIIDOC_THEME=flatly"

REM --
REM -- WEB HTML5 FORMAT
REM --
ECHO GENERATING WEB HTML5 FORMAT ...

REM --
REM -- USER GUIDE
REM --
ECHO BUILDING USER GUIDE ...

FOR %%f IN (user-guide*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b html5 -a leveloffset=1 -a linkcss -a stylesdir=../stylesheets -a scriptsdir=../javascripts -a imagesdir=../images -a iconsdir=../images/icons -a icons %%f
)

MOVE user-guide*.html html5/

REM --
REM -- DEVELOPER GUIDE
REM --
ECHO BUILDING DEVELOPER GUIDE ...

FOR %%f IN (developer-guide*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b html5 -a leveloffset=1 -a linkcss -a stylesdir=../stylesheets -a scriptsdir=../javascripts -a imagesdir=../images -a iconsdir=../images/icons -a icons %%f
)
"%ASCIIDOC_BIN%" -b html5 -a leveloffset=1 -a linkcss -a stylesdir=../stylesheets -a scriptsdir=../javascripts -a imagesdir=../images -a iconsdir=../images/icons -a icons api-compared.asciidoc

MOVE developer-guide*.html html5/
MOVE api-compared.html html5/

REM --
REM -- MIGRATION GUIDE
REM --
ECHO BUILDING MIGRATION GUIDE ...

"%ASCIIDOC_BIN%" -b html5 -a leveloffset=1 -a linkcss -a stylesdir=../stylesheets -a scriptsdir=../javascripts -a imagesdir=../images -a iconsdir=../images/icons -a icons migration-guide.asciidoc

MOVE migration-guide.html html5/

REM --
REM -- GETTING STARTED page
REM --
ECHO BUILDING GETTING STARTED ...

"%ASCIIDOC_BIN%" -b html5 -a leveloffset=1 -a linkcss -a stylesdir=../stylesheets -a scriptsdir=../javascripts -a imagesdir=../images -a iconsdir=../images/icons -a icons getting-started.asciidoc

MOVE getting-started.html html5/
