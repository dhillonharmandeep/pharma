<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <dl>
      <xsl:for-each select="rss/channel/item">
        <dt><h3><xsl:value-of select="title" /></h3></dt>
        <dd>
          <span class="date"><xsl:value-of select="pubDate" /></span>
          <p>
            <xsl:value-of select="description" />
            <br />
            <xsl:element name="a">
              <xsl:attribute name = "href">
                <xsl:value-of select="link" />
              </xsl:attribute>
              read full article
            </xsl:element>
          </p>
        </dd>
      </xsl:for-each>
    </dl>
  </xsl:template>
</xsl:stylesheet>
