<?php
/**
 * dash.php
 * Description	:
 *
 *
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>

  <p>
    Welcome to the admin area! The following 3 parts have been completed. 
    You can either click on the links below, or on the links in the left menu.
    All other links will not work.  
  </p>
  <ul>
  	<li><a href="<?php echo base_url()?>chainbg">Chains/Banner Groups</a></li>
  	<li><a href="<?php echo base_url()?>mtype">Medicine Types</a></li>
    <li><a href="<?php echo base_url()?>salt">Salts</a></li>
    <li><a href="<?php echo base_url()?>store">Store</a></li>
    <li><a href="<?php echo base_url()?>medicine">Medicine</a></li>
  </ul>
  <img border="0" usemap="#aumap" alt="map" src="<?php echo base_url()?>common/admin/images/australia2.gif">
    <map name='aumap'>
      <area shape='polygon' coords='150,47,155,228,141,240,130,240,118,250,113,260,102,262,91,262,82,265,76,270,72,270,67,277,57,280,39,272,35,262,39,262,40,257,40,255,40,250,42,248,33,228,27,216,21,204,21,204,5,182,18,189,21,184,9,172,12,150,9,145,12,137,12,145,18,135,36,118,43,120,50,115,56,113,59,108,66,108,76,103,82,91,87,86,86,79,91,69,98,76,100,71,96,64,105,64,107,61,107,59,129,35,141,44,141,47,150,47,150,47' href="<?php echo base_url()?>chainbg/state/WA"/>
      <area shape='polygon' coords='237,168,154,167,152,51,154,51,154,47,154,44,154,33,157,33,157,31,163,21,176,20,185,16,177,11,176,13,176,11,163,18,157,15,157,10,171,10,176,11,185,7,186,16,202,18,217,21,224,11,217,18,224,13,224,23,224,18,224,21,224,33,224,34,224,42,224,42,224,37,224,36,224,37,217,44,202,49,217,49,243,68,237,170,237,170'  href="<?php echo base_url()?>chainbg/state/NT"/>
      <area shape='polygon' coords='333,208,263,202,265,169,239,170,244,70,255,74,262,68,255,76,263,82,271,80,278,56,278,44,278,38,279,34,281,30,281,26,289,7,302,35,304,51,311,47,317,55,325,74,325,80,325,93,326,101,333,105,348,118,344,120,353,130,353,136,356,139,360,139,362,143,362,153,378,164,380,176,387,188,386,208,376,209,367,207,363,213,358,214,356,212,353,209,348,207,341,205,337,206'  href="<?php echo base_url()?>chainbg/state/QLD"/>
      <area shape='polygon' coords='265,170,257,297,245,286,245,274,237,268,229,268,224,268,217,272,226,272,235,259,229,255,228,264,221,264,222,259,226,259,226,252,229,248,229,245,228,237,224,248,212,259,209,259,209,252,204,248,204,245,200,243,200,237,194,233,194,234,186,232,174,226,155,226,153,167,252,169,262,169'  href="<?php echo base_url()?>chainbg/state/SA"/>
      <area shape='polygon' coords='374,234,384,207,368,206,363,210,359,213,353,207,352,206,350,205,345,205,334,208,263,202,259,256,272,261,275,266,277,265,280,270,281,271,295,283,297,281,309,283,321,281,321,287,334,299,345,278,350,262,363,251,368,239,374,234,374,234'  href="<?php echo base_url()?>chainbg/state/NSW"/>
      <area shape='polygon' coords='277,311,267,309,258,300,259,256,269,260,271,268,275,264,279,267,279,271,293,281,294,278,309,282,316,282,321,290,334,297,332,305,315,303,302,320,287,305,279,311,278,315'  href="<?php echo base_url()?>chainbg/state/VIC"/>
      <area shape='polygon' coords='287,349,287,342,281,334,280,326,284,325,290,327,297,332,305,333,311,329,316,333,322,338,315,358,301,368,298,361,292,362'  href="<?php echo base_url()?>chainbg/state/TAS"/>
    </map>

<?php
$this->load->view('dashboard/structure/_footer');
