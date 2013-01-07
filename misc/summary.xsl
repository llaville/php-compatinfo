<?xml version="1.0" encoding="ISO-8859-1"?>
<!--
 summary.xsl - xslt stylesheet for converting phpci xml report to a
               XHTML summary page

 Copyright (c) 2010-2013, Laurent Laville <pear@laurent-laville.org>

 All rights reserved.

 Redistribution and use in source and binary forms, with or without
 modification, are permitted provided that the following conditions
 are met:

     * Redistributions of source code must retain the above copyright
       notice, this list of conditions and the following disclaimer.
     * Redistributions in binary form must reproduce the above copyright
       notice, this list of conditions and the following disclaimer in the
       documentation and/or other materials provided with the distribution.
     * Neither the name of the authors nor the names of its contributors
       may be used to endorse or promote products derived from this software
       without specific prior written permission.

 THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS
 BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 POSSIBILITY OF SUCH DAMAGE.
-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output method="html" version="4.0" encoding="ISO-8859-1"/>

    <xsl:key name="extensions" match="extensions/extension" use="@name"/>

    <xsl:key name="interfaces" match="interfaces/interface" use="@name"/>
    <xsl:key name="interfaceExtensions" match="interfaces/interface" use="@extension"/>

    <xsl:key name="traits" match="traits/trait" use="@name"/>
    <xsl:key name="traitExtensions" match="traits/trait" use="@extension"/>

    <xsl:key name="classes" match="classes/class" use="@name"/>
    <xsl:key name="classExtensions" match="classes/class" use="@extension"/>

    <xsl:key name="functions" match="functions/function" use="@name"/>
    <xsl:key name="functionExtensions" match="functions/function" use="@extension"/>

    <xsl:key name="constants" match="constants/constant" use="@name"/>
    <xsl:key name="constantExtensions" match="constants/constant" use="@extension"/>

    <xsl:template match="/">
        <html>
        <head>
            <xsl:apply-templates select="phpcompatinfo" mode="head" />
            <title>PHP_CompatInfo Summary Report</title>
            <link rel="stylesheet" type="text/css" href="phpci.css"/>
            <script type="text/javascript" src="jquery.min.js" />
            <script type="text/javascript">
            $(document).ready(function() {
                var toggleMinus = 'bullet_toggle_minus.png';
                var togglePlus = 'bullet_toggle_plus.png';
                var $subHead = $('table.summary tbody th:first-child');
                $subHead.prepend('&lt;img src="' + togglePlus + '"alt="[+]" title="expand this section" /&gt;');
                $('img', $subHead).addClass('clickable')
                    .click(function() {
                    var toggleSrc = $(this).attr('src');
                    if ( toggleSrc == toggleMinus ) {
                        $(this).attr('alt', "[+]");
                        $(this).attr('title', "expand this section");
                        $(this).attr('src', togglePlus)
                            .parents('tr').siblings().fadeOut('fast')
                    } else{
                        $(this).attr('alt', "[-]");
                        $(this).attr('title', "collapse this section");
                        $(this).attr('src', toggleMinus)
                            .parents('tr').siblings().fadeIn('fast')
                    }
                });
                $subHead.parents('tr').siblings().fadeOut('fast');
            }); 
            </script>
        </head>
        <body>
        <h1>PHP_CompatInfo - Summary</h1>
        <xsl:variable name="extensionCount" select="//file/extensions/extension[generate-id(.) = generate-id(key('extensions',@name))]/@name" />

        <xsl:variable name="interfaceNodes" select="//file/interfaces/interface[generate-id(.) = generate-id(key('interfaces',@name))]" />
        <xsl:variable name="interfaceExtensionNodes" select="//file/interfaces/interface[generate-id(.) = generate-id(key('interfaceExtensions',@extension))]/@extension" />

        <xsl:variable name="traitNodes" select="//file/traits/trait[generate-id(.) = generate-id(key('traits',@name))]" />
        <xsl:variable name="traitExtensionNodes" select="//file/traits/trait[generate-id(.) = generate-id(key('traitExtensions',@extension))]/@extension" />

        <xsl:variable name="classNodes" select="//file/classes/class[generate-id(.) = generate-id(key('classes',@name))]" />
        <xsl:variable name="classExtensionNodes" select="//file/classes/class[generate-id(.) = generate-id(key('classExtensions',@extension))]/@extension" />

        <xsl:variable name="functionNodes" select="//file/functions/function[generate-id(.) = generate-id(key('functions',@name))]" />
        <xsl:variable name="functionExtensionNodes" select="//file/functions/function[generate-id(.) = generate-id(key('functionExtensions',@extension))]/@extension" />

        <xsl:variable name="constantNodes" select="//file/constants/constant[generate-id(.) = generate-id(key('constants',@name))]" />
        <xsl:variable name="constantExtensionNodes" select="//file/constants/constant[generate-id(.) = generate-id(key('constantExtensions',@extension))]/@extension" />

        <dl>
            <dt>Extensions: <xsl:value-of select="count($extensionCount)" /></dt>
            <xsl:for-each select="$extensionCount">
                <xsl:sort select="." />
                <dd><xsl:value-of select="." /></dd>
            </xsl:for-each>

            <dt>Interfaces: <xsl:value-of select="count($interfaceNodes)" /></dt>
            <xsl:call-template name="counters">
                <xsl:with-param name="extensionNodes" select="$interfaceExtensionNodes" />
                <xsl:with-param name="nodes" select="$interfaceNodes" />
            </xsl:call-template>

            <dt>Traits: <xsl:value-of select="count($traitNodes)" /></dt>
            <xsl:call-template name="counters">
                <xsl:with-param name="extensionNodes" select="$traitExtensionNodes" />
                <xsl:with-param name="nodes" select="$traitNodes" />
            </xsl:call-template>

            <dt>Classes: <xsl:value-of select="count($classNodes)" /></dt>
            <xsl:call-template name="counters">
                <xsl:with-param name="extensionNodes" select="$classExtensionNodes" />
                <xsl:with-param name="nodes" select="$classNodes" />
            </xsl:call-template>

            <dt>Functions: <xsl:value-of select="count($functionNodes)" /></dt>
            <xsl:call-template name="counters">
                <xsl:with-param name="extensionNodes" select="$functionExtensionNodes" />
                <xsl:with-param name="nodes" select="$functionNodes" />
            </xsl:call-template>

            <dt>Constants: <xsl:value-of select="count($constantNodes)" /></dt>
            <xsl:call-template name="counters">
                <xsl:with-param name="extensionNodes" select="$constantExtensionNodes" />
                <xsl:with-param name="nodes" select="$constantNodes" />
            </xsl:call-template>
        </dl>
        <xsl:apply-templates select="phpcompatinfo/files" />
        <xsl:apply-templates select="phpcompatinfo" mode="foot" />
        </body>
        </html>
    </xsl:template>

    <xsl:template match="phpcompatinfo" mode="head">
        <meta name="generator" content="{concat('PHP_CompatInfo ', @version)}" />
    </xsl:template>

    <xsl:template match="phpcompatinfo" mode="foot">
        <div class="footer"><xsl:value-of select="concat('Generated by PHP_CompatInfo ', @version, ' at ', @timestamp)" /></div>
    </xsl:template>

    <xsl:template match="files">
        <table class="summary">
            <thead>
                <tr><th rowspan="2">Files</th><th colspan="2">Versions</th></tr>
                <tr><th>Min</th><th>Max</th></tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Total :</th>
                    <th><xsl:value-of select="//phpcompatinfo/versions/min" /></th>
                    <th><xsl:value-of select="//phpcompatinfo/versions/max" /></th>
                </tr>
            </tfoot>
            <tbody>
                <tr><th colspan="3"><xsl:value-of select="count(./*)" /> source(s)</th></tr>
                <xsl:apply-templates />
            </tbody>
        </table>
    </xsl:template>

    <xsl:template match="file">
        <tr>
            <td><xsl:value-of select="@name" /></td>
            <td><xsl:value-of select="./versions/min" /></td>
            <td><xsl:value-of select="./versions/max" /></td>
        </tr>
    </xsl:template>

    <xsl:template name="counters">
        <xsl:param name="extensionNodes" />
        <xsl:param name="nodes" />

        <dd>
        <table class="counters">

        <xsl:for-each select="$extensionNodes">
            <xsl:sort select="." />
            <xsl:variable name="extension">
                <xsl:value-of select="." />
            </xsl:variable>
            <xsl:variable name="current" select="count($nodes[@extension = $extension])" />
            <xsl:variable name="total" select="count($nodes)" />
            <xsl:variable name="percent" select="$current div $total" />

            <tr>
            <td>
            <xsl:choose>
                <xsl:when test="string-length($extension) > 0">
                    <xsl:value-of select="$extension" />
                </xsl:when>
                <xsl:otherwise>
                    User
                </xsl:otherwise>
            </xsl:choose>
            </td>
            <td>
                <xsl:value-of select="$current" />
            </td>
            <td>
                (<xsl:value-of select="format-number($percent, '0.00%')" />)
            </td>
            </tr>
        </xsl:for-each>
        </table>
        </dd>
    </xsl:template>

</xsl:stylesheet>