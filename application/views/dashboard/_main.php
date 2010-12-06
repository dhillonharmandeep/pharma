<?php
/**
 * _main.php
 * Description	: A demo containing all the features the main section of the website can have
 *
 *
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
?>
<!--// Tabbed interface starts -->


<div id="tabletmenu">
<div id="tabvanilla" class="widget">

<ul class="tabnav">
	<li class="class2"><span class="bodytext"><a href="#popular">Sidebar
	links</a></span></li>
	<!--// SIDEBAR LINKS TITLE -->
	<li class="class2"><span class="bodytext"><a href="#recent">top tips</a></span></li>
	<!--// TOPTIPS TITLE -->
</ul>
<!--/sidebar links-->
<div id="popular" class="tabdiv"><span class="bodytext"><strong>SIDEBAR
LINKS</strong><br />
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin bibendum
nisi at ipsum. Nam sodales neque et urna. Nunc ultricies. Maecenas
ipsum. Ut suscipit. Sed posuere feugiat metus. Duis at turpis non nulla
adipiscing viverra.</span></div>

<span class="bodytext"> <!--/toptips--> </span>
<div id="recent" class="tabdiv">
<p><span class="bodytext"><strong>TOP TIPS</strong><br />
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin bibendum
nisi at ipsum. Nam sodales neque et urna. Nunc ultricies. Maecenas
ipsum. Ut suscipit. Sed posuere feugiat metus. Duis at turpis non nulla
adipiscing viverra.</span><br />
<br />
<span class="bodytext">Lorem ipsum dolor sit amet, consectetuer
adipiscing elit. Proin bibendum nisi at ipsum. Nam sodales neque et
urna. Nunc ultricies. Maecenas ipsum. Ut suscipit. Sed posuere feugiat
metus. Duis at turpis non nulla adipiscing viverra.</span></p>
</div>
<span class="bodytext"> </span></div>
</div>

<!--// Tabbed interface ends -->

<!--// Content starts -->

<div
	id="content">
<table width="772" border="0">
	<tr>
		<th height="58" valign="middle" bgcolor="#E5E5E5" scope="col">
		<h1 align="left">Welcome to your Admin Panel</h1>
		</th>
		<!--// H1 title -->
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
		<p class="bodytext_paragraph">Lorem ipsum dolor sit amet, consectetuer
		adipiscing elit. Duis sollicitudin tincidunt lacus. Sed non purus.
		Nullam porttitor ante id sem. <br />
		<!--// bodytext --> Nam vel metus. Duis vitae lectus. Integer laoreet
		pulvinar nisi. Nam vel metus. Duis vitae lectus. Integer laoreet
		pulvinar nisi. Lorem<br />
		ipsum dolor sit amet, consectetuer adipiscing elit. Duis sollicitudin
		tincidunt lacus. Sed non purus. Duis sollicitudin tincidunt lacus.<br />
		<br />
		Nullam porttitor ante id sem. Nam vel metus. Duis vitae lectus.
		Integer laoreet pulvinar nisi. Nam vel metus. Duis vitae lectus.
		Integer laoreet pulvinar nisi. Nam vel metus.<br />
		<br />
		</p>
		</td>
	</tr>
</table>


<h2>This is H2 Header title</h2>
<!--// h2 title -->
<h3>This is H3 Header title</h3>
<br />
<!--// h3 title --> <br />
<br />
<br />
<br />



<div id="positive"><!--// Positive message -->
<table width="450" cellpadding="0" cellspacing="12">
	<tr>
		<td width="52">
		<div align="center"><img src="images/icons/positive.png"
			alt="positive" width="22" height="16" /></div>
		</td>
		<td width="388" class="bodytext style3"><strong>Congratulations!</strong>
		Your information has been submitted suffesfully.<br />
		</td>
		<!--// positive message -->
	</tr>
</table>
</div>



<div id="negative"><!--// error message -->
<table width="450" cellpadding="0" cellspacing="12">
	<tr>
		<td width="52">
		<div align="center"><img src="images/icons/negative.png"
			alt="negative" width="18" height="18" /></div>
		</td>
		<td width="388" class="bodytext style4"><strong>Error!</strong> Please
		try again, following fields were incorrect..</td>
		<!--// error text -->
	</tr>
</table>
</div>




<div id="tip"><!--// tip message starts -->
<table width="450" cellpadding="0" cellspacing="12">
	<tr>
		<td width="52">
		<div align="center"><img src="images/icons/attention.png"
			alt="attention" width="22" height="18" /></div>
		</td>
		<td width="388" class="bodytext style4"><span class=""><strong>ProAdmin
		TopTip!</strong> You can speed your working with...</span></td>
		<!--// tip message -->
	</tr>
</table>
</div>





<div class="bodytext_fieldstitle" id="fieldmedium">Form Fields – Medium</div>
<!--// Form title medium -->
<div class="bodytext_fieldstitle" id="formtitle">Form Fields – Small</div>
<!--// Form title small -->
<div class="bodytext_fieldstitle" id="fieldlarge">Form Fields – Large</div>
<!--// Form title large -->
<div class="bodytext_fieldstitle" id="yourmessage">Your Message</div>
<!--// Form title message --> <!--// Small form field starts -->

<div id="small"><input name="search2" type="text" class="fields"
	id="search2" onfocus="if (value='Lorem ipsum dolor') {value=''}"
	onblur="if (value=='') {value='Lorem ipsum dolor'}"
	value="Lorem ipsum dolor" size="25" /> <br />
<span class="instructions">Lorem ipsum dolor sit amet, consectetuer
adipiscing elit. Proin bibendum nisi at ipsum.</span><span
	class="style9"><br />
</span><br />
</div>

<!--// Small form field ends --> <!--// medium form field starts -->

<div id="medium"><input name="search3" type="text" class="fields"
	id="search3" onfocus="if (value='Lorem ipsum dolor') {value=''}"
	onblur="if (value=='') {value='Lorem ipsum dolor'}"
	value="Lorem ipsum dolor" size="50" /> <br />
<span class="instructions">Lorem ipsum dolor sit amet, consectetuer
adipiscing elit. Proin bibendum nisi at ipsum..</span></div>

<!--// medium form field ends--> <!--// large form field starts -->

<div id="large"><input name="search4" type="text" class="fields"
	id="search4" onfocus="if (value='Lorem ipsum dolor') {value=''}"
	onblur="if (value=='') {value='Lorem ipsum dolor'}"
	value="Lorem ipsum dolor" size="80" /> <span class="instructions">Lorem
ipsum dolor sit amet, consectetuer adipiscing elit. Proin bibendum nisi
at ipsum.</span></div>

<!--// large form field ends --> <!--// message form field starts -->

<div id="message"><label></label> <textarea name="search5" cols="80"
	rows="10" class="fields" id="search5"
	onfocus="if (value='Lorem ipsum dolor') {value=''}"
	onblur="if (value=='') {value='Lorem ipsum dolor'}">Lorem ipsum dolor</textarea>
<span class="instructions">Lorem ipsum dolor sit amet, consectetuer
adipiscing elit. Proin bibendum nisi at ipsum. <br />
dolor sit amet, consectetuer adipiscing elit. Proin bibendum nisi at
ipsum.</span><br />
<br />
<br />

<!--// message form field ends --> <!--// Buttons start--> <label> <input
	name="submit" type="submit" class="button" id="submit" value="Submit" /></label>
<!--// submit --> <input name="reset" type="reset" class="button"
	id="reset" value="Reset" /> <!--// reset --> <input name="browse"
	type="reset" class="button" id="browse" value="Browse..." /> <!--// browse -->
</div>
</div>

<!--// Buttons ends -->


<!--// Content ends -->
