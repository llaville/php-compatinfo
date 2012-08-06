HOW TO build yourself The User Guide written for AsciiDoc

NOTE: You should have installed on your system
.For standard HTML or Docbook targets

AsciiDoc 8.6.8
    http://www.methods.co.nz/asciidoc/
Source-Highlight 3.1+
    http://www.gnu.org/software/src-highlite/
or
Pygments 1.3.1+
    http://pygments.org/

.For PDF target
DocBook to LaTeX Publishing
    http://dblatex.sourceforge.net/
or
Apache FOP
    http://xmlgraphics.apache.org/fop/index.html

With basic layout, and linked javascript and styles
$ asciidoc-8.6.8/asciidoc.py
  -a icons
  -a toc2
  -a linkcss
  -a theme=flask
  -n
  -v
  docs/userguide.txt

With basic layout, and embbeded javascript and styles
$ asciidoc-8.6.8/asciidoc.py
  -a icons
  -a toc2
  -a theme=flask
  -n
  -v
  docs/userguide.txt

Or used Phing 2.4.12

But be careful to change first properties 'asciidoc.home' and 'homedir' values 
that reflect your platform and installation.

Since version 2.2.0 you can use alternative solution: use a properties file that define
all values you wan't to overload (example)

phing  /path/to/build-phing.xml -Ddefault.properties=/path/to/your-local.properties

Single Html file
phing  -f /path/to/build-phing.xml  make-userguide

Many Html files
phing  -f /path/to/build-phing.xml  make-userguide-chunked

Microsoft Html Help file (chm format)
phing  -f /path/to/build-phing.xml  make-userguide-htmlhelp

PDF A4 file (with FOP)
phing  -f /path/to/build-phing.xml  make-userguide-pdf-a4

Since version 2.2.2
EPUB file
phing  -f /path/to/build-phing.xml  make-userguide-epub

Since version 2.4.0
PDF US file (with FOP)
phing  -f /path/to/build-phing.xml  make-userguide-pdf-us

Since version 2.7.0
You need also to install 
- AsciiDoc PlantUML filter (Have a look on issue #3 at http://code.google.com/p/asciidoc-plantuml/issues/detail?id=3)
- Graphviz 2.28; Be sure to define environment variable GRAPHVIZ_DOT

On windows platform (for example):
set GRAPHVIZ_DOT=C:\Graphviz\bin\dot.exe
