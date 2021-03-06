--TEST--
Dklab_ShortXSLT: value-of shortcut
--FILE--
<?php
require dirname(__FILE__) . '/init.php';

$v = <<<EOT
{if a > b}aaa{/if}
-----
{if a < b}aaa{/if}
-----
<tag value="{a > b}" x="{m > n}" />
-----
<tag value="{a < b}" />
EOT;
massCallPreprocess($v);

?>




--EXPECT--
******************************************************************
{if a > b}aaa{/if}
------------------------------------------------------------------
<xsl_:choose xmlns:xsl_="http://www.w3.org/1999/XSL/Transform"><xsl_:when test="a > b">aaa</xsl_:when></xsl_:choose>
******************************************************************

******************************************************************
{if a < b}aaa{/if}
------------------------------------------------------------------
{if a < b}aaa</xsl_:when></xsl_:choose>
******************************************************************

******************************************************************
<tag value="{a > b}" x="{m > n}" />
------------------------------------------------------------------
<tag value="{a > b}" x="{m > n}" />
******************************************************************

******************************************************************
<tag value="{a < b}" />
------------------------------------------------------------------
<tag value="{a < b}" />
******************************************************************
