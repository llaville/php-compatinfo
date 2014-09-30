@ECHO OFF

REM ---
REM --- Windows CMD script
REM --- to build the blog pages of PHP CompatInfo
REM ---
REM --- Released under the Apache 2 license (http://www.apache.org/licenses/LICENSE-2.0.html)
REM --- (c) 2014 Laurent Laville
REM ---


IF "%ASCIIDOC%"==""       SET "ASCIIDOC=C:\asciidoc-8.6.9"
IF "%ASCIIDOC_BIN%"==""   SET "ASCIIDOC_BIN=%ASCIIDOC%\asciidoc.py"
IF "%ASCIIDOC_THEME%"=="" SET "ASCIIDOC_THEME=flatly"

REM --
REM -- BLOG
REM --
ECHO BUILDING BLOG ...

IF -%1-==-- GOTO MULTI

:SINGLE
"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a totop -a theme=%ASCIIDOC_THEME% %1

GOTO END

:MULTI

FOR %%f IN (*.asciidoc) DO (
"%ASCIIDOC_BIN%" -b bootstrap -a linkcss -a totop -a theme=%ASCIIDOC_THEME% %%f
)

:END
