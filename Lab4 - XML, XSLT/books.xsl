<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">
<html>
	<head>
  		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<h2>A Book Collection</h2>
		<table class="table table-dark" border="1">
			<xsl:for-each select="collection/book">
			<tr>
			    <td><xsl:value-of select="title"/></td>
				<td>
					<xsl:variable name="hyperlink"><xsl:value-of select="@href" /></xsl:variable>
					<a href="{$hyperlink}"> <xsl:value-of select="@href" /></a></td>
		        <td>
					<xsl:element name="img">
						<xsl:attribute name="src">
							<xsl:value-of select="image"/>
						</xsl:attribute>
					<xsl:attribute name="width">200px</xsl:attribute>
					<xsl:attribute name="height">200px</xsl:attribute>
					</xsl:element>
				</td>
			</tr>
			</xsl:for-each>
		</table>
	</body>
</html>

</xsl:template>
</xsl:stylesheet>
