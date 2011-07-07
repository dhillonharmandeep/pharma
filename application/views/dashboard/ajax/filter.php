  <span class="ui-widget">
    <label for="filterBox">Filter:</label>
    <input id="filterBox" size="15" value="<?=$filter?>"/>
    <input type="button" name="Go" value="Go" onclick="filterThis();"/>
    <input type="button" name="Clear" value="Clear" onclick="filterClear();"/>
  </span>

  <script type="text/javascript">
  function filterThis() {
  	window.location = '<?=base_url().$destination?>/index/' + document.getElementById('filterBox').value;
  }
  function filterClear() {
  	window.location = '<?=base_url().$destination?>/index';
  }
  </script>