<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">  
    <h2>AJAX Grid</h2>
    <xsl:call-template name="menu"/> 
    <form id="grid_form_id">
      <table class="list">  
        <tr>
          <th class="th1">ID</th> 
          <th class="th2">Name</th>   
          <th class="th3">Price</th> 
          <th class="th4">Promo</th> 
          <th class="th5"></th>
        </tr>
        <xsl:for-each select="data/grid/row">
          <xsl:element name="tr">
            <xsl:attribute name="id">
              <xsl:value-of select="product_id" />
            </xsl:attribute>     
            <td><xsl:value-of select="product_id" /></td>
            <td><xsl:value-of select="name" /> </td>    
            <td><xsl:value-of select="price" /></td>
            <td>
              <xsl:choose>
                <xsl:when test="on_promotion &gt; 0">
                  <input type="checkbox" name="on_promotion" 
                         disabled="disabled" checked="checked"/>
                </xsl:when>
                <xsl:otherwise>
                  <input type="checkbox" name="on_promotion"
                  disabled="disabled"/>
                </xsl:otherwise>
               </xsl:choose>      
            </td>      
            <td>
              <xsl:element name="a">
                <xsl:attribute name = "href">#</xsl:attribute>
                <xsl:attribute name = "onclick">
                  editId(<xsl:value-of select="product_id" />, true)
                </xsl:attribute>
                Edit
              </xsl:element>
            </td>    
          </xsl:element>
        </xsl:for-each>
      </table>
    </form>
    <xsl:call-template name="menu" /> 
  </xsl:template>
  <xsl:template name="menu">
    <xsl:for-each select="data/params">
      <table>
        <tr>
          <td class="left">
            <xsl:value-of select="items_count" /> Items
          </td> 
          <td class="right"> 
            <xsl:choose>
              <xsl:when test="previous_page>0">
                <xsl:element name="a" >
                  <xsl:attribute name="href" >#</xsl:attribute>
                  <xsl:attribute name="onclick">
                    loadGridPage(<xsl:value-of select="previous_page"/>)
                  </xsl:attribute>
                  Previous page
                </xsl:element>
              </xsl:when> 
            </xsl:choose>
          </td>   
          <td class="left">
            <xsl:choose>
              <xsl:when test="next_page>0">
                <xsl:element name="a">
                  <xsl:attribute name = "href" >#</xsl:attribute>
                  <xsl:attribute name = "onclick">
                    loadGridPage(<xsl:value-of select="next_page"/>)
                  </xsl:attribute>
                  Next page
                </xsl:element>
              </xsl:when> 
            </xsl:choose>
          </td>
          <td class="right">
            page <xsl:value-of select="returned_page" />
            of <xsl:value-of select="total_pages" />
          </td>  
        </tr>
      </table>
    </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>
