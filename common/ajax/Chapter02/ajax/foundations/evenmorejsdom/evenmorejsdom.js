function process()
{
  // create the first text node
  oHello = document.createTextNode
                    ("Hello Dude! Here's a cool list of colors for you:");

  // create the <ul> element
  oUl = document.createElement("ul")

  // create the first <ui> element and add a text node to it
  oLiBlack = document.createElement("li");
  oBlack = document.createTextNode("Black");
  oLiBlack.appendChild(oBlack);

  // create the second <ui> element and add a text node to it
  oLiOrange = document.createElement("li");
  oOrange = document.createTextNode("Orange");
  oLiOrange.appendChild(oOrange);

  // create the third <ui> element and add a text node to it
  oLiPink = document.createElement("li");
  oPink = document.createTextNode("Pink");
  oLiPink.appendChild(oPink);

  // add the <ui> elements as children to the <ul> element
  oUl.appendChild(oLiBlack);
  oUl.appendChild(oLiOrange);
  oUl.appendChild(oLiPink);

  // obtain a reference to the <div> element on the page
  myDiv = document.getElementById("myDivElement");

  // add content to the <div> element
  myDiv.appendChild(oHello);
  myDiv.appendChild(oUl);
}
