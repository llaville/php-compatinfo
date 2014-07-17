@ECHO OFF

REM ---
REM --- Windows CMD script
REM --- to build PHP CompatInfo documentation in HTML 5 / Bootstrap 3 format
REM ---
REM --- Released under the Apache 2 license (http://www.apache.org/licenses/LICENSE-2.0.html)
REM --- (c) 2014 Laurent Laville
REM ---


IF "%ASCIIDOC%"==""       SET "ASCIIDOC=C:\asciidoc-8.6.9"
IF "%ASCIIDOC_BIN%"==""   SET "ASCIIDOC_BIN=%ASCIIDOC%\asciidoc.py"
IF "%ASCIIDOC_THEME%"=="" SET "ASCIIDOC_THEME=flatly"

REM --
REM -- WEB HTML5 BOOTSTRAP FORMAT
REM --
ECHO GENERATING WEB HTML5 BOOTSTRAP FORMAT ...

REM --
REM -- USER GUIDE
REM --
ECHO BUILDING USER GUIDE ...

FOR %%f IN (user-guide*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% %%f
)

REM --
REM -- DEVELOPER GUIDE
REM --
ECHO BUILDING DEVELOPER GUIDE ...

FOR %%f IN (developer-guide*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% %%f
)

REM --
REM -- MIGRATION GUIDE
REM --
ECHO BUILDING MIGRATION GUIDE ...

FOR %%f IN (migration-guide*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% %%f
)

REM --
REM -- GETTING STARTED page
REM --
ECHO BUILDING GETTING STARTED ...

"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% getting-started.asciidoc

REM --
REM -- MAN page
REM --
ECHO BUILDING MAN PAGE ...

"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% -d article phpcompatinfo.1.asciidoc

REM --
REM -- REFERENCES page
REM --
ECHO BUILDING REFERENCES ...

"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a navbar=fixed -a totop -a theme=%ASCIIDOC_THEME% references.asciidoc
