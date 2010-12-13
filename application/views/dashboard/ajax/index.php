<html>
<head>
<script type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>common/admin/ajax/jquery.autocomplete-min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/ajax/styles.css" type="text/css" media="screen" />

<script type="text/javascript">
    function loadXMLDoc() {
        if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        } else {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange= function() {
            document.getElementById("myDiv").innerHTML+=xmlhttp.readyState+' - '+xmlhttp.status+' : ' + xmlhttp.responseText + '<hr/>';
        }
        xmlhttp.open("POST","ajax/query2",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send("fname=Harman&lname=Dhillon&mname=Singh&query=tes");
    }
</script>
</head>
<body>

<h2>AJAX</h2>
<div id="myDiv"></div>
<button type="button" onclick="loadXMLDoc()">Request data</button>

<br/><br/>
<form action="default.aspx" >
 <input type="text" name="q" id="query" />
 <input type="text" name="q2" id="id2" />
 <input type="button" value="OK" />
</form>


<script type="text/javascript">
    //<![CDATA[

    var a1, a2;

    jQuery( function() {
        var options = {
            serviceUrl: 'ajax/query2',
            width: 300,
            delimiter: /(,|;)\s*/,
            deferRequestBy: 0, //miliseconds
            params: { country: 'Yes' },
            noCache: false //set to true, to disable caching
        };

        a1 = $('#query').autocomplete(options);
        a2 = $('#id2').autocomplete(options);

        // Dont understand the use of following
        $('#navigation a').each( function() {
            $(this).click( function(e) {
                var element = $(this).attr('href');
                $('html').animate({ scrollTop: $(element).offset().top }, 300, null, function() {
                    document.location = element;
                });
                e.preventDefault();
            });
        });
    });
    //]]>
</script> 
</body>
</html>

