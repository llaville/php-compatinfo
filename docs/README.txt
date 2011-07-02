HOW TO build yourself The User Guide written for AsciiDoc

NOTE: You should have installed on your system
.For standard HTML or Docbook targets

AsciiDoc 8.6.5
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
$ asciidoc-8.6.5/asciidoc.py
  -a icons
  -a toc2
  -a linkcss
  -a theme=flask
  -n
  -v
  docs/userguide.txt

With basic layout, and embbeded javascript and styles
$ asciidoc-8.6.5/asciidoc.py
  -a icons
  -a toc2
  -a theme=flask
  -n
  -v
  docs/userguide.txt

Or used Phing 2.4.5

But be careful to change first properties 'asciidoc.home' and 'homedir' values 
that reflect your platform and installation.

Single Html file
phing  -f /path/to/build-phing.xml  make-userguide

Many Html files
phing  -f /path/to/build-phing.xml  make-userguide-chunked

Microsoft Html Help file (chm format)
phing  -f /path/to/build-phing.xml  make-userguide-htmlhelp

PDF file (with FOP)
phing  -f /path/to/build-phing.xml  make-userguide-pdf
