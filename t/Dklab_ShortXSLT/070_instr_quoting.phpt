--TEST--
Dklab_ShortXSLT: instruction shortcut quoting
--FILE--
<?php
require dirname(__FILE__) . '/init.php';

$v = <<<EOT
{if a &lt; "b"}
--------
{if a &lt; 'b'}
--------
{if a &lt; 'b' and #c}
--------
<tag title="{if a &lt; 'b'}" />
--------
<tag title='{if a &lt; "b"}' />
--------
<tag title='{if a &lt; 'b' and #c}' />
EOT;
massCallPreprocess($v);
?>




--EXPECT--
******************************************************************
{if a &lt; "b"}
------------------------------------------------------------------
<xsl_:choose xmlns:xsl_="http://www.w3.org/1999/XSL/Transform"><xsl_:when test="a &lt; &quot;b&quot;">
******************************************************************

******************************************************************
{if a &lt; 'b'}
------------------------------------------------------------------
<xsl_:choose><xsl_:when test="a &lt; &apos;b&apos;">
******************************************************************

******************************************************************
{if a &lt; 'b' and #c}
------------------------------------------------------------------
<xsl_:choose xmlns:php_="http://php.net/xsl"><xsl_:when test="a &lt; &apos;b&apos; and php_:function(&apos;constant&apos;, &apos;c&apos;)">
******************************************************************

******************************************************************
<tag title="{if a &lt; 'b'}" />
------------------------------------------------------------------
<tag title="{if a &lt; &apos;b&apos;}" />
******************************************************************

******************************************************************
<tag title='{if a &lt; "b"}' />
------------------------------------------------------------------
<tag title='{if a &lt; &quot;b&quot;}' />
******************************************************************

******************************************************************
<tag title='{if a &lt; 'b' and #c}' />
------------------------------------------------------------------
<tag xmlns:php_="http://php.net/xsl" title='{if a &lt; &apos;b&apos; and php_:function(&apos;constant&apos;, &apos;c&apos;)}' />
******************************************************************
